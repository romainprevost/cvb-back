<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    //1-n avec clients
    public function client() { 
        return $this->belongsTo(Client::class);
    }

    //1-n avec lignes_commandes
    public function lignes_commandes() { 
        return $this->hasMany(Lignes_commande::class);
    }
}
