@extends('plantilla.principal')

@section('titulo')
  Vista previa: {{$noticia->titulo}}
@endsection

@section('contenido')

  <div class="col-md-10 offset-md-1">

    <div class="row">
        <h1 class="titulo-noticia">{{$noticia->titulo}}</h1>
    </div>

    <div class="row">
        <h3 class="subTitulo-noticia">{{$noticia->subTitulo}}</h3>
    </div>

    <div class="row">
      <h6><span>Categoría: {{$noticia->categoria->nombre}} | <i class="far fa-clock"> </i>{{'  ' .$noticia->created_at->diffForHumans()}}</span></h6>
    </div>


    <div class="row">
      @include('plantilla.partes.carousel')
    </div>

    <hr class="linea-separadora">

    <div class="row col-md-11 cuerpo-noticia">
      {{-- USO echo PARA PODER MOSTRAR EL CONTENIDO CON LAS ETIQUETAS IMPLEMENTADAS POR EL EDITOR --}}
      @php
        echo ($noticia->contenido);
      @endphp
    </div>

    <div class="row col-md-8 caja-autor">
        <div class="col-md-3">
          <img class="imagen-noticia" src="{{asset('imagenes/empleados/' . $noticia->empleado->foto)}}" alt="">
        </div>
        <div class="col-md-8 red">
          <h5 class="nombre-autor">Publicado Por: {{$noticia->empleado->apellido . ', ' . $noticia->empleado->nombre}}</h5>
        </div>
    </div>

    <div class="row div-etiquetas">
      <h4>Etiquetas:</h4>
      @foreach ($mi_etiquetas as $e)
        <a href="#" class="btn btn-outline-info etiqueta">{{$e}}</a>
      @endforeach
    </div>

    <div class="row col-md-6 offset-md-3">
      <a href="{{url('noticias')}}" class="btn btn-primary btn-block espacio">Volver a Noticias</a>
    </div>

  </div>



@endsection
