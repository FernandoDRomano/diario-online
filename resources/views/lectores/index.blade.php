@extends('plantilla.principal')

@section('titulo')
  Lectores del Díario
@endsection

@section('contenido')
    <div class="col-md-10 offset-md-1">

      <div class="row">
        <div class="panel-title">
          Listado de Lectores
        </div>
      </div>

      <div class="row separador">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
          {{-- DISEÑO EL BUSCADOR --}}
          {!! Form::open(['route' => 'lectores.index', 'method'=>'get', 'class'=>'navbar-form pull-right']) !!}

              <div class="input-group">
                {!! Form::text('buscar', null, ['class' => 'form-control', 'placeholder' => 'Buscar ...' , 'aria-describedby'=>'inputIcono']) !!}
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
                <td>Fecha de Nacimiento</td>
                <td>Estado</td>
                <td>Email</td>
              

                <td>Acciones</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($lectores as $lector)
              <tr>
                <td>{{$lector->id}}</td>
                <td>{{$lector->nombreApellido}}</td>
                <td>{{$lector->fechaNacimiento}}</td>
                <td>
                  @if ($lector->estado)
                    Activo
                  @else
                    Inactivo
                  @endif
                </td>
                <td>{{$lector->user->email}}</td>



                <td>
                  <a href="" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-eliminar-Lector" data-name="{{$lector->nombreApellido}}" data-id="{{$lector->id}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $lectores->links() }}

          {{-- INCLUIMOS EL MODAL PARA CONFIRMAR LA ELIMINACION  --}}
          @include('lectores.modalEliminar')

        </div>

  </div>
@endsection
