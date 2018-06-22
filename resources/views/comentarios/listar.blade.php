<div class="row">

  <div class="col-md-6 offset-md-3 margen-abajo">
    <div class="card-header">
      <h5 class="text-center">Comentarios</h5>
    </div>
  </div>

  <div class="col-md-8 margen-abajo">
    @foreach ($noticia->comentarios as $comentario)
      <div class="card card-remarcado espacio-abajo">
        <div class="card-header card-header-titulo">
          {{$comentario->lector->nombreApellido}} | <i class="far fa-clock"> </i>{{'  ' .$comentario->created_at->diffForHumans()}}
        </div>
        <div class="card-body">
              @php
                echo ($comentario->mensaje);
              @endphp
        </div>

        @if (Auth::check() and Auth::user()->role->nombre == 'Moderador')

            <div class="card-footer">
              <a href="" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-eliminar-Comentario" data-name="{{$comentario->lector->nombreApellido}}" data-id="{{$comentario->id}}">
                <i class="fas fa-trash-alt"></i> Eliminar
              </a>
            </div>

        @endif
      </div>

    @endforeach
  </div>


  @if (Auth::check() and Auth::user()->role->nombre == 'Miembro')

    @include('comentarios.crear')

  @endif

</div>

@include('comentarios.modalEliminar')
