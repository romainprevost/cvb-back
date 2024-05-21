<?php

use App\Http\Middleware\isAdmin;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    // return $request->user();
    return UserResource::make($request->user());
});

Route::get('users', function() {
    // $user = User::first();
    return UserResource::collection(User::paginate(5));
})->middleware(isAdmin::class);