@extends('layouts.admin')

@section('header') @endsection

@section('content')
<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row">
        <div class="col d-flex flex-column justify-content-center align-items-center mb-4">
            <h2 class="nombre-grande-empresa text-center">Sweed<span>Tood</span></h2>
            <div class="cont-img-logo logo-grande logo-animacion">
                <img src="{{ asset('img/logo-img.png') }}" alt="">
            </div>
        </div>
        <div class="col px-5 d-flex justify-content-center align-items-center mb-4">
            <div id="formulario-login">
                <h3 class="titulos mb-5 text-center">Iniciar Sesión</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                            
                            <label for="correo"><i class="fa-solid fa-at"></i> Correo Electrónico</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    <div class="my-3">
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" >
                            <label for="password"><i class="fa-solid fa-lock"></i> Contraseña</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    </div>

                    <div class="my-4 position-relative">
                        <input type="submit" value="Ingresar" name="submit" class="btn btn-negro w-100">
                    </div>
                    <a href="{{ route('password.request') }}" class="links">¿Olvidates tu contraseña? Da click aquí para recuperarla.</a>
                    <div class="mb-4 mt-5 position-relative">

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection