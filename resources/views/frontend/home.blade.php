@extends('plantilla.principal')

@section('titulo')
  Bienvenido
@endsection

@section('contenido')

  <div class="col-md-4 offset-md-4">
    <div class="card">
      <div class="card-header text-center">
        <h5>Bienvenido</h5>
      </div>
      <div class="card-body text-center texto-bold">
        @if (Auth::user()->role->nombre == 'Miembro')
           {{Auth::user()->lector->nombreApellido}}
        @else
           {{Auth::user()->empleado->apellido . ', ' . Auth::user()->empleado->nombre}}
        @endif
      </div>
    </div>
  </div>


@endsection
