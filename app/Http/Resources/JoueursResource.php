<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JoueursResource extends JsonResource
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
            'licence' => $this->licence,
            'genre' => $this->genre,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'dateDeNaissance' => $this->date_de_naissance,
            'email' => $this->email,
            'tel' => $this->tel,
            'photo' => $this->photo,
            'createdAt' => $this->created_at,
        ];
    }
}
