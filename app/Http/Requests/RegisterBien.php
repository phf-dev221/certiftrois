<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUserRequest extends FormRequest
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
            'libelle'=>'required|string',
            'description'=>'required|string',
            'date'=>'required|date',
            'lieu'=>'required|regex:/string',
            'categorie_id'=>'required|integer',
            'image'=>'required|image|max:5000'
        ];
    }

    public function failedValidation(validator $validator ){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'status_code'=>422,
            'error'=>true,
            'message'=>'erreur de validation',
            'errorList'=>$validator->errors()
        ]));
    }
    // public function messages(){
    //     return [
    //         'libelle.required'=>'le libellé est requis',
    //         'description.required'=>'la description est requise',
    //         'libelle.string'=>'Format du libellé incorrect',
    //         'firstName.required'=>'le prénom est requis',
    //         'email.required'=>'l\'email est requis',
    //         'email.unique'=>'l\'email existe déja',
    //         'email.email'=>"format email incorrect",
    //         'password.required'=>'le mot de passe est requis',
    //         'confirmPassword.required'=>'la confirmation du mot de passe est requis',
    //         'password.regex'=>"le mot de passe doit contenir au moins 8 caractéres avec un chiffre, une lettre et un caractére spécial",
    //         'confirmPassword.regex'=>"le mot de passe de confirmation doit contenir au moins 8 caractéres avec un chiffre, une lettre et un caractére spécial",
    //         'phone.required'=>'le numéro de téléphone est requis',
    //         'phone.unique'=>'le numéro telephone est deja utilisé',
    //         'phone.regex'=>'le format du numéro est incorrect',

    //     ];
    // }
}
