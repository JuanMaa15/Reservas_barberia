@extends('layouts.admin')

@section('content')
<div class="container py-5">
    
    <div class="row justify-content-center">
        
        <div class="col px-sm-5 d-flex justify-content-center align-items-center">
            <div id="formulario-login" class="edit">
            @if (session('message'))
                <div class="alert alert-success mb-4">
                    {{ session('message') }}
                </div>
            @endif
                <h3 class="titulos mb-4 text-center">Editar mis datos</h3>
                <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $user->nombre }}">
                            
                            <label for="correo"> Nombre</label>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ $user->apellido }}">
                            
                            <label for="apellido"> Apellido</label>
                            @error('apellido')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ $user->telefono }}">
                            
                            <label for="telefono">Telefono</label>
                            @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                            
                            <label for="correo"> Correo Electrónico</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    @if (!empty($user->imagen))
                        <div class="my-3">
                            <div class="position-relative d-flex justify-content-center">
                                <img src="{{ route('admin.image', ['nombre_imagen' => $user->imagen]) }}" class="img-50" alt="">
                            </div>
                            
                        </div>
                    @endif

                    <div class="my-3">
                        <div class="position-relative">
                            <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror" >
                            
                                @error('imagen')
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

    <!-- Actualizar Contraseña  -->
    <div class="row my-5">
        <div class="col px-sm-5 d-flex justify-content-center align-items-center">
            <div class="formulario gestion">
                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif
                <h3 class="titulos mb-4 text-center">Editar contraseña</h3>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('put')
                    
                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            
                            <label for="current_password">Contraseña actual</label>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>      
                    </div>
                    

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            
                            <label for="password"> Contraseña</label>
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
                            
                            <label for="password_confirmation">Confirmar contraseña</label>
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