$(function(){
    $('.modal').modal({
      startingTop: '0%',
      endingTop: '2%'
    });
    let url = $('#_url').val();

      //Funcion de editar maestro
  $('.edit-edificio').on('click', function(e){
    let $this = $(this);
    let idEdificio = $this.data('edificio-id');
    let padre = $this.parents('.collapsible');

    let nombre = $('.nombre', padre).text();
    let clave = $('.clave', padre).text();

    $('#modalEditarEdificio #nombre').val(nombre);
    $('#modalEditarEdificio #clave').val(clave);
    $('#id-editar').val(idEdificio);

    Materialize.updateTextFields()
  });

  $(document).ready(function() {
    $('select').material_select();
  });

  // Funcion de eliminar campus
  $('.delete-edificio').on('click', function(e){
    let id = $(this).data('edificio-id');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#id-eliminar').val(id);

    console.log(id);
    // $('#formEliminar').submit();
  });

  $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'Aceptar', // text for done-button
    cleartext: 'Limpiar', // text for clear-button
    canceltext: 'Cancelar', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
        
})