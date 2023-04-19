<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

class User
{
    public static function CadastroDeClientes($middlware = [], $prefix = '/cadastro')
    {
        return Route::group(['middleware' => $middlware, 'prefix' => $prefix], function () {
            Route::get('/clientes', [\App\Http\Controllers\user\UserController::class, 'listarClientes']);
            Route::get('/cliente', [\App\Http\Controllers\user\UserController::class, 'buscarClienteId']);
            Route::post('/cliente', [\App\Http\Controllers\user\UserController::class, 'cadastrarCliente']);
            Route::post('/editar-cliente', [\App\Http\Controllers\user\UserController::class, 'editarCliente']);
            Route::delete('/cliente', [\App\Http\Controllers\user\UserController::class, 'deletarCliente']);
        });
    }
}
