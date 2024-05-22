<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CoachsResource extends JsonResource
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
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'tel' => $this->tel,
            'photo' => $this->photo,
            'equipe_jeune_id' => $this->equipe_jeune_id,
            'equipe_senior_id' => $this->equipe_senior_id,
            'created_at' => $this->created_at,
        ];    
    }
}
