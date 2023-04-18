<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Ano;
use App\Models\Disciplina;
use App\Models\Municipio;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Http\authBackend\RegistersUsers;
use App\Models\Escola;
use App\Models\Matricula;
use App\Models\Turmas;
use App\Models\UserAno;
use App\Models\UserDisciplina;
use App\Models\UserEscola;
use App\Models\UserTurma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function verificarMatricula(Request $request)
    {
        try {

            if ($request['matricula'] === null) {
                return response()->json(['message' => 'Preencha a matrícula', 'success' => false], 400);
            }

            $user = User::where('matricula', $request['matricula'])->first();

            if ($user) {
                return response()->json(['message' => 'Matricula já utilizada', 'success' => false], 400);
            }

            $matricula = Matricula::where('matricula', $request['matricula'])->first();

            if (!$matricula) {
                return response()->json(['message' => 'Matrícula não encontrada', 'success' => false], 400);
            }
            return response()->json(['message' => 'Okay', 'success' => true]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'success' => false], 500);
        }
    }

    public function atualizarUsuario(Request $request)
    {
        if(!$request['email']){
            unset($request['email']);
        }
        $validation = $this->validationUsuario($request->all());
        if ($validation->fails()) {
            $message = $validation->errors()->getMessages();
            return response ()->json(['message' => 'Error', 'success' => false, 'errors' => $message], 400);
        }
        try {
            $verificarMatricula = $this->verificarMatricula($request);
            if (!$verificarMatricula->isSuccessful()){
                return response ()->json(['message' => $verificarMatricula['message'], 'success' => false], 400);
            }
            $matricula = Matricula::where('matricula', $request['matricula'])->first();

            $user = User::create([
                'nome' => $request['nome'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'matricula' => $request['matricula'],
                'id_privilegio' => $matricula->id_privilegio,
            ]);

            $isAluno = $matricula->id_privilegio == 3;

            $user = User::select('id')->where('matricula', $request['matricula'])->first();
            Auth::loginUsingId($user->id);

            return response()->json(['message' => "Success", "success" => true, 'isAluno' => $isAluno]);
        } catch (\Exception $e) {
            return response ()->json(['message' => "Error", 'success' => false, 'errors' => $e->getMessage()], 500);
        }
    }

    private function validationUsuario($data)
    {
        return Validator::make($data, [
            'nome' => 'required|max:255',
            'email' => 'max:255|unique:user|email:rfc',
            'password' => 'required|max:255|confirmed',
            'password_confirmation' => 'required|max:255',
            'matricula' => 'required|unique:user'
        ], [
            'nome.required' => 'Campo obrigatório',
            'nome.max' => 'Limite de caracteres atingido',
//            'email.required' => 'Campo obrigatório',
            'email.max' => 'Limite de caracteres atingido',
            'email.unique' => 'E-mail já utilizado',
            'matricula.unique' => 'Matrícula já utilizada',
            'email.email' => 'E-mail inválido',
            'password.required' => 'Campo obrigatório',
            'password.max' => 'Limite de caracteres atingido',
            'password.confirmed' => 'Senhas não coincidem',
            'password_confirmation.required' => 'Campo obrigatório',
        ]);
    }
}
