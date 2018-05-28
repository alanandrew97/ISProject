$(function(){
  $('.modal').modal();
  let url = $('#_url').val();
  //Funcion de editar campus
  $('.edit-campus').on('click', function(e){
    let $this = $(this);
    let campusId = $this.data('campus-id');
    let padre = $this.parents('.collapsible');

    let campusNombre = $('.campusNombre', padre).text();
    let campusDireccion = $('.campusDireccion', padre).text();

    $('#modalEditarCampus #nombre').val(campusNombre);
    $('#modalEditarCampus #direccion').val(campusDireccion);
    $('#modalEditarCampus #campusId').val(campusId);
    Materialize.updateTextFields()
  });
  
  // Funcion de eliminar campus
  $('.delete-campus').on('click', function(e){
    let campusId = $(this).data('campus-id');
    $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    $('#campus_id').val(campusId);
  });
});