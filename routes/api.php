<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;
use App\Models\User;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipeJeuneController;
use App\Http\Controllers\EquipeSeniorController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

//---------------------------- Dashboard Admin --------------------------------
Route::get('/cvb-admin', [ActualiteController::class, 'index'])->name('actu.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('actu.index');
// ->middleware(['auth', 'verified'])->name('dashboard')

//---------------------------- User --------------------------------
Route::post('/user/update/{staffId}', [UserController::class, 'update'])->name('staff.update');
Route::post('/user/delete/{staffId}', [UserController::class, 'destroy'])->name('staff.delete');

//---------------------------- Profil --------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//---------------------------- Actualites --------------------------------
Route::get('/actualites', [ActualiteController::class, 'index'])->name('actu.index');
Route::get('/actualite/{actu}', [ActualiteController::class, 'show'])->name('actu.show');
Route::post('/actualite/create', [ActualiteController::class, 'store'])->name('actu.store');
Route::post('/actualite/delete/{actu}', [ActualiteController::class, 'destroy'])->name('actu.delete');

// ----------------------------- Equipes ----------------------------------------
Route::get('/equipe-senior/{equipe_id}', [EquipeSeniorController::class, 'index'])->name('equipe.index');


// ----------------------------- Partenaires ----------------------------------------
Route::get('/partenaires', [PartenaireController::class, 'index']);
