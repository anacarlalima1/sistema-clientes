<?php

namespace App\Http\Controllers\perfil;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PerfilAlunoController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getDadosPerfil()
    {
        try {
            $aluno = User::select('user.id', 'user.nome', 'user.email', 'escola.nome as escola', 'turma.descricao as turma')
                ->join('escola', 'escola.id', '=', 'user.id_escola')
                ->join('turma', 'turma.id', '=', 'user.id_turma')
                ->where('user.id', auth()->id())
                ->first();

            return response()->json(['success' => true, 'aluno' => $aluno]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'exception' => $exception->getMessage()], 400);
        }
    }

    public function enviarEditarPerfil(Request $request)
    {
        try {
            $id_usuario = $request['id'] ?? auth()->id();

            $validation = $this->validatorPerfil($id_usuario, $request->all());
            if ($validation->fails()) {
                return $validation->errors();
            }
            $request['updated_at'] = now();

            $this->user->where('id', $id_usuario)->update($request->only('nome', 'email', 'password', 'updated_at'));

            return response()->json(['success' => true, 'message' => 'Suas informações foram alteradas com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'exception' => $exception->getMessage()], 400);
        }
    }

    protected function validatorPerfil($id_usuario, array $data)
    {
        return Validator::make($data, [
            'nome' => ['required', 'string', 'min:3', 'max:80'],
            'email' => ['required', 'email',
                Rule::unique('user', 'email')->ignore($id_usuario)],
            'password' => ['min:4', 'same:password_confirm'],
            'password_confirm' => ['min:4'],
        ], [
            'required' => 'Campo obrigatório!',
            'email.unique' => 'Já existe um usuário cadastrado com esse email!',
            'password.min' => 'Limite de caracteres não atingido',
            'password.same' => 'As senhas não coincidem',
            'nome.min' => 'Limite de caracteres não atingido',
        ]);
    }

}
