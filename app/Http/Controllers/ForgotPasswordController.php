<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Show the forget password form.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Submit the forget password form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json(['message' => 'Nous vous avons envoyé un email de récupération!']);
    }

    /**
     * Show the reset password form.
     *
     * @param  string  $token
 
     */
    public function showResetPasswordForm($token)
    {
        return view('resetPassword', ['token' => $token]);
    }

    /**
     * Submit the reset password form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/',
            'password_confirmation' => 'required|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/',
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([

                'token' => $request->token,
            ])
            ->first();

        if (!$updatePassword) {
            return response()->json(['error' => 'données invalides!'], 422);
        }

        $user = DB::table('password_reset_tokens')->where(['token' => $request->token])->first();

        User::where('email', $user->email)
            ->update(['password' => Hash::make($request->password)]);
            DB::table('password_reset_tokens')->where(['token'=> $request->token])->delete();
        return response()->json(['message' => 'Votre mot de passe a été mis a jour']);
    }
}
