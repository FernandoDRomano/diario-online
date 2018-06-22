@extends('plantilla.principal')

@section('titulo')
  Editar Empleado
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
        <h4 class="text-white text-center">Editar Empleado</h4>
      </div>

      <div class="card-body">

        {!! Form::open(['action' => ['ControladorEmpleados@update' , 'id'=>$empleado->id], 'method' => 'put' , 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
              {!! Form::label('apellido', 'Apellido') !!}
              {!! Form::text('apellido', $empleado->apellido, ['class'=>'form-control', 'placeholder'=>'Ingrese su Apellido...', 'required' ]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('nombre', 'Nombre') !!}
              {!! Form::text('nombre', $empleado->nombre , ['class'=>'form-control', 'placeholder'=>'Ingrese su Nombre...', 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('dni', 'DNI') !!}
              {!! Form::number('dni', $empleado->dni, ['class'=>'form-control', 'placeholder'=>'Ingrese su DNI...', 'required']) !!}
            </div>

            <div class="form-group">
              <label for="fechaNacimiento">Fecha de Nacimiento</label>
              <div class="input-group">
                  <input type="text" class="form-control datepicker" name="fechaNacimiento" value="{{$empleado->fechaNacimiento}}">
                  <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                  </div>
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('email', 'Email') !!}
              {!! Form::email('email', $empleado->user->email, ['class'=>'form-control', 'placeholder'=>'Ingrese su Email...', 'required']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('role_id', 'Role') !!}
              {!! Form::select('role_id', $roles, $empleado->user->role->id, ['class' => 'form-control','placeholder' =>'Seleccione un Role' , 'required']) !!}
            </div>


            <hr>
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                {!! Form::label('imagen_actual', 'Imagen Actual') !!}
                <div class="caja-imagen">
                  <img id="imagen_actual" name="imagen_actual" src="{{asset('imagenes/empleados/' . $empleado->foto)}}" alt="">
                </div>
              </div>

            </div>

            <div class="col-md-6">

              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    Actualizar Foto
                  </label>
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('foto', 'Foto') !!}
                <input id="file" name="foto" type="file" class="file" data-preview-file-type="any" accept="image/*" disabled>
              </div>
            </div>
          </div>

          <div class="col-md-4 offset-md-4">
            <div class="form-group">
              {!! Form::submit('Registrar', ['class'=>'btn btn-primary btn-block']) !!}
            </div>
          </div>


        {!! Form::close()!!}

      </div>
    </div>
  </div>

@endsection
