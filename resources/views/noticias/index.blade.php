@extends('plantilla.principal')

@section('titulo')
  Noticias
@endsection

@section('contenido')

  <div class="col-md-10 offset-md-1">

    <div class="row">
      <div class="panel-title">
        Listado de Noticias
      </div>
    </div>

    <div class="row separador">
      <div class="col-md-6">
        <a href="{{url('noticias/create')}}" class="btn btn-primary" role="button"><i class="fas fa-plus-circle"></i> Registrar Noticia</a>
      </div>
      <div class="col-md-6">
        {{-- DISEÑO EL BUSCADOR --}}
        {!! Form::open(['route' => 'noticias.index', 'method'=>'get', 'class'=>'navbar-form pull-right']) !!}

            <div class="input-group">
              {!! Form::text('buscar', null, ['class' => 'form-control', 'placeholder' => 'Buscar Noticia ...' , 'aria-describedby'=>'inputIcono']) !!}
              <span class="input-group-text" id="inputIcono"><i class="fas fa-search"></i></span>
            </div>

        {!! Form::close() !!}
        {{-- FIN DEL BUSCADOR --}}
      </div>

    </div>

    <div class="row">
        <table class="table table-bordered">
          <thead class="cabecera-tabla">
            <tr>
              <td>ID</td>
              <td>Título</td>
              <td>Fecha</td>
              <td>Categoria</td>
              <td>Empleado</td>



              <td>Acciones</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($noticias as $noticia)
            <tr>
              <td>{{$noticia->id}}</td>
              <td>{{$noticia->titulo}}</td>
              <td>{{$noticia->fecha}}</td>
              <td>{{$noticia->categoria->nombre}}</td>
              <td>{{$noticia->empleado->apellido .', '.$noticia->empleado->nombre}}</td>


              <td>
                @if (Auth::user()->empleado->id == $noticia->empleado_id or Auth::user()->role->nombre == 'Administrador')
                  <a href="{{url('noticias/'. $noticia->id . '/edit')}}" class="btn btn-warning text-white btn-block">
                    <i class="fas fa-pencil-alt"></i> Editar
                  </a>
                  <a href="" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-eliminar-Noticia" data-name="{{$noticia->titulo}}" data-id="{{$noticia->id}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </a>
                @else

                  <a href="{{url('noticias/'. $noticia->id . '/edit')}}" class="btn btn-warning disabled text-white btn-block">
                    <i class="fas fa-pencil-alt"></i> Editar
                  </a>
                  <a href="" class="btn btn-danger disabled btn-block" data-toggle="modal" data-target="#modal-eliminar-Noticia" data-name="{{$noticia->titulo}}" data-id="{{$noticia->id}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </a>

                @endif

                <a href="{{url('noticias/' . $noticia->id  )}}" class="btn btn-success btn-block">
                  <i class="far fa-eye"></i> Detalle
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{ $noticias->links() }}

        {{-- INCLUIMOS EL MODAL PARA CONFIRMAR LA ELIMINACION  --}}
        @include('noticias.modalEliminar')

      </div>

</div>

@endsection
