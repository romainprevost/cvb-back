<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;
use App\Models\User;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\EquipeJeuneController;
use App\Http\Controllers\EquipeSeniorController;
use App\Http\Controllers\PartenaireController;
use App\Http\Resources\UserResource;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    // return $request->user();
    $user = $request->user();
    return UserResource::make($user);
});

Route::get('/users', function() {
    $user = User::paginate(5);
    return UserResource::collection($user);
});

//---------------------------- Actualites --------------------------------
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actu.index');
Route::get('/actualite/{actu}', [ActualiteController::class, 'show'])->name('actu.show');
Route::post('/actualite/create', [ActualiteController::class, 'create'])->name('actu.create')->middleware('isAdmin');
Route::post('/actualite/delete/{actu}', [ActualiteController::class, 'destroy'])->name('actu.delete')->middleware('isAdmin');

// ----------------------------- Equipes ----------------------------------------
Route::get('/equipe/{equipe}', [EquipeSeniorController::class, 'index'])->name('equipe.index');
Route::get('/equipe/{equipe}', [EquipeJeuneController::class, 'index'])->name('equipe.index');


// ----------------------------- Partenaires ----------------------------------------
Route::get('/partenaires', [PartenaireController::class, 'index']);
