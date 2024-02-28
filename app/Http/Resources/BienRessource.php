<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BienRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "description" =>$this->description,
            "libelle" => $this->libelle,
            "date" => $this->date,
            "lieu" => $this->lieu,
            "statut" => $this->statut,
            "categorie" => $this->categorie->nom,
            "user" => $this->user->firstName,
            "userId" => $this->user->id,
            "userMail" => $this->user->email,
            "userPhone" => $this->user->phone,
            'type_bien'=>$this->type_bien,
            "image" => $this->images ? $this->images->image : null,
        ];
    }
}
