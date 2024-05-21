<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    //n-n avec equipeSenior
    public function equipeSenior() { 
        return $this->belongsToMany(EquipeSenior::class, 'equipe_seniors');
    }

    //n-n avec equipeJunior
    public function equipeJunior() { 
        return $this->belongsToMany(EquipeJeune::class, 'equipe_juniors');
    }


}
