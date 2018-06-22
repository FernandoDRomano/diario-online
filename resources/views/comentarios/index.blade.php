@extends('plantilla.principal')

@section('titulo')
  Ultimos Comentarios
@endsection

@section('contenido')

  <div class="col-md-10 offset-md-1">

    <div class="row">
      <div class="panel-title">
        Listado de Comentarios
      </div>
    </div>

    <div class="row separador">

    </div>

    <div class="row">
        <table class="table table-bordered">
          <thead class="cabecera-tabla">
            <tr>
              <td>ID</td>
              <td>Lector</td>
              
              <td>Mensaje</td>
              <td>Noticia</td>
              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($comentarios as $comentario)
            <tr>
              <td>{{$comentario->id}}</td>
              <td>{{$comentario->lector->nombreApellido}}</td>

              <td>
                @php
                  echo ($comentario->mensaje);
                @endphp
              </td>
              <td>{{$comentario->noticia->titulo}}</td>
              <td>
                <a href="{{url('comentarios/' . $comentario->noticia_id )}}" class="btn btn-success btn-block margen">
                  <i class="far fa-eye"></i> Detalle
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{ $comentarios->links() }}

        {{-- INCLUIMOS EL MODAL PARA CONFIRMAR LA ELIMINACION  --}}
        @include('categorias.modalEliminar')

      </div>



</div>

@endsection
