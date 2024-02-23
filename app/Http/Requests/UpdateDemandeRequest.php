<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class UpdateDemandeRequest extends FormRequest
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
            'details'=>'sometimes|string',
            'email'=>'required|regex:/^[A-Za-z]+[A-Za-z0-9._%+-]+@+[A-Za-z][A-Za-z0-9.-]+.[A-Za-z]{2,}$/',
            'date_fin'=>'required|date',
            'date_debut'=>'required|date',
            'nom'=>'required',
            'phone'=>'required',
            'image'=>'sometimes|image|max:10000|mimes:jpeg,png,jpg',
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
            'email.required'=>'l\'email est requis',
            'email.regex'=>"format email incorrect",
            'image.image'=>'Veuillez ajouter une image',
            'image.max'=>'Taille de l\'image trop grande',
            'date_fin.required'=>'la date de fin est requise',
            'date_fin.date'=>'la date de fin a un format incorrect',
            'date_debut.required'=>'la date de debut est requise',
            'date_debut.date'=>'la date de debut a un format incorrect',

        ];
    }
}
