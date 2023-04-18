<?php

namespace App\Routes\user;

use Illuminate\Support\Facades\Route;

class User
{
    public static function getUser($middleware = ['auth'], $prefix = 'user')
    {
        return Route::group(['middleware' => $middleware, 'prefix' => $prefix], function () {
            // Route::get('/atualizar-senha', [\App\Http\Controllers\user\UserController::class, 'index']);
            // Route::post('/update-password', [\App\Http\Controllers\user\UserController::class, 'updatePassword']);

            // Route::get('/update', [\App\Http\Controllers\user\UserController::class, 'update']);

            // Route::post('/update-user', [\App\Http\Controllers\user\UserController::class, 'updateUser']);
        });
    }
}
