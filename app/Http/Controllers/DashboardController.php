<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActualitesResource;
use App\Http\Resources\EquipesResource;
use App\Http\Resources\JoueursResource;
use App\Http\Resources\PartenairesResource;
use App\Http\Resources\UserResource;
use App\Models\Actualite;
use App\Models\EquipeJeune;
use App\Models\EquipeSenior;
use App\Models\Joueur;
use App\Models\Partenaire;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $staff = User::all();
        $joueurs = Joueur::all();
        $actualites = Actualite::orderBy('created_at', 'desc')->get();
        $equipesJeunes = EquipeJeune::all();
        $equipesSeniors = EquipeSenior::all();
        $partenaires = Partenaire::all();

        return response()->json([
            'staff' => UserResource::collection($staff),
            'joueurs' => JoueursResource::collection($joueurs),
            'actualites' => ActualitesResource::collection($actualites),
            'equipesJeunes' => EquipesResource::collection($equipesJeunes),
            'equipesSeniors' => EquipesResource::collection($equipesSeniors),
            'partenaires' => PartenairesResource::collection($partenaires)
        ]);
    }
}
