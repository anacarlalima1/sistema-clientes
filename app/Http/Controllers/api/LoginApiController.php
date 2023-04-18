<?php

namespace App\Http\Controllers\Api;

use App\Models\api\Turma;
use App\Models\api\Escola;
use Illuminate\Http\Request;

class LoginApiController
{
    protected $escolas, $turmas;
    public function __construct (Escola $escolas, Turma $turmas) {
        $this->escolas =$escolas;
        $this->turmas =$turmas;
    }
    public function login(Request $request)
    {
        try{
            $array = [];

            $matricula = $request->input('matricula');
            $password = $request->input('password');

            $token = auth('api')->attempt([
                'matricula' => $matricula,
                'password' => $password
            ]);

            if(!$token) {
               return response()->json(['success' => false, 'messages' =>  'Usuário ou senha incorretos.'], 400);
            }

            $user = auth('api')->user();
            $turmas = $this->turmas->selectFirst($user->id_turma, ['id', 'descricao', 'status']);
            $escola = $this->escolas->selectFirst($user->id_escola, ['id', 'nome']);

            $array['user'] = $user;
            $array['turma'] = $turmas;
            $array['escola'] = $escola;
            $array['token'] = $token;
            $array['success'] = true;

            return response()->json($array);
        }catch (\Exception $exception){
            $array_errors = ['success' => false, 'messages' =>  'Servidor indisponível',
                'errors' => $exception->getMessage()];
            return response()->json($array_errors, 500);
        }
    }

    public function logout() {
        auth()->logout();
        return ['error' =>''];
    }
}
