$(function(){
    $('.modal').modal({
      startingTop: '0%',
      endingTop: '2%'
    });
    let url = $('#_url').val();

      //Funcion de editar maestro
  $(document).on('click', '.edit-maestro', function(e){
    let $this = $(this);
    let idDatosUsuario = $this.data('id-datos-usuario');
    let apellidoPaterno = $this.data('apellido-paterno');
    let apellidoMaterno = $this.data('apellido-materno');
    let padre = $this.parents('.collapsible');

    let nombre = $('.nombre', padre).text();
    let correo = $('.correo', padre).text();

    console.log(apellidoPaterno);

    $('#modalEditarMaestro #nombre').val(nombre);
    $('#modalEditarMaestro #apellido_paterno').val(apellidoPaterno);
    $('#modalEditarMaestro #apellido_materno').val(apellidoMaterno);
    $('#modalEditarMaestro #correo').val(correo);
    $('#id_datos_usuario').val(idDatosUsuario);

    Materialize.updateTextFields()
  });

  $(document).ready(function() {
    $('select').material_select();
  });

  // Funcion de eliminar campus
  $(document).on('click', '.delete-maestro' , function(e){
    let idDatosUsuario = $(this).data('id-datos-usuario');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#iddatosusuario').val(idDatosUsuario);

    console.log(idDatosUsuario);
    // $('#formEliminar').submit();
  });

  $(document).on('click', '.edit-alumno', function(e){
    let $this = $(this);
    let idDatosUsuario = $this.data('id-datos-usuario');
    let nombre = $this.data('nombre');
    let apellidoPaterno = $this.data('apellido-paterno');
    let apellidoMaterno = $this.data('apellido-materno');
    let correo = $this.data('correo');
    let matricula = $this.data('matricula');
    let semestre = $this.data('semestre');
    let idCarrera = $this.data('id-carrera');
    let idTurno = $this.data('id-turno');
    let padre = $this.parents('.collapsible');

    $('#modalEditarMaestro #nombre').val(nombre);
    $('#modalEditarMaestro #apellido_paterno').val(apellidoPaterno);
    $('#modalEditarMaestro #apellido_materno').val(apellidoMaterno);
    $('#modalEditarMaestro #correo').val(correo);
    $('#modalEditarMaestro #matricula').val(matricula);
    $('#modalEditarMaestro #semestre').val(semestre);
    $('#modalEditarMaestro #carrera').val(idCarrera);
    $('#modalEditarMaestro #carrera').material_select();
    $('#modalEditarMaestro #turno').val(idTurno);
    $('#modalEditarMaestro #turno').material_select();
    $('#id_datos_usuario').val(idDatosUsuario);

    Materialize.updateTextFields()
  });

  $(document).on('click', '.delete-alumno' , function(e){
    let idDatosUsuario = $(this).data('id-datos-usuario');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#iddatosusuario').val(idDatosUsuario);

    console.log(idDatosUsuario);
    // $('#formEliminar').submit();
  });

  $(document).ready(function() {
    $('select').material_select();
  });

  $('#buscar-maestros').on('keyup paste change', function(e) {
    getMaestros($(this).val());
  });

  $('#buscar-alumnos').on('keyup paste change', function(e) {
    getAlumnos($(this).val());
  });

  function getMaestros(query) {
    $.ajax({
      url: $('#_url').val() + '/escuela/buscarMaestros',
      data: {
        query: query
      }
    }).done(function(data) {
      $('#lista-maestros').html(data);
      $('.collapsible').collapsible();
    });
  }

  function getAlumnos(query) {
    $.ajax({
      url: $('#_url').val() + '/escuela/buscarAlumnos',
      data: {
        query: query
      }
    }).done(function(data) {
      $('#lista-alumnos').html(data);
      $('.collapsible').collapsible();
    });
  }
})