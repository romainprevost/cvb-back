<?php

namespace App\Http\Controllers;

use App\Models\partenaire;
use App\Http\Requests\StorepartenaireRequest;
use App\Http\Requests\UpdatepartenaireRequest;
use App\Http\Resources\PartenairesResource;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partenaire::all();
        $partnersInstitutionnels = Partenaire::query()->where('role', 'Partenaires institutionnels')->get();
        $partnersHelp = Partenaire::query()->where('role', 'Nous ont aidés')->get();
        $partnersPrivate = Partenaire::query()->where('role', 'Partenaires privés')->get();
        
        return response()->json([
            'partners' => PartenairesResource::collection($partners),
            'partnersInstitutionnels' => PartenairesResource::collection($partnersInstitutionnels),
            'partnersHelp' => PartenairesResource::collection($partnersHelp),
            'partnersPrivate' => PartenairesResource::collection($partnersPrivate)
        ]);
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
    public function store(StorepartenaireRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(partenaire $partenaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(partenaire $partenaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepartenaireRequest $request, partenaire $partenaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(partenaire $partenaire)
    {
        //
    }
}
