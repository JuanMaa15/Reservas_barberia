@extends('layouts.admin')

@section('content')
<div class="container py-5">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-5 d-flex mb-4 ">
            <div class="formulario gestion">
                <h3 class="titulos mb-4 text-center">Nuevo Barbero</h3>
                <form action="{{ route('auth.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" >
                            
                            <label for="nombre"> Nombre</label>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    <div class="my-3">        
                        <div class="position-relative">
                            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" >
                            
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
                            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" >
                            
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
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" >
                            
                            <label for="correo"> Correo Electrónico</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
                        
                    </div>

                    <div class="my-3">
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
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
                            <input type="password" id="password_confirmation" name="password_confirmation"  autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror">
                            <label for="password"> Repetir Contraseña</label>
                                @error('password_confirmation')
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

        <div class="col-sm-12 col-md-10 col-lg-7 mb-4 overflow-auto">
            <table class="table ">
                <thead class="table-dark">
                  <tr class="text-center">
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Opc</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->apellido }}</td>
                            <td>{{ $user->telefono }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center"><button class="btn btn-sm btn-danger btn-eliminar btn-modal-eliminar-usuario" value="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#modal-eliminar-usuario"><i class="fa-solid fa-trash text-white"></i></button></td>
                        </tr> 
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-5">
                <h3 class="titulos mb-4 text-center">Horas</h3>   
        </div>

        <div class="col-sm-12 col-md-10 col-lg-7">
            <table class="table">
                <thead class="table-dark">
                  <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Hora</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @foreach ($hours as $hour)
                        <tr class="text-center">
                            <td></td>
                            <td>{{ $hour->hora }}</td>
                        
                        </tr> 
                    @endforeach
                </tbody>
              </table>
              {{ $hours->links() }}
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal-eliminar-usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Esta seguro de eliminar el usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('admin.delete') }}" method="POST">
                    @csrf
                    <button type="submit" name="eliminar" class="btn btn-sm btn-danger btn-eliminar-usuario">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection