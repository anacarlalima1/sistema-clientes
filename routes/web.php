<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// Auth::routes();

 use App\Routes\User;
 User::CadastroDeClientes();


Route::get('/', [App\Http\Controllers\user\UserController::class, 'inicio']);
Route::get('/{any}', [App\Http\Controllers\user\UserController::class, 'inicio']);


Route::get('non-authorized', function () {
    return response()->json(['success' => false, 'message' => 'Não autorizado'], 401);
})->name('nonauthorizaded');
