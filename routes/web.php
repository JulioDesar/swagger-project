<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsuarioController::class, 'index', 'edit']);
Route::get('/create', [UsuarioController::class, 'store']);
Route::get('/{id}/edit', [UsuarioController::class, 'edit']);

Route::post('/create', [UsuarioController::class, 'create']);
Route::put('/update/{id}', [UsuarioController::class, 'update']);
Route::delete('/delete/{id}', [UsuarioController::class, 'delete']);
