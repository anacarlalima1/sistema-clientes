<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageBinaryController;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function inicio()
    {
        return view('home.home');
    }
    public static function root()
    {
        return  view('home.home');
    }

    public function listarClientes()
    {
        try {
            $clientes = $this->user->buscarClientes();

            return response()->json(['success' => true, 'clientes' => $clientes]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'exception' => $exception->getMessage()], 400);
        }

    }
    public function buscarClienteId(Request $request)
    {
        try {

            $cliente = $this->user->where('id', $request['id'])->first();
            $cliente->foto = env('APP_URL') . "/" . $cliente->foto;

            return response()->json(['success' => true, 'cliente' => $cliente]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function cadastrarCliente(Request $request)
    {
        try {
            $binary = $request['imagem'];
            $dadosFoto = ImageBinaryController::uploadsFromBinary($binary, ['jpg', 'jpeg', 'png'], "cliente/foto");

            $dados['nome'] = $request['nome'];
            $dados['nome_social'] = $request['nome_social'];
            $dados['data_nasc'] = $request['data_nasc'];
            $dados['cpf'] = $request['cpf'];
            $dados['imagem'] = $dadosFoto['path'];
            $dados['created_at'] = now();
            $this->user->insert($dados);

            return response()->json(['success' => true, 'message' => 'Suas informações foram salvas com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'exception' => $exception->getMessage()], 400);
        }
    }

    public function editarCliente(Request $request)
    {
        try {
            if (isset($request['imagem'])) {
                $binary = $request['imagem'];
                $dadosFoto = ImageBinaryController::uploadsFromBinary($binary, ['jpg', 'jpeg', 'png'], "cliente/foto");
                $dados['imagem'] = $dadosFoto['path'];
            }

            $dados['nome'] = $request['nome'];
            $dados['nome_social'] = $request['nome_social'];
            $dados['data_nasc'] = $request['data_nasc'];
            $dados['cpf'] = $request['cpf'];
            $dados['updated_at'] = now();
            $this->user->where('id', $request['id'])->update($dados);

            return response()->json(['success' => true, 'message' => 'Suas informações foram alteradas com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'exception' => $exception->getMessage()], 400);
        }
    }

    public function deletarCliente(Request $request)
    {
        try {

            $this->user->where('id', $request['id'])->delete();

            return response()->json(['success' => true, 'message' => 'Informações deletadas com sucesso!']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'erros' => $exception->getMessage()], 500);
        }
    }
}
