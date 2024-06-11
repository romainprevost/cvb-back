<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Actualite;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ActualitesResource;

class ActualiteController extends Controller
{

    public function index()
    {
        $actualites = Actualite::latest()->Paginate(12);
        $firstActu = Actualite::latest('created_at')->first();
        $latestActus = Actualite::latest('created_at')->take(6)->get();
        $othersActu = $latestActus->skip(1);
        // dd($actualites);
        return response()->json([
            'actualites' => ActualitesResource::collection($actualites),
            'firstActu' => ActualitesResource::make($firstActu),
            'othersActu' => ActualitesResource::collection($othersActu)
        ]);
    }

    public function store()
    {
        $data = request()->all();
        if (!empty($data['title']) && !empty($data['author'])) {
            $author = strip_tags($data['author']);
            $title = htmlspecialchars($data['title']);
            $content = htmlspecialchars($data['content']);

            $actualite = new Actualite();
            $actualite->titre = $title;
            $actualite->content = $content;
            $actualite->auteur = $author;
            $actualite->created_at = time();

            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                // Récupérez le nom du fichier
                $filename = $_FILES["image"]["name"];
                $uniqueFilename = time()."_".$filename;

                $destinationPath = 'assets/actus/';
                $imagePath = $destinationPath . $uniqueFilename;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                    // Succès
                    $actualite->photo = '/'.$imagePath;
                } else {
                    // Échec
                    echo "Failed to move the uploaded file.";
                }
            }           

            $actualite->save();
            return response()->json([
                'success' => 'Actuality created successfully', 
                'actualite' => ActualitesResource::make($actualite)
            ],201);

        }
    }

    public function show(actualite $actu)
    {
        return ActualitesResource::make($actu);

    }

    public function update(actualite $actualite)
    {
        //
    }

    public function destroy(actualite $actu)
    {
        // Vérifie si l'actualité a une photo autre que l'image par défaut
        if ($actu->photo !== '/assets/images/no-photo.png') {
            $filepath = public_path($actu->photo); // Récupère le chemin absolu du fichier
        }

        try{
            // Supprime le fichier si le chemin est défini et si le fichier existe
            
            $actu->delete();
            
            if (isset($filepath) && file_exists($filepath)) {
                unlink($filepath); //delete de l'image associée à l'actu pour éviter le stock de trop d'images
                
            }
            return response()->json(['success' => 'Actuality deleted successfully'], 201);
        }
        catch(Exception $ex){ // si le try ne fonctionne pas
            $errorMessage = $ex->getMessage(); // Récupération du message d'erreur
            return response()->json(['error' => $errorMessage], 500); // Par exemple, renvoyer une réponse JSON avec le message d'erreur et le code HTTP 500
        }

    }
}
