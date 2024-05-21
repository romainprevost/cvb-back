<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualite extends Model
{
    use HasFactory;

    //1-n equipe_seniors
    public function equipe_senior() { 
        return $this->belongsTo(Equipe_senior::class);
    }

    //1-n equipe_jeunes 
    public function equipe_jeune() { 
        return $this->belongsTo(Equipe_jeune::class);
    }
}
