<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipeSenior extends Model
{
    use HasFactory;


    //n-n avec joueurs
    public function joueurs() { 
        return $this->belongsToMany(Joueur::class, 'equipe_seniors_joueurs');
    }

    //n-n avec staff
    public function staff() { 
        return $this->belongsToMany(EquipeJeune::class, 'staff');
    }

    //1-n avec actualites
    public function actualites() { 
        return $this->hasMany(Actualite::class);
    }

    //1-n avec resultats
    public function resultats() { 
        return $this->hasMany(Resultat::class);
    }
}
