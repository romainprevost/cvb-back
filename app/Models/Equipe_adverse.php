<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe_adverse extends Model
{
    use HasFactory;

    //1-n avec resultats
    public function resultats() { 
        return $this->hasMany(Resultat::class);
    }
}
