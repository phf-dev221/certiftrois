<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;


class UpdateBienRequest extends FormRequest
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
    public function rules(Request $request): array
    { 
        return [
            'libelle'=>'required|string',
            'description'=>'required|string',
            'date'=>'required|date',
            'lieu'=>'required|string',
            'categorie_id'=>'required|integer',
            'image[]' => 'sometimes|image|max:10000|mimes:jpeg,png,jpg',
        ];
    }

    public function failedValidation(validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'error' => true,
            'message' => 'erreur de validation',
            'errorList' => $validator->errors()
        ]));
    }
    public function messages()
    {
        return [
            'libelle.required'=>'le libellé est requis',
            'description.required'=>'la description est requise',
            'libelle.string'=>'Format du libellé incorrect',
            'description.string'=>'la description a un format incorrect',
            'date.required'=>'la date est requizze',
            'date.date'=>'Format date incorrect',
            'lieu.required'=>'le lieu est requis',
            'categorie_id.required'=>'la categorie est requis',
            'lieu.integer'=>'le type de categorie est au mauvais format',
            'lieu.string'=>'Format lieu incorrect',
            'image.image'=>"le format de l'image est incorrect",
            'image.max'=>'la taille de l\'image est trop grande'

        ];
    }
}
