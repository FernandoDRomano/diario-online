@extends('plantilla.principal')

@section('titulo')
  Editar Categoria
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

    <div class="card">

      <div class="card-header bg-primary">
        <h4 class="text-white text-center">Editar Categoría</h4>
      </div>

      <div class="card-body">

        {!! Form::open(['action' => ['ControladorCategorias@update', 'id'=>$categoria->id] ,'method' => 'put']) !!}

        <div class="form-group">
          {!! Form::label('nombre', 'Nombre') !!}
          {!! Form::text('nombre', $categoria->nombre , ['class'=>'form-control', 'placeholder'=>'Ingrese el Nombre de su Categoría', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('descripcion', 'Descripción') !!}
          {!! Form::text('descripcion', $categoria->descripcion , ['class'=>'form-control', 'placeholder'=>'Ingrese una Descripción de la Categoría', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close()!!}

      </div>
    </div>


  </div>

@endsection
