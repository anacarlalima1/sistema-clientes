<?php

namespace App\Routes;

use Illuminate\Support\Facades\Route;

class Perfil
{
    public static function getPerfilAluno($middlware = [], $prefix = '/perfil')
    {
        return Route::group(['middleware' => $middlware, 'prefix' => $prefix], function () {
            Route::get('/get-dados-perfil', [\App\Http\Controllers\perfil\PerfilAlunoController::class, 'getDadosPerfil']);
//            Route::get('/get-dados-escola-turma', [\App\Http\Controllers\estudante\EstudanteProfessorController::class, 'getDadosEscolaTurma']);
//            Route::get('/get-estudantes', [\App\Http\Controllers\estudante\EstudanteProfessorController::class, 'getEstudantes']);
//            Route::get('/get-matriculas/uf/{uf}', [\App\Http\Controllers\estudante\EstudanteProfessorController::class, 'getMatriculas']);
            Route::post('/enviar-editar-perfil', [\App\Http\Controllers\perfil\PerfilAlunoController::class, 'enviarEditarPerfil']);
        });
    }
}
