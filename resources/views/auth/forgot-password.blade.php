
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
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="my-3">
                        ¿Ha olvidado su contraseña? No se preocupe. Indíquenos su dirección de correo electrónico y le enviaremos un enlace para restablecer la contraseña que le permitirá elegir una nueva.
                        
                    </div>
                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror">
                            
                            <label for="correo"><i class="fa-solid fa-at"></i> Correo Electrónico</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    <div class="my-4 position-relative">
                        <input type="submit" value="Enviar" name="submit" class="btn btn-negro w-100">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
