<?php

namespace App\Http\Controllers;

use App\Models\lignes_commande;
use App\Http\Requests\Storelignes_commandeRequest;
use App\Http\Requests\Updatelignes_commandeRequest;

class LignesCommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Storelignes_commandeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(lignes_commande $lignes_commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lignes_commande $lignes_commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatelignes_commandeRequest $request, lignes_commande $lignes_commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lignes_commande $lignes_commande)
    {
        //
    }
}
