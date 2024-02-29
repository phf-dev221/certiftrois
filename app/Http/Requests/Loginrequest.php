<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

 /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'=>'required|regex:/^[A-Za-z]+[A-Za-z0-9._%+-]+@+[A-Za-z][A-Za-z0-9.-]+.[A-Za-z]{2,}$/',
            'password'=>'required|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[@#$%^&+=!])(.{8,})$/',

        ];
    }

    public function messages()
    {
        return [
            "email.required" => 'L\'email est requise',
            "email.regex" => 'L\'email incorrecte',

            "password.required" => 'Le mot de passe est requis',
            "password.regex" => 'Le mot de passe doit avoir (au moins 8 caractères)',



        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors,
        ], 422));
    }
}
