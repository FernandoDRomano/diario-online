@extends('plantilla.principal')

@section('titulo')
  Detalles del Empleado
@endsection

@section('contenido')

  <div class="col-md-10 offset-md-1">
    <div class="card espacio-abajo">

      <div class="card-header bg-primary">
        <h4 class="text-white text-center">Detalles del Empleado</h4>
      </div>

      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {!! Form::label('apellido', 'Apellido') !!}
              {!! Form::text('apellido', $empleado->apellido, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido...', 'required' , 'disabled']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('nombre', 'Nombre') !!}
              {!! Form::text('nombre', $empleado->nombre , ['class'=>'form-control', 'placeholder'=>'Ingrese su Nombre...', 'required', 'disabled']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('dni', 'DNI') !!}
              {!! Form::number('dni', $empleado->dni, ['class'=>'form-control', 'placeholder'=>'Ingrese su DNI...', 'required', 'disabled']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('fechaNacimiento', 'Fecha de Nacimiento') !!}
              {!! Form::text('fechaNacimiento', $empleado->fechaNacimiento, ['class'=>'form-control', 'placeholder'=>'Ingrese su Email...', 'required', 'disabled']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('email', 'Email') !!}
              {!! Form::email('email', $empleado->user->email, ['class'=>'form-control', 'placeholder'=>'Ingrese su Email...', 'required', 'disabled']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('role', 'Role') !!}
              {!! Form::text('role', $empleado->user->role->nombre, ['class'=>'form-control', 'placeholder'=>'Ingrese su Email...', 'required', 'disabled']) !!}
            </div>
          </div>
          <div class="col-md-6">
            <div class="caja-imagen">
              <img src="{{asset('imagenes/empleados/' . $empleado->foto)}}" alt="">
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-4 offset-md-4">
            <div class="form-group">
              <a href="{{url('empleados')}}" class="btn btn-primary btn-block">Volver</a>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>

@endsection
