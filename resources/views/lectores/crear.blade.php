@extends('plantilla.principal')

@section('titulo')
  Regístrate
@endsection

@section('contenido')

  <div class="col-md-6 offset-md-3">

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

    <div class="card">

      <div class="card-header bg-primary">
        <h4 class="text-white text-center">Regístrate</h4>
      </div>

      <div class="card-body">

        {!! Form::open(['action' => 'ControladorLectores@store', 'method' => 'post']) !!}

        <div class="form-group">
          {!! Form::label('nombreApellido', 'Nombre Completo') !!}
          {!! Form::text('nombreApellido', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su Nombre Completo ...', 'required']) !!}
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
          {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close()!!}

      </div>
    </div>


  </div>


@endsection
