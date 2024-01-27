<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class RegisterDemandeRequest extends FormRequest
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
            'details'=>'required|string',
            'email'=>'required|email',
            'duree'=>'required|numeric'
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
            'details.required'=>'le detail est requis',
            'details.string'=>'Format du detail incorrect',
            'duree.required'=>'la durée est requise',
            'duree.numeric'=>'la durée a un format incorrect',
            'email.required'=>'l\'email est requis',
            'email.email'=>"format email incorrect",

        ];
    }
}
