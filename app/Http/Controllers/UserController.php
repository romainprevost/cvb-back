<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = request()->all();

        $userId = $data['id'];
        $userName = $data['name'];
        $userEmail = $data['email'];

        DB::beginTransaction();

        try{
            $user = User::findOrFail($userId);

            // Mettre à jour les attributs de l'utilisateur avec les nouvelles valeurs
                $user->name = $userName;
                $user->email = $userEmail;

            // Enregistrer les modifications dans la base de données
                $user->save();

        }
        catch(Exception $ex){ // si le try ne fonctionne pas
            DB::rollBack(); //alors ça rollback
            $errorMessage = $ex->getMessage(); // Récupération du message d'erreur
            return response()->json(['error' => $errorMessage], 500); // Par exemple, renvoyer une réponse JSON avec le message d'erreur et le code HTTP 500
        }

        DB::commit(); //enregistrement de l'opération
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $data = request()->all();
        $userId = $data['id'];

        DB::beginTransaction();

        try{
            $user = User::findOrFail($userId);
            dd($user);
            $user->delete();
        }
        catch(Exception $ex){ // si le try ne fonctionne pas
            DB::rollBack(); //alors ça rollback
            $errorMessage = $ex->getMessage(); // Récupération du message d'erreur
            return response()->json(['error' => $errorMessage], 500); // Par exemple, renvoyer une réponse JSON avec le message d'erreur et le code HTTP 500
        }

        DB::commit(); //enregistrement de l'opération
        

    }
}