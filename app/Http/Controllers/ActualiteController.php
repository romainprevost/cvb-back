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
        // return ActualitesResource::collection($actualites);


        // return Inertia::render('Actualites/Index', ['actualites' => $actualites]);
        
    }


    public function create()
    {
        $data = request()->all();
        if (!empty($data['title']) && !empty($data['content'])) {
            $author = strip_tags($data['author']);
            $title = htmlspecialchars($data['title']);
            $content = htmlspecialchars($data['content']);

            if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                // Récupérez le nom du fichier
                $filename = $_FILES["image"]["name"];
                $uniqueFilename = time()."_".$filename;

                $destinationPath = 'assets/actus/';
                $imagePath = $destinationPath . $uniqueFilename;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                    // Succès
                    $actualite = new Actualite();

                    $actualite->titre = $title;
                    $actualite->content = $content;
                    $actualite->auteur = $author;
                    $actualite->photo = $imagePath;
                    $actualite->created_at = time();

                    $actualite->save();
                } else {
                    // Échec
                    echo "Failed to move the uploaded file.";
                }
            }
        }
    }


    public function show(actualite $actu)
    {
        return ActualitesResource::make($actu);

    }


    public function edit(actualite $actualite)
    {
        //
    }


    public function update(actualite $actualite)
    {
        //
    }


    public function destroy(actualite $actu)
    {
        $actuId = strip_tags($actu['id']);
        $filepath = $actu['photo'];

        DB::beginTransaction();

        try{
            $actu = Actualite::findOrFail($actuId);
            unlink($filepath);
            $actu->delete();
        }
        catch(Exception $ex){ // si le try ne fonctionne pas
            DB::rollBack(); //alors ça rollback
            $errorMessage = $ex->getMessage(); // Récupération du message d'erreur
            return response()->json(['error' => $errorMessage], 500); // Par exemple, renvoyer une réponse JSON avec le message d'erreur et le code HTTP 500
        }

        DB::commit(); //enregistrement de l'opération
    }
}
