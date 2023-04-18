@extends('layouts.app_login')

@section('content')
    @push('head')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="/css/register.css?v=2">
    @endpush
    <div class="container-fluid p-0 overflow-hidden">

        @error('message')
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
        @enderror

        <div class="row p-3 p-md-5 login-container align-items-center">
            <div class="col-12 col-sm-8 offset-sm-2 p-0 form-container">
                <div class="col-12 container2 bg-white rounded">
                    <div class="w-full d-flex align-items-center justify-content-between">
                        <div>
                            <a class="my-auto btn d-inline-flex align-items-center bg-dark-purple text-white nunito font-weight-bold border-radius-20"
                               href="/login">
                                <svg width="9" height="14" viewBox="0 0 9 14" fill="none"
                                     xmlns="http://www.w3.org/2000/svg" class="mr-3 d-inline-block">
                                    <path d="M7 2C6.45455 2.54545 3.43939 5.56061 2 7L7 12" stroke="white"
                                          stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Voltar
                            </a>
                        </div>
                        <img src="/assets/images/logo-mais-saber.png" alt="" style="width: 120px;">
                    </div>

                    <div class="w-full">
                        <p class="mt-2 font-xl nunito">Cadastre-se</p>

                        <div class="mb-0 d-flex align-items-center">
                            <div>
                                <article class="passos passos--ativo">1º</article>
                                <p>Passo</p>
                            </div>
                            <div>
                                <hr class="mt-0 passos--divisoria">
                            </div>

                            <div>
                                <article class="passos">2º</article>
                                <p>Passo</p>
                            </div>
                            <div>
                                <hr class="mt-0 passos--divisoria">
                            </div>

                            <div>
                                <article class="passos">3º</article>
                                <p>Passo</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row form-passos-1 overflow-auto">
                        <div class="col-12 pt-1 email-form">
                            <input
                                id="matricula"
                                type="text"
                                class="form-control @error('matricula') is-invalid @enderror"
                                name="matricula"
                                value="{{ old('matricula') }}"
                                autocomplete="matricula"
                                placeholder="Digite sua matrícula">
                            <p class="msg-matricula">Sua matrícula deve conter apenas números, sem traços, pontos ou
                                caracteres especiais. Ex: 12312.</p>

                            <span class="text-danger" role="alert">
                                    <strong id="matricula-error">@error('matricula') {{$message}} @enderror</strong>
                                </span>
                            <img src="/assets/images/matricula-user-icon.svg" alt="" class="matricula-icons">
                        </div>
                        <div class="col-12">
                            <a
                                onclick="abrirModalAlert('Prezado usuário.', 'Favor solicitar sua matrícula para seu professor, coordenador ou diretor.')"
                                class="link"
                            >
                                Não sei minha matrícula
                            </a>
                        </div>

                        <div class="col-12 mb-0 form-group">
                            <div class="col-12 px-0">
                                <button class="btn btn-entrar d-block w-100" id="btn-passo1"
                                        onclick="verificarMatricula()">
                                    {{ __('Próximo passo') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-0 ml-0 form-group row form-passos-2 form-passos--secundario form-passos--invisivel overflow-auto">
                        <div class="ml-0 mt-0 mt-md-4 pa-4 col-12 col-sm-8 col-md-6">
                            <div class="col-12 d-flex align-items-center justify-content-between">
                                <div>
                                    <a class="mt-2 mb-4 btn d-inline-flex align-items-center bg-dark-purple text-white nunito font-weight-bold border-radius-20"
                                       href="/login">
                                        <svg width="9" height="14" viewBox="0 0 9 14" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" class="mr-3 d-inline-block">
                                            <path d="M7 2C6.45455 2.54545 3.43939 5.56061 2 7L7 12" stroke="white"
                                                  stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                        Voltar
                                    </a>
                                </div>
                                <img src="/assets/images/logo-mais-saber.png" alt="" style="width: 120px;">
                            </div>
                            <div class="col-12">
                                <p class="mt-2 font-xl nunito">Cadastre-se</p>

                                <div class="mb-0 d-flex align-items-center">
                                    <div>
                                        <article class="passos passos--completo">1º</article>
                                        <p class="">Passo</p>
                                    </div>
                                    <div>
                                        <hr class="mt-0 passos--divisoria">
                                    </div>

                                    <div>
                                        <article class="passos passos--ativo">2º</article>
                                        <p class="">Passo</p>
                                    </div>
                                    <div>
                                        <hr class="mt-0 passos--divisoria">
                                    </div>

                                    <div>
                                        <article class="passos">3º</article>
                                        <p class="">Passo</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pt-1 email-form">
                                <input
                                    id="nome"
                                    type="text"
                                    class="form-control @error('nome') is-invalid @enderror"
                                    name="nome"
                                    value="{{ old('nome') }}"
                                    autocomplete="nome"
                                    placeholder="Digite seu nome"
                                >
                                <span class="text-danger" role="alert">
                                          <strong class="msg-error"
                                                  id="nome-error">@error('nome') {{$message}} @enderror</strong>
                                      </span>
                                <img src="/assets/images/matricula-user-icon.svg" alt="" class="matricula-icons">
                            </div>
                            <div class="col-12 pt-1 email-form">
                                <input
                                    id="email"
                                    type="text"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    placeholder="Digite seu email"
                                >
                                <span class="text-danger" role="alert">
                                      <strong class="msg-error"
                                              id="email-error">@error('email') {{$message}} @enderror</strong>
                                    </span>
                                <img src="/assets/images/matricula-email-icon.svg" alt="" class="matricula-icons">
                            </div>
                            <div class="col-12 pt-1 email-form">
                                <input
                                    id="senha"
                                    type="password"
                                    class="form-control @error('senha') is-invalid @enderror"
                                    name="password"
                                    value="{{ old('senha') }}"
                                    autocomplete="senha"
                                    placeholder="Digite sua senha"
                                >
                                <span class="text-danger" role="alert">
                                          <strong class="msg-error"
                                                  id="password-error">@error('password') {{$message}} @enderror</strong>
                                    </span>
                                <img src="/assets/images/matricula-lock-icon.svg" alt="" class="matricula-icons">
                            </div>
                            <div class="col-12 pt-1 email-form">
                                <input
                                    id="confirmar-senha"
                                    type="password"
                                    class="form-control @error('confirmar-senha') is-invalid @enderror"
                                    name="password_confirmation"
                                    value="{{ old('confirmar-senha') }}"
                                    autocomplete="confirmar-senha"
                                    placeholder="Confirme sua senha"
                                >
                                <span class="text-danger" role="alert">
                                        <strong class="msg-error" id="password_confirmation-error"></strong>
                                    </span>
                                <img src="/assets/images/matricula-lock-icon.svg" alt="" class="matricula-icons">
                            </div>
{{--                            <div class="col-12">--}}
{{--                                <a--}}
{{--                                    onclick="abrirModalAlert('Prezado usuário.', 'Favor solicitar sua matrícula para seu professor, coordenador ou diretor.')"--}}
{{--                                    class="link"--}}
{{--                                >--}}
{{--                                    Preciso de ajuda--}}
{{--                                </a>--}}
{{--                            </div>--}}

                            <div class="col-12 px-0 mb-0 form-group">
                                <div class="col-12 px-0">
                                    <button class="mt-3 btn btn-entrar d-block w-100" id="btn-passo2"
                                            onclick="verificarDados()">
                                        {{ __('Próximo passo') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="cadastro-bg-image col-sm-4 col-md-6"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

{{--    <!-- Modal -->--}}
{{--    <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog"--}}
{{--         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <h5 class="modal-title mb-3" id="modalAlert__titulo">Modal title</h5>--}}
{{--                    <h6 class="modal-description" id="modalAlert__descricao">Modal title</h6>--}}
{{--                </div>--}}
{{--                <div class="modal-footer pt-0 border-0">--}}
{{--                    <button type="button" class="mx-auto btn btn-primary" data-dismiss="modal">OK</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Modal -->
    <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title mb-3" id="modalAlert__titulo">Modal title</h5>
                    <h6 class="modal-description" id="modalAlert__descricao">Modal title</h6>
                </div>
                <div class="modal-footer pt-0 border-0">
                    <button type="button" class="mx-auto btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    @push('footer')
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
{{--        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap./in.js"></script>--}}

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="/js/auth/register.js?v=2"></script>
    @endpush
@endsection
