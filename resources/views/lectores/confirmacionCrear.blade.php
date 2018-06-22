@extends('plantilla.principal')

@section('titulo')
  Felicidades
@endsection

@section('contenido')
    <div class="col-md-m4 offset-md-4">
        <div class="card">
          <div class="card-header bg-primary">
            <h3 class="text-white text-center">¡Felicidades!</h3>
          </div>
          <div class="card-body">
            <p class="card-text">!Felicidades tu Usuario fue Creado con Exito¡</p>
          </div>
          <div class="card-footer">
            <a href="{{url('login')}}" class="btn btn-primary btn-block">Ingresar</a>
          </div>
        </div>
    </div>

@endsection
