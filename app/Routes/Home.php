<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

class Home
{
    public static function getHomeProfessor($middlware = ['auth', 'professor'], $prefix = '/professor/home')
    {
        return Route::group(['middleware' => $middlware, 'prefix' => $prefix], function () {
            Route::get('/get-livros-dados', [\App\Http\Controllers\home\HomeProfessorController::class, 'getLivrosDados']);

            Route::post('/enviar-editar-foto-perfil', [\App\Http\Controllers\home\HomeProfessorController::class, 'editarFoto']);
            Route::post('/enviar-editar-perfil', [\App\Http\Controllers\home\HomeProfessorController::class, 'enviarEditarPerfil']);
        });
    }
    public static function getHomeEscola($middlware = ['auth', 'escola'], $prefix = '/escola/home')
    {
        return Route::group(['middleware' => $middlware, 'prefix' => $prefix], function () {
            Route::get('/get-livros-dados', [\App\Http\Controllers\home\HomeEscolaController::class, 'getLivrosDados']);

            Route::post('/enviar-editar-foto-perfil', [\App\Http\Controllers\home\HomeEscolaController::class, 'editarFoto']);
            Route::post('/enviar-editar-perfil', [\App\Http\Controllers\home\HomeEscolaController::class, 'enviarEditarPerfil']);
        });
    }
    public static function getHomeAluno($middlware = ['auth', 'aluno'], $prefix = '/aluno/home')
    {
        return Route::group(['middleware' => $middlware, 'prefix' => $prefix], function () {
            Route::get('/get-livros-dados', [\App\Http\Controllers\home\HomeAlunoController::class, 'getLivrosDados']);
        });
    }
}
