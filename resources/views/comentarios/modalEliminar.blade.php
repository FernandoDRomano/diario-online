<div class="modal fade" tabindex="-1" role="dialog" id="modal-eliminar-Comentario">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="text-white text-center"> Confirmación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Eliminar Comentario</p>
      </div>
      <div class="modal-footer">
        {!! Form::open(['method' => 'delete', 'id' => 'Form-eliminar-comentario']) !!}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
        {{ Form::close() }}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
