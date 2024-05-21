<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    use HasFactory;

    //n-n avec equipe_seniors
    public function equipe_seniors() { 
        return $this->belongsToMany(Equipe_senior::class);
    }

    //n-n avec equipe_jeunes
    public function equipe_jeunes() { 
        return $this->belongsToMany(Equipe_jeune::class);
    }
}
