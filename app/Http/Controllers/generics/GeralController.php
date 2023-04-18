<?php

namespace App\Http\Controllers\generics;

use App\Http\Controllers\Controller;
use App\Models\Disciplina;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GeralController extends Controller
{
    public static function root()
    {
        $user = Auth::user();

        if (!$user) {
            return  view('home.home');
        }

        return  view('home.home');
    }

    public function verificacao()
    {
        if(!Auth::id()){
            // return redirect('/login');
            return  view('home.home');
        }

        return redirect(GeralController::root());
    }

    public function getUser()
    {
        return Auth::user();
    }

    public function getDisciplinas()
    {
        return Disciplina::where('status', 'Ativo')->get();
    }

    public function getEscolasUser()
    {
        return User::buscarEscolas(Auth::id());
    }

    public function getTurmasUser()
    {
        return User::buscarTurmas(Auth::id());
    }

    public function sair()
    {
        Auth::logout();
        return redirect('/');
    }
}
