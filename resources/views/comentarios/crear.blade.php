<div class="col-md-8 margen-abajo">

  <div class="card">

    <div class="card-header bg-primary">
      <h6 class="text-white text-center">Nuevo Comentario</h6>
    </div>

    <div class="card-body">

      {!! Form::open(['action' => ['ControladorComentarios@store', 'noticia_id'=>$noticia->id], 'method' => 'post']) !!}

      <div class="form-group">
        {!! Form::label('mensaje', 'Dejanos tu Comentario') !!}
        {!! Form::textarea('mensaje', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su Mensaje...', 'required']) !!}
      </div>

      <div class="form-group">
        {!! Form::submit('Comentar', ['class'=>'btn btn-primary']) !!}
      </div>

      {!! Form::close()!!}

    </div>

  </div>

</div>
