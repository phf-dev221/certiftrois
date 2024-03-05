<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'index', 'update']]);
    }

    public function index()
    {
        $users = User::all();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'liste des users',
            'utilisateurs' => $users
        ],200);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {

        // $credentials = request(['email', 'password']);
         $credentials = ['email'=>$request->email,'password'=> $request->password];

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Auth::user();

        return $this->respondWithToken($token, $user);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Déconnexion réussie']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $user = auth()->user();
        return $this->respondWithToken(auth()->refresh(), $user);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'status_code' => 200,
            'utlisatur' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ],200);
    }

    public function register(RegisterUserRequest $request)
    {
        try {

            if ($request->password !== $request->confirmPassword) {
                return response()->json([
                    'status_code' => 403,
                    'status_message' => 'Le mot de passe et la confirmation ne correspondent pas.',
                ], 403);
            }

            $user = new User();
            $user->name = $request->name;
            $user->firstName = $request->firstName;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->role_id = 1;
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status_code' => 201,
                'status_message' => 'utilisateur ajouté avec succes',
                'status_body' => $user
            ],201);
        } catch (Exception $e) {
            return response()->json([$e]);
        }
    }

    public function show(User $user){
        
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Informations utilisateur recupérées avec succès',
            'user' => $user,
        ],200);
    }

    public function update(RegisterUserRequest $request, User $user)
    {
        try {
            $user->update($request->only(['name', 'firstName', 'phone', 'email']));

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Informations utilisateur mises à jour avec succès',
                'user' => $user,
            ],200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }



    public function archive(User $user)
    {
        try {
            $user->update([
                'isArchived' => 1
            ]);
            $user->save();
            return response()->json([
                'status_code' => 200,
                'status_message' => "Vous avez archivés cet utilisateur"
            ],200);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function userNonArchive()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tous les utilisateurs non archivés',
                'utilisateurs' => User::where('isArchived', 0)->get(),
            ],200);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function userArchive()
    {
        try {
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Voici la liste de tous les utilisateurs archivés',
                'utilisateurs' => User::where('isArchived', 1)->get(),
            ],200);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function sendWhatsapp(User $user){

    try {
        $numeroWhatsApp = $user->phone;
        $urlWhatsApp = "https://api.whatsapp.com/send?phone=$numeroWhatsApp";

        return redirect()->to($urlWhatsApp);
    } catch (ModelNotFoundException $e) {
        return redirect()->route('whatsapp');
    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
    }

public function changePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'current_password' => 'required',
        'new_password' => 'required|different:current_password|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/',
        'confirm_password' => 'required|same:new_password',
    ],
    [
        'current_password.required' => 'Le champ mot de passe actuel est requis.',
        'new_password.required' => 'Le champ nouveau mot de passe est requis.',
        'new_password.different' => 'Le nouveau mot de passe doit être différent du mot de passe actuel.',
        'new_password.regex' => 'Le nouveau mot de passe doit contenir au moins 8 caractères, avec au moins une lettre, un chiffre et un caractère spécial (@#$%^&+=!).',
        'confirm_password.required' => 'Le champ confirmation du nouveau mot de passe est requis.',
        'confirm_password.same' => 'Le champ confirmation du nouveau mot de passe doit correspondre au nouveau mot de passe.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status_code' => 422,
            'status_message' => 'Erreur de validation',
            'errors' => $validator->errors(),
        ], 422);
    }

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'status_code' => 401,
            'status_message' => 'Mot de passe actuel incorrect',
        ], 401);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return response()->json([
        'status_code' => 200,
        'status_message' => 'Mot de passe changé avec succes',
    ],200);
}

}
