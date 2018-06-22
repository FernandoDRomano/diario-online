@extends('plantilla.principal')

@section('titulo')
  Nueva Noticia
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
        <h4 class="text-white text-center">Nueva Noticia</h4>
      </div>

      <div class="card-body">

        {!! Form::open(['action' => 'ControladorNoticias@store', 'method' => 'post' , 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
          {!! Form::label('titulo', 'Título') !!}
          {!! Form::text('titulo', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el Título...', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('subTitulo', 'Sub Título') !!}
          {!! Form::text('subTitulo', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el Sub Título...', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('categoria_id', 'Categoría') !!}
          {!! Form::select('categoria_id', $categorias, null, ['class' => 'form-control select-categoria','placeholder' =>'Seleccione una Categoria' , 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('contenido', 'Contenido') !!}
          {!! Form::textarea('contenido', null, ['class'=>'form-control editor', 'placeholder'=>'Ingrese el Contenido...', 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('etiquetas', 'Etiquetas') !!}
          {!! Form::select('etiquetas[]', $etiquetas, null, ['class' => 'form-control select-etiquetas', 'multiple' , 'required']) !!}
        </div>

        <div class="form-group">
          {!! Form::label('foto', 'Foto') !!}
          <input id="file" name="imagenes[]" type="file" class="file" multiple=true data-preview-file-type="any" accept="image/*">
        </div>

        <div class="form-group">
          {!! Form::submit('Registrar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close()!!}

      </div>
    </div>
  </div>
@endsection
