<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActualitesResource extends JsonResource
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
            'titre' => $this->titre,
            'content' => $this->content,
            'auteur' => $this->auteur,
            'photo' => $this->photo,
            'equipe_jeune_id' => $this->equipe_jeune_id,
            'equipe_senior_id' => $this->equipe_senior_id,
            'created_at' => $this->created_at,
        ];
    }
}
