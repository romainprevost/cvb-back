<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Staff;
use App\Models\EquipeSenior;
use App\Http\Requests\Storeequipe_seniorRequest;
use App\Http\Requests\Updateequipe_seniorRequest;

class EquipeSeniorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($equipe_id)
    {
        $coachs = Staff::query()
        ->where('equipe_senior_id', $equipe_id)
        ->get();

        $equipe = EquipeSenior::query()
        ->where('id', $equipe_id)
        ->with(['joueurs' => function ($query) {
            $query->orderBy('nom', 'asc'); // Tri par ordre alphabétique du nom
        }])
        ->first();

        return Inertia::render('Equipe/Index', ['equipe' => $equipe, 'coachs' => $coachs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storeequipe_seniorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(equipeSenior $equipeSenior)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(equipeSenior $equipeSenior)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateequipe_seniorRequest $request, equipeSenior $equipeSenior)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(equipeSenior $equipeSenior)
    {
        //
    }
}
