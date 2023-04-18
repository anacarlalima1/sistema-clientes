<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Auth::routes();

// use App\Routes\user\User;
// User::getUser();


Route::get('/', [App\Http\Controllers\generics\GeralController::class, 'verificacao']);
Route::get('/{any}', [App\Http\Controllers\generics\GeralController::class, 'verificacao']);

// Route::get('/sair', [App\Http\Controllers\generics\GeralController::class, 'sair']);

Route::get('non-authorized', function () {
    return response()->json(['success' => false, 'message' => 'Não autorizado'], 401);
})->name('nonauthorizaded');
