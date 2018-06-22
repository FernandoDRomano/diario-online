@extends('plantilla.principal')

@section('titulo')
  Etiquetas
@endsection

@section('contenido')
    <div class="col-md-10 offset-md-1">

      <div class="row">
        <div class="panel-title">
          Listado de Etiquetas
        </div>
      </div>

      <div class="row separador">
        <div class="col-md-6">
          <a href="{{url('etiquetas/create')}}" class="btn btn-primary boton"><i class="fas fa-plus-circle"></i>Regitrar Categoria</a>
        </div>
        <div class="col-md-6">
          {{-- DISEÑO EL BUSCADOR --}}
          {!! Form::open(['route' => 'etiquetas.index', 'method'=>'get', 'class'=>'navbar-form pull-right']) !!}

              <div class="input-group">
                {!! Form::text('buscar', null, ['class' => 'form-control', 'placeholder' => 'Buscar Etiquetas...' , 'aria-describedby'=>'inputIcono']) !!}
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
                <td>Nombre</td>
                <td>Acciones</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($etiquetas as $etiqueta)
              <tr>
                <td>{{$etiqueta->id}}</td>
                <td>{{$etiqueta->nombre}}</td>
                <td>
                  <a href="{{url('etiquetas/'. $etiqueta->id . '/edit')}}" class="btn btn-warning text-white">
                    <i class="fas fa-pencil-alt"></i> Editar
                  </a>
                  <a href="" class="btn btn-danger" data-toggle="modal" data-target="#modal-eliminar-Etiqueta" data-name="{{$etiqueta->nombre}}" data-id="{{$etiqueta->id}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $etiquetas->links() }}

          {{-- INCLUIMOS EL MODAL PARA CONFIRMAR LA ELIMINACION  --}}
          @include('etiquetas.modalEliminar')

        </div>



  </div>
@endsection
