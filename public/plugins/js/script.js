$(document).ready(function() {

  $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });

    //PARA CARGAR LOS ARCHIVOS
    $("#file").fileinput({
      showCaption: false,
      dropZoneEnabled: false,
      browseClass: "btn btn-primary btn-lg",
      fileType: "any",
      minFileCount: 1,
      maxFileCount: 1,
      showRemove: true,
    });

    //checkbox
    $(".form-check-input").click(function() {
          if($(".form-check-input").is(':checked')) {
              $("#file").prop('disabled', false);
          } else {
              $("#file").prop('disabled', true);
          }
      });

      //PARA TRABAJAR CON EL PLUGINS CHOSEN
      $(".select-etiquetas").chosen({
          placeholder_text_multiple: 'Seleccione un Maximo de 3 Tags',
          max_selected_options: 3,
          search_contains: true
      });

      $(".select-categoria").chosen({
      });

      //PARA TRABAJAR CON EL EDITOR
      $('#contenido').trumbowyg({
        lang: 'es',
        btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen']
    ]
      });

      $('#mensaje').trumbowyg({
        lang: 'es',
        btns: [
        ['strong', 'em', 'del'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['removeformat'],
        ['fullscreen']
    ]
      });

    //PARA EL CAROUSEL
    $('#carousel').carousel();

  //PARA TRABAJAR CON EL MODAL-ELIMINAR EN EL CRUD DE CATEGORIAS
  $('#modal-eliminar-Categoria').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('name') // Extract info from data-* attribute
  var id = button.data('id')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
    modal.find('.modal-body').text('¿Está usted seguro de Eliminar la Categoria ' + recipient + ' ?')
  //IMPORTANTE PARA QUE FUNCIONE EL Eliminar
  //1) VOY A OBTENER DE REFERENCIA EL FORMULARIO DEL MODAL
  var form = $("#Form-eliminar-categoria")
  //2) CAMBIO EL ATRIBUTO ACTION CON EL ID QUE MANDO EN LA VISTA INDEX.BLADE.PHP
  form.attr('action', 'categorias/' + id)
  })

  //PARA TRABAJAR CON EL MODAL-ELIMINAR EN EL CRUD DE ETIQUETAS
  $('#modal-eliminar-Etiqueta').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('name') // Extract info from data-* attributes
  var id = button.data('id')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
    modal.find('.modal-body').text('¿Está usted seguro de Eliminar la Etiqueta ' + recipient + ' ?')
  //IMPORTANTE PARA QUE FUNCIONE EL Eliminar
  //1) VOY A OBTENER DE REFERENCIA EL FORMULARIO DEL MODAL
  var form = $("#Form-eliminar-etiqueta")
  //2) CAMBIO EL ATRIBUTO ACTION CON EL ID QUE MANDO EN LA VISTA INDEX.BLADE.PHP
  form.attr('action', 'etiquetas/' + id)
  })

  //PARA TRABAJAR CON EL MODAL-ELIMINAR EN EL CRUD DE LECTORES
  $('#modal-eliminar-Lector').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('name') // Extract info from data-* attributes
  var id = button.data('id')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
    modal.find('.modal-body').text('¿Está usted seguro de Eliminar el Lector ' + recipient + ' ?' + 'Advertencia: Se Eliminaran todos los Comentarios realizados por este Lector')
  //IMPORTANTE PARA QUE FUNCIONE EL Eliminar
  //1) VOY A OBTENER DE REFERENCIA EL FORMULARIO DEL MODAL
  var form = $("#Form-eliminar-lector")
  //2) CAMBIO EL ATRIBUTO ACTION CON EL ID QUE MANDO EN LA VISTA INDEX.BLADE.PHP
  form.attr('action', 'lectores/' + id)
  })

  //PARA TRABAJAR CON EL MODAL-ELIMINAR EN EL CRUD DE EMPLEADOS
  $('#modal-eliminar-Empleado').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('name') // Extract info from data-* attributes
  var id = button.data('id')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
    modal.find('.modal-body').text('¿Está usted seguro de Eliminar el Empleado ' + recipient + ' ?')
  //IMPORTANTE PARA QUE FUNCIONE EL Eliminar
  //1) VOY A OBTENER DE REFERENCIA EL FORMULARIO DEL MODAL
  var form = $("#Form-eliminar-empleado")
  //2) CAMBIO EL ATRIBUTO ACTION CON EL ID QUE MANDO EN LA VISTA INDEX.BLADE.PHP
  form.attr('action', 'empleados/' + id)
  })

  //PARA TRABAJAR CON EL MODAL-ELIMINAR EN EL CRUD DE NOTICIAS
  $('#modal-eliminar-Noticia').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('name') // Extract info from data-* attributes
  var id = button.data('id')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
    modal.find('.modal-body').text('¿Está usted seguro de Eliminar la Noticia ' + recipient + ' ?')
  //IMPORTANTE PARA QUE FUNCIONE EL Eliminar
  //1) VOY A OBTENER DE REFERENCIA EL FORMULARIO DEL MODAL
  var form = $("#Form-eliminar-noticia")
  //2) CAMBIO EL ATRIBUTO ACTION CON EL ID QUE MANDO EN LA VISTA INDEX.BLADE.PHP
  form.attr('action', 'noticias/' + id)
  })

  //PARA TRABAJAR CON EL MODAL-ELIMINAR EN EL CRUD DE COMENTARIOS
  $('#modal-eliminar-Comentario').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('name') // Extract info from data-* attributes
  var id = button.data('id')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
    modal.find('.modal-body').text('¿Está usted seguro de Eliminar el Comentario de ' + recipient + ' ?')
  //IMPORTANTE PARA QUE FUNCIONE EL Eliminar
  //1) VOY A OBTENER DE REFERENCIA EL FORMULARIO DEL MODAL
  var form = $("#Form-eliminar-comentario")
  //2) CAMBIO EL ATRIBUTO ACTION CON EL ID QUE MANDO EN LA VISTA INDEX.BLADE.PHP
  form.attr('action', '../../comentarios/' + id)
  })


  //PARA LOS ELEMENTOS DEL MENU DE CATEGORIAS
  $('.lista-categoria').hover(function() {
    $(this).css('background-color', '#90caf9');
    $(this).css('color', 'white');
    $(this).css('font-weight', 'bold')
  }, function() {
    $(this).css('background-color', '#F8F9FA');
    $(this).css('color', '#495158');
    $(this).css('font-weight', 'normal')
  });

});
