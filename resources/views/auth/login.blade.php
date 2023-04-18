@extends('layouts.app_login')

@section('content')
    <div class="container-fluid p-0 overflow-hidden">

        @if(\Illuminate\Support\Facades\Session::get('message_login'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        <p>{{\Illuminate\Support\Facades\Session::remove('message_login')}}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="row p-2 login-container align-items-center">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 p-1 form-container">
                <div class="col-12 p-0">
                    <a class="mb-4 btn d-inline-flex align-items-center bg-white gray--text" href="/">
                        <img src="/icones/setinha_esquerda.svg" class="mr-2">
                        Voltar
                    </a>
                </div>
                <div class="mb-4 container2 bg-white rounded">
                    <img src="/assets/images/novo-logo-mais-saber.svg" alt="Mais Saber" class="logo-header">
                    <p class="mt-2 text-center font-weight-bold">Entre na plataforma</p>

                    <form method="POST" action="{{ route('login') }}" class="mt-3 w-100">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 pt-1 email-form">
                                <input id="matricula" type="text"
                                       class="form-control @error('matricula') is-invalid @enderror" name="matricula"
                                       value="{{ old('matricula') }}" required autocomplete="matricula"
                                       placeholder="Matrícula">

                                @error('matricula')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                                <p class="msg-matricula">Sua matrícula deve conter apenas números, sem traços, pontos ou caracteres especiais. Ex: 12312.</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 pt-1 password-form">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required
                                       autocomplete="current-password" placeholder="Senha">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <a href="/enviar-codigo">Esqueceu a senha?</a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-entrar d-block w-100">
                                    {{ __('Entrar') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <a class="mx-auto btn btn-cadastrar d-block w-full" href="/register">
                        Cadastre-se
                    </a>

                    <p class="termos-text">
                        Ao entrar no Mais Saber, você concorda com os nossos <span class="indigo--text">Termos de Uso</span> e <span class="indigo--text">Política de Privacidade</span>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>

</script>
