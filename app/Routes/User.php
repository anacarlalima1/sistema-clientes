<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

class User
{
    public static function CadastroDeClientes($middlware = [], $prefix = '/clientes')
    {
        return Route::group(['middleware' => $middlware, 'prefix' => $prefix], function () {
            Route::get('/listar-clientes', [\App\Http\Controllers\user\UserController::class, 'listarClientes']);
            Route::get('/cliente', [\App\Http\Controllers\user\UserController::class, 'buscarClienteId']);
            Route::post('/cadastrar-cliente', [\App\Http\Controllers\user\UserController::class, 'cadastrarCliente']);
            Route::put('/editar-cliente', [\App\Http\Controllers\user\UserController::class, 'editarCliente']);
            Route::post('/deletar-cliente', [\App\Http\Controllers\user\UserController::class, 'deletarCliente']);
        });
    }
}
