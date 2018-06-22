@extends('plantilla.principal')

@section('title')
  Inicio
@endsection

@section('contenido')

  {{-- PARA LA COLUMNA DONDE VAN LAS CATEGORIAS Y LAS ETIQUETAS --}}
  <div class="col-md-3">

    <div class="row">

        <div class="col-md-12 menu">
          <div class="card-header text-center">
              <i class="fas fa-list-ul"></i> Categorías
          </div>

            <div class="list-group">
              @foreach ($categorias as $categoria)
                <a href="{{url('ver/noticia/categoria' , $categoria->id)}}" class="list-group-item list-group-item-action lista-categoria">
                  {{$categoria->nombre}}
                  <span class="badge badge-primary badge-pill">{{$categoria->noticias->count()}}</span>
                </a>
              @endforeach

          </div>
        </div>

    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card-header text-center">
            <i class="fas fa-tags"></i> Etiquetas
        </div>
        <div class="caja-etiqueta">
          @foreach ($etiquetas as $etiqueta)
            <a href="{{url('ver/noticia/etiqueta' , $etiqueta->id)}}" class="badge badge-info">
              {{$etiqueta->nombre}}
            </a>
          @endforeach
        </div>
      </div>
    </div>

  </div>

  {{-- PARA LA COLUMNA DONDE VAN LAS NOTICIAS --}}
  <div class="col-md-9 noticias">

    <div>
      {{-- VALIDO QUE LA VARIABLE CATEGORIA O ETIQUETA EXISTAN PARA MOSTRARLAS --}}
      {{-- CATEGORIA = $cat --}}
      @isset($cat)
        <div class="div-filtrado">
          <i class="fas fa-list-ul"></i> {{$cat->nombre}}
        </div>
      @endisset
      {{-- ETIQUETA = $etiq --}}
      @isset($etiq)
        <div class="div-filtrado">
          <i class="fas fa-tags"></i> {{$etiq->nombre}}
        </div>
      @endisset
    </div>

    {{-- VARIABLE QUE UTILIZO PARA CONTAR HASTA 3 NOTICIAS Y LUEGO BAJAR A LA PROXIMA SEGUIDILLA --}}
    @php
      $bandera = 0;
    @endphp

    {{-- RECORRO LAS NOTICIAS --}}
    @foreach ($noticias as $noticia)

      {{-- SI ES LA PRIMERA LA PONGO GRANDE COMO PORTADA --}}
      @if ($loop->first)
        <div class="card mb-3 caja">
          <div class="card-header">
            <a class="enlace" href="{{url('ver/noticia' , $noticia->id)}}">
              <h4 class="card-title">{{$noticia->titulo}}</h4>
            </a>
          </div>
          <a href="{{url('ver/noticia' , $noticia->id)}}">
            <img id="imagen-portada" class="card-img-top" src="{{asset('imagenes/noticias/' . $noticia->imagenes[0]->nombre)}}" alt="">
          </a>
          <div class="card-footer">
            <p class="card-text">
              <small class="text-muted">
                {{$noticia->categoria->nombre }} | <i class="far fa-clock"> </i> {{' ' .$noticia->created_at->diffForHumans() }} | <i class="far fa-comment-dots"></i> {{$noticia->comentarios->count()}}
              </small>
            </p>
          </div>
        </div>

      @else

        {{-- SI NO ES LA PRIMERA CREO UN NUEVO DIV CON LA CLASE card-deck --}}
        @if ($bandera == 0)
          <div class="card-deck">
        @endif

            {{-- DENTRO DE ESTE DIV CARGO HASTA 3 NOTICIAS --}}
            <div class="card caja">
              <div class="card-header">
                <a class="enlace" href="{{url('ver/noticia' , $noticia->id)}}">
                  <h5 class="card-title">{{$noticia->titulo}}</h5>
                </a>
              </div>
              <a href="{{url('ver/noticia' , $noticia->id)}}">
                <img class="card-img-top" src="{{asset('imagenes/noticias/' . $noticia->imagenes[0]->nombre)}}" alt="Card image cap">
              </a>
              <div class="card-body">
                <p class="card-text">{{$noticia->subTitulo}}</p>
              </div>
              <div class="card-footer">
                <p class="card-text">
                  <small class="text-muted">
                    {{$noticia->categoria->nombre }} | <i class="far fa-clock"> </i> {{' ' .$noticia->created_at->diffForHumans() }} | <i class="far fa-comment-dots"></i> {{$noticia->comentarios->count()}}
                  </small>
                </p>
              </div>
            </div>

        {{-- INCREMENTO EN 1 EL NUMERO DE NOTICIA --}}
        @php
          $bandera = $bandera + 1;
        @endphp

        {{-- SI YA LLEGO A 3 LAS NOTICIAS CIERRO EL card-deck Y LO VUELVO A EMPEZAR CON LA SIGUIENTE NOTICIA --}}
        @if ($bandera == 3)
          </div>
          @php
            $bandera = 0;
          @endphp
        @endif

      @endif



    @endforeach

  </div>

  <div class="col-md-2 offset-md-5">
    {{$noticias->links()}}
  </div>




@endsection
