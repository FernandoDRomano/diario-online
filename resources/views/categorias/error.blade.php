@extends('plantilla.principal')

@section('titulo')
  Error: No se puede Eliminar la Categoría
@endsection

@section('contenido')

  <div class="col-md-8 offset-md-2">

    <div class="card">
      <div class="card-header bg-danger text-center">
        ¡Advertencia!
      </div>
      <div class="card-body text-center">
        <p>¡No se puede Eliminar la Categoría <strong> {{$categoria->nombre}} </strong>, tiene Noticias Asociadas!</p>
        <p> Si desea continuar se Eliminaran todas las Noticias asociadas a esta Categoría </p>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-md-4 offset-md-4">
            {!! Form::open(['action'=>['ControladorCategorias@eliminar' , 'id'=>$categoria->id] , 'method'=>'delete']) !!}
              {!! Form::submit('Confirmar', ['class'=>'btn btn-danger']) !!}
              <a href="{{url('categorias')}}" class="btn btn-secondary " >Regresar</a>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>

  </div>

@endsection
