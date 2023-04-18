<?php

namespace App\Http\authBackend;

use App\Models\Ano;
use App\Models\Disciplina;
use App\Models\Municipio;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $estados = Municipio::select('uf as nome')->where('status', 'Ativo')->groupBy('uf')->get();
        $estados = $this->foreachT($estados);
        $municipios = $this->foreachT(Municipio::all());
        $anos = $this->foreachT(Ano::all());;
        $disciplinas = $this->foreachT(Disciplina::all());
        return view('auth.register', compact('estados', 'municipios', 'anos', 'disciplinas'));
    }

    private function foreachT ($objetos) {
        $html ="";
        foreach ($objetos as $ob) {
            $html .="<option value='" . ($ob->id ?? $ob->nome) . "'>$ob->nome</option>";
        }

        return $html;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
