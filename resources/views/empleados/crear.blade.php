@extends('plantilla.principal')

@section('titulo')
  Nuevo Empleado
@endsection

@section('contenido')
  <div class="col-md-10 offset-md-1">

    @if ($errors->count() > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>
              {{$error}}
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="card espacio-abajo">

      <div class="card-header bg-primary">
        <h4 class="text-white text-center">Nuevo Empleado</h4>
      </div>

      <div class="card-body">

        {!! Form::open(['action' => 'ControladorEmpleados@store', 'method' => 'post' , 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
          {!! Form::label('apellido', 'Apellido') !!}
          {!! Form::text('apellido', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido...', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('nombre', 'Nombre') !!}
          {!! Form::text('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su Nombre...', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('dni', 'DNI') !!}
          {!! Form::number('dni', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su DNI...', 'required']) !!}
        </div>

        <div class="form-group">
          <label for="fechaNacimiento">Fecha de Nacimiento</label>
          <div class="input-group">
              <input type="text" class="form-control datepicker" name="fechaNacimiento">
              <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
              </div>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('email', 'Email') !!}
          {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su Email...', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('password', 'Contraseña') !!}
          {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Ingrese su Contraseña...', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('role_id', 'Role') !!}
          {!! Form::select('role_id', $roles, null, ['class' => 'form-control','placeholder' =>'Seleccione un Role' , 'required']) !!}
        </div>


        <div class="form-group">
          {!! Form::label('foto', 'Foto') !!}
          <input id="file" name="foto" type="file" class="file" data-preview-file-type="any" accept="image/*">
        </div>

        <div class="form-group">
          {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close()!!}

      </div>
    </div>
  </div>
@endsection
