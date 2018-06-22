@extends('plantilla.principal')

@section('titulo')
  Empleados
@endsection

@section('contenido')
    <div class="col-md-10 offset-md-1">

      <div class="row">
        <div class="panel-title">
          Listado de Empleados
        </div>
      </div>

      <div class="row separador">
        <div class="col-md-6">
          <a href="{{url('empleados/create')}}" class="btn btn-primary boton"><i class="fas fa-plus-circle"></i> Regitrar Empleado</a>
        </div>
        <div class="col-md-6">
          {{-- DISEÑO EL BUSCADOR --}}
          {!! Form::open(['route' => 'empleados.index', 'method'=>'get', 'class'=>'navbar-form pull-right']) !!}

              <div class="input-group">
                {!! Form::text('buscar', null, ['class' => 'form-control', 'placeholder' => 'Buscar Empleado ...' , 'aria-describedby'=>'inputIcono']) !!}
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
                <td>Apellido y Nombre</td>
                <td>Fecha de Nacimiento</td>
                <td>DNI</td>

                <td>Estado</td>
                <td>Email</td>
                <td>cantidad</td>
                <td>Role</td>

                <td>Acciones</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($empleados as $empleado)
              <tr>
                <td>{{$empleado->id}}</td>
                <td>{{$empleado->apellido . ', ' . $empleado->nombre}}</td>
                <td>{{$empleado->fechaNacimiento}}</td>
                <td>{{$empleado->dni}}</td>

                <td>
                  @if ($empleado->estado == true)
                    Activo
                  @else
                    Inactivo
                  @endif
                </td>
                <td>{{$empleado->user->email}}</td>
                <td>{{$empleado->noticias->count()}}</td>
                <td>
                  @if ($empleado->user->role->nombre == 'Administrador')
                    <span class="badge badge-primary">{{$empleado->user->role->nombre}}</span>
                  @endif

                  @if ($empleado->user->role->nombre == 'Escritor')
                    <span class="badge badge-success">{{$empleado->user->role->nombre}}</span>
                  @endif

                  @if ($empleado->user->role->nombre == 'Moderador')
                    <span class="badge badge-dark">{{$empleado->user->role->nombre}}</span>
                  @endif
                </td>
                <td>
                  <a href="{{url('empleados/'. $empleado->id . '/edit')}}" class="btn btn-warning text-white btn-block">
                    <i class="fas fa-pencil-alt"></i> Editar
                  </a>
                  <a href="" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-eliminar-Empleado" data-name="{{$empleado->apellido}}" data-id="{{$empleado->id}}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                  </a>
                  <a href="{{url('empleados/' . $empleado->id  )}}" class="btn btn-success btn-block">
                    <i class="far fa-eye"></i> Detalle
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $empleados->links() }}

          {{-- INCLUIMOS EL MODAL PARA CONFIRMAR LA ELIMINACION  --}}
          @include('empleados.modalEliminar')

        </div>

  </div>
@endsection
