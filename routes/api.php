<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogTagController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsuarioController;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



route::resource('/usuario', UsuarioController::class);

route::resource('/blog', BlogController::class);

route::resource('/tags', TagController::class);

Route::get('/buscartag', [BlogController::class, 'buscartag']);

route::resource('/blogtag',BlogTagController::class);