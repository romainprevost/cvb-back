<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
    public function store()
    {
        $validateData = request()->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $name = htmlspecialchars($validateData['name']);
        $email = htmlspecialchars($validateData['email']);
        $password = $validateData['password'];

        DB::beginTransaction();
        
        try {
            $user = User::create([
                'name' => $name, 
                'email' => $email, 
                'password' => $password
            ]);

            //confirmation de la transaction
            DB::commit();

            return response()->json(['success' => 'User created successfully', 'user' => $user], 201);
            
        } catch(Exception $ex){ // si le try ne fonctionne pas
            DB::rollBack(); //alors ça rollback
            $errorMessage = $ex->getMessage(); // Récupération du message d'erreur
            return response()->json(['error' => $errorMessage], 500); // Par exemple, renvoyer une réponse JSON avec le message d'erreur et le code HTTP 500
        }
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //validation
        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email'
        ]);

        // $data = request()->all();
        
        $userName = htmlspecialchars($validateData['name']);
        $userEmail = htmlspecialchars($validateData['email']);
        
        // dd($userId);
        DB::beginTransaction();

        try{
            // Mettre à jour les attributs de l'utilisateur avec les nouvelles valeurs
                $user->name = $userName;
                $user->email = $userEmail;
            // Enregistrer les modifications dans la base de données
                $user->save();
            DB::commit(); //enregistrement de l'opération
        }
        catch(Exception $ex){ // si le try ne fonctionne pas
            DB::rollBack(); //alors ça rollback
            $errorMessage = $ex->getMessage(); // Récupération du message d'erreur
            return response()->json(['error' => $errorMessage], 500); // Par exemple, renvoyer une réponse JSON avec le message d'erreur et le code HTTP 500
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try{
            $user->delete(); //delete

            return response()->json(['success' => 'User deleted successfully', 'user' => $user], 201);

        }
        catch(Exception $ex){ // si le try ne fonctionne pas
            $errorMessage = $ex->getMessage(); // Récupération du message d'erreur
            return response()->json(['error' => $errorMessage], 500); // Par exemple, renvoyer une réponse JSON avec le message d'erreur et le code HTTP 500
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //$request->only estrait les champs de la requet et créé un tableau associatif avec ces valeurs garantissant qu'elles soient passées à Auth::attempt
        //Auth::attempt tente de connecter l'utilisateur avec les info fournis. Il prend le tableau associatif et essaie de trouver un utilisateur correspondant dans la BDD
        if (!Auth::attempt($request->only('email', 'password'))) {
            //si echec, une exception est généree avec un message spécific
            throw ValidationException::withMessages([
                'email' => ["L'email ou le mot de passe est incorect"],
            ]);
        }

        $user = Auth::user();

        $request->session()->regenerate();

        // renvoi d'un reponse en Jonn pour le front suite à la connexion du user
        return response()->json([
            'loginSuccessful' => true,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
            'redirect_url' => '/dashboard'
        ]);    
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful']);
    }
}
