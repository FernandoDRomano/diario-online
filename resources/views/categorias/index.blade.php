@extends('plantilla.principal')

@section('titulo')
  Categorias
@endsection

@section('contenido')
    <div class="col-md-10 offset-md-1">

      <div class="row">
        <div class="panel-title">
          Listado de Categorías
        </div>
      </div>

      <div class="row separador">
        <div class="col-md-6">
          <a href="{{url('categorias/create')}}" class="btn btn-primary boton"><i class="fas fa-plus-circle"></i> Regitrar Categoría</a>
        </div>
        <div class="col-md-6">
          {{-- DISEÑO EL BUSCADOR --}}
          {!! Form::open(['route' => 'categorias.index', 'method'=>'get', 'class'=>'navbar-form pull-right']) !!}

              <div class="input-group">
                {!! Form::text('buscar', null, ['class' => 'form-control', 'placeholder' => 'Buscar Categorías...' , 'aria-describedby'=>'inputIcono']) !!}
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
                <td>Descripción</td>
                <td>Cantidad de Noticias</td>
                <td>Acciones</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($categorias as $categoria)
              <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->nombre}}</td>
                <td>{{$categoria->descripcion}}</td>
                <td>{{$categoria->noticias()->count()}}</td>
                <td>
                  <a href="{{url('categorias/'. $categoria->id . '/edit')}}" class="btn btn-warning text-white">
                    <i class="fas fa-pencil-alt"></i> Editar
                  </a>
                  <a href="" class="btn btn-danger " data-toggle="modal" data-target="#modal-eliminar-Categoria" data-name="{{$categoria->nombre}}" data-id="{{$categoria->id}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $categorias->links() }}

          {{-- INCLUIMOS EL MODAL PARA CONFIRMAR LA ELIMINACION  --}}
          @include('categorias.modalEliminar')

        </div>



  </div>
@endsection
