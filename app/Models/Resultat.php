<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;

    //1-n avec equipe_seniors
    public function equipe_senior() { 
        return $this->belongsTo(Equipe_senior::class);
    }
    //1-n avec equipe_jeunes
    public function equipe_jeune() { 
        return $this->belongsTo(Equipe_jeune::class);
    }
    //1-n avec equipes_adverses
    public function equipe_adverse() { 
        return $this->belongsTo(Equipe_adverse::class);
    }
}
