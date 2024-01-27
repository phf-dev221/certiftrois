<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class RegisterContactRequest extends FormRequest
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
            'nom'=>'required|regex:/^[A-Za-zÀ-ÖØ-öø-ÿ]+$/',
            'email'=>'required|email',
            'message'=>'required|string'
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
    public function messages(){
        return [
            'nom.required'=>'le nom est requis',
            'message.string'=>'Format du message incorrect',
            'message.required'=>'le message est requis',
            'nom.regex'=>'le format du nm est incorrect',
            'email.required'=>'l\'email est requis',
            'email.email'=>"format email incorrect",

        ];
    }
}
