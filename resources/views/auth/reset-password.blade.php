
@extends('layouts.admin')

@section('header') @endsection

@section('content')
<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row">
        <div class="col px-3 d-flex justify-content-center align-items-center">
            <div id="formulario-login">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('password.store') }}" method="POST">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $request->email }}">
                            
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
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            
                            <label for="password"><i class="fa-solid fa-at"></i> Contraseña</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>      
                    </div>

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            
                            <label for="password_confirmation"><i class="fa-solid fa-at"></i>Confirmar contraseña</label>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>      
                    </div>

                    <div class="mt-4 position-relative">
                        <input type="submit" value="Restablecer contraseña" name="submit" class="btn btn-negro w-100">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection