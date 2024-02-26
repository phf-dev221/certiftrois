<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class RegisterBienRequest extends FormRequest
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
            'categorie_id'=>'required|integer',
            'type_bien' => 'required|in:bien_trouve,bien_perdu',
            'lieu'=>'required|string',
            'image' => 'image|max:10000|mimes:jpeg,png,jpg',
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
            'libelle.required'=>'le libellé est requis',
            'type_bien.required"=>"le type de bien est requis',
            'type_bien.in' => 'Le champ type de bien doit être soit "bien_trouve" soit "bien_perdu".',
            'description.required'=>'la description est requise',
            'libelle.string'=>'Format du libellé incorrect',
            'categorie_id.integer'=>'Format de la categorie incorrect',
            'description.string'=>'la description a un format incorrect',
            'date.required'=>'la date est requise',
            'date.date'=>'Format date incorrect',
            'lieu.required'=>'le lieu est requis',
            'categorie_id.required'=>'la categorie est requise',
            'lieu.string'=>'Format lieu incorrect',
            'image.required'=>"l'image est requise",
            'image.image'=>"le format de l'image est incorrect",
            'image.max'=>'la taille de l\'image est trop grande'

        ];
    }
}
