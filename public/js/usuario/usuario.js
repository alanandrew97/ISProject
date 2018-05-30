$(function(){
    $('.modal').modal({
      startingTop: '0%',
      endingTop: '2%'
    });
    let url = $('#_url').val();

      //Funcion de editar maestro
  $('.edit-maestro').on('click', function(e){
    let $this = $(this);
    let id = $this.data('maestro-id');
    let padre = $this.parents('.collapsible');

    let nombre = $('.nombre', padre).text();
    let correo = $('.correo', padre).text();
    let apellido_paterno = $('.apellido_paterno').val();
    let apellido_materno = $('.apellido_materno').val();

    $('#modalEditarMaestro #nombre').val(nombre);
    $('#modalEditarMaestro #apellido_paterno').val(apellido_paterno);
    $('#modalEditarMaestro #apellido_materno').val(apellido_materno);
    $('#modalEditarMaestro #correo').val(correo);
    $('#modalEditarMaestro #id').val(id);
    Materialize.updateTextFields()
  });

  // Funcion de eliminar campus
  $('.delete-maestro').on('click', function(e){
    let idDatosUsuario = $(this).data('id-datos-usuario');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#iddatosusuario').val(idDatosUsuario);
    // $('#formEliminar').submit();
  });
})