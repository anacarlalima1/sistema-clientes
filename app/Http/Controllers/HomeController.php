<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'change_pass'], ['except' => ['verificarMatricula', 'atualizarUsuario', 'gerador']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::id()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (!$this->missingInformation($user)) {
            return redirect("/user/update");
        }

        return view('home.home', ['user' => $user]);
    }
}
