<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignes_commande extends Model
{
    use HasFactory;

    //1-n avec articles
    public function article() { 
        return $this->belongsTo(Article::class);
    }

    //1-n avec commandes
    public function commande() { 
        return $this->belongsTo(Commande::class);
    }
}
