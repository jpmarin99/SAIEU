@extends('layouts.app')
<title>Registro</title>
@section('content')
    <head>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="./css/adminlte.min.css">
        {!! RecaptchaV3::initJs() !!}

    </head>
    <body>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <h3 class="card-title"> Registro (Solo usuarios administradores)</h3>

                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name" ></label>
                                    <div class="input-group mb-3">
                                        <input id="name" type="text" placeholder="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-solid fa-address-card"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Custom field: surname | type: text --}}


                                    {{-- Custom field: nick | type: text --}}



                                        <div class="form-group">
                                            <label for="email"></label>
                                            <div class="input-group mb-3">

                                                <input id="email" type="email" placeholder="Correo" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><span class="fas fa-envelope"></span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="password" ></label>

                                                <div class="input-group mb-3">
                                                    <input id="password" type="password" placeholder="Contrase??a" maxlength="8" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-lock"></span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="password-confirm"></label>
                                                    <div class="input-group mb-3">

                                                        <input id="password-confirm" type="password" placeholder="Confirmaci??n de contrase??a" maxlength="8" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <span class="fas fa-lock-open"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                        <div class="col-md-6">
                                                            {!! RecaptchaV3::field('register') !!}
                                                            @if ($errors->has('g-recaptcha-response'))
                                                                <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                                            @endif
                                                            <div class="form-group mt-4 mb-4">
                                                                <div class="captcha">
                                                                    <span>{!! captcha_img() !!}</span>
                                                            <div class="form-group mb-4">
                                                                <input id="captcha" type="text" class="form-control" placeholder="Ingrese Captcha" name="captcha">
                                                            </div>


                                                            <div class="form-group">
                                                                <div class="col-md-6 offset-md-4">
                                                                    <button type="submit" name="btnK" class="btn btn-primary">
                                                                        Registrarse
                                                                    </button>
                                                                </div>
                                                                @if (Route::has('login'))

                                                                    <a class="btn btn-link" href="{{ route('login') }}">
                                                                        ??Ya tienes una cuenta?, Inicia sesi??n ahora</a>

                                                                @endif



                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


    @endsection
    </body>
