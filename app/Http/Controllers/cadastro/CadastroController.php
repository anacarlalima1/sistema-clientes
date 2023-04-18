<?php
namespace App\Http\Controllers\cadastro;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CadastroController extends Controller
{


    public function __construct()
    {
        $this->middleware('change_pass');
    }

    public function index()
    {
        if (!Auth::id()) {
            return redirect('/login');
        }

        $home = new HomeController();

        $user = Auth::user();

        return view('home.homeCadastro', ['user' => $user]);
    }
}
