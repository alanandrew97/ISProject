$(function(){
    $('.modal').modal({
      startingTop: '0%',
      endingTop: '2%'
    });
    let url = $('#_url').val();

      //Funcion de editar maestro
  $(document).on('click', '.edit-edificio', function(e){
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

  $(document).on('click', '.edit-materia', function(e){
    let $this = $(this);
    let idEdificio = $this.data('edificio-id');
    let padre = $this.parents('.collapsible');

    let nombre = $('.nombre', padre).text();
    let clave = $('.clave', padre).text();
    let horasTeoria = $('.horasTeoria', padre).text();
    let horasPractica = $('.horasPractica', padre).text();
    let creditos = $('.creditos', padre).text();

    $('#modalEditarEdificio #nombre').val(nombre);
    $('#modalEditarEdificio #clave').val(clave);
    $('#modalEditarEdificio #creditos').val(creditos);
    $('#modalEditarEdificio #horasTeoria').val(horasTeoria);
    $('#modalEditarEdificio #horasPractica').val(horasPractica);
    
    $('#id-editar').val(idEdificio);

    Materialize.updateTextFields()
  });

  $(document).on('click', '.delete-materia', function(e){
    let id = $(this).data('edificio-id');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#id-eliminar').val(id);

    console.log(id);
    // $('#formEliminar').submit();
  });

  $(document).on('click', '.edit-semestre', function(e){
    let $this = $(this);
    let idEdificio = $this.data('edificio-id');
    let padre = $this.parents('.collapsible');

    let inicioParcial1 = $('.inicioParcial1', padre).text();
    let finParcial1 = $('.finParcial1', padre).text();
    let inicioParcial2 = $('.inicioParcial2', padre).text();
    let finParcial2 = $('.finParcial2', padre).text();
    let inicioParcial3 = $('.inicioParcial3', padre).text();
    let finParcial3 = $('.finParcial3', padre).text();
    let inicioPromedio = $('.inicioPromedio', padre).text();
    let finPromedio = $('.finPromedio', padre).text();

    $('#modalEditarEdificio #inicioParcial1').val(inicioParcial1);
    $('#modalEditarEdificio #finParcial1').val(finParcial1);
    $('#modalEditarEdificio #inicioParcial2').val(inicioParcial2);
    $('#modalEditarEdificio #finParcial2').val(finParcial2);
    $('#modalEditarEdificio #inicioParcial3').val(inicioParcial3);
    $('#modalEditarEdificio #finParcial3').val(finParcial3);
    $('#modalEditarEdificio #inicioPromedio').val(inicioPromedio);
    $('#modalEditarEdificio #finPromedio').val(finPromedio);

    
    $('#id-editar').val(idEdificio);

    Materialize.updateTextFields()
  });

  $(document).on('click', '.delete-semestre', function(e){
    let id = $(this).data('edificio-id');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#id-eliminar').val(id);

    // $('#formEliminar').submit();
  });

  $(document).ready(function() {
    $('select').material_select();
  });

  $(document).ready(function() {
    $('select').material_select();
  });

  // Funcion de eliminar campus
  $(document).on('click', '.delete-edificio', function(e){
    let id = $(this).data('edificio-id');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#id-eliminar').val(id);

    console.log(id);
    // $('#formEliminar').submit();
  });

  $(document).on('click', '.edit-grupo', function(e){
    let $this = $(this);
    let idEdificio = $this.data('edificio-id');
    let padre = $this.parents('.collapsible');

    let clave =  parseInt($('.clave', padre).text(), 10);
    let idMateria = $('.idMateria', padre).val();
    let idMaestro = $('.idMaestro', padre).val();
    let idAula = $('.idAula', padre).val();
    let idSemestre = $('.idSemestre', padre).val();

    $('#modalEditarGrupo #clave').val(clave);
    $('#modalEditarGrupo #materia').val(idMateria);
    $('#modalEditarGrupo #materia').material_select();
    $('#modalEditarGrupo #maestro').val(idMaestro);
    $('#modalEditarGrupo #maestro').material_select();
    $('#modalEditarGrupo #aula').val(idAula);
    $('#modalEditarGrupo #aula').material_select();
    $('#modalEditarGrupo #semestre').val(idSemestre);
    $('#modalEditarGrupo #semestre').material_select();
    

    
    $('#id-editar').val(idEdificio);

    Materialize.updateTextFields()
  });

  $(document).on('click', '.delete-grupo', function(e){
    let id = $(this).data('edificio-id');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#id-eliminar').val(id);

    console.log(id);
    // $('#formEliminar').submit();
  });

  $(document).on('click', '.alumnos-grupo', function(e){
    let id = $(this).data('edificio-id');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    //console.log(idDatosUsuario);
    $('#id-agregaralumnos').val(id);
    let numeroAlumnos = $('#total-alumnos').val();
    let alumnos = $(this).data('alumnos');

    for(i = 0; i < numeroAlumnos; i++) {
      $('#modalAgregarAlumnos #checkAlumnos' + i).prop('checked', false);
      for(j = 0; j < alumnos.length; j++) {
        if($('#modalAgregarAlumnos #checkAlumnos' + i).val() == alumnos[j].id) {
          $('#modalAgregarAlumnos #checkAlumnos' + i).prop('checked', true);
        }
      }
    }
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

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Aceptar',
    closeOnSelect: false // Close upon selecting a date,
  });

  $('#buscar-materia').on('keyup paste change', function(e) {
    getMaterias($(this).val());
  });

  $('#buscar-semestre').on('keyup paste change', function(e) {
    getSemestres($(this).val());
  });

  $('#buscar-todos-los-grupos').on('keyup paste change', function(e) {
    getGrupos($(this).val());
  });

  

  function getMaterias(query) {
    $.ajax({
      url: $('#_url').val() + '/escuela/buscarMateria',
      data: {
        query: query
      }
    }).done(function(data) {
      $('#lista-materias').html(data);
      $('.collapsible').collapsible();
    });
  }

  function getSemestres(query) {
    $.ajax({
      url: $('#_url').val() + '/escuela/buscarSemestre',
      data: {
        query: query
      }
    }).done(function(data) {
      $('#lista-semestres').html(data);
      $('.collapsible').collapsible();
    });
  }

  function getGrupos(query) {
    $.ajax({
      url: $('#_url').val() + '/escuela/buscarTodosLosGrupos',
      data: {
        query: query
      }
    }).done(function(data) {
      $('#lista-todos-los-grupos').html(data);
      $('.collapsible').collapsible();
    });
  }

  $('.modalGraficaGrupo').click(function () {
    let $this = $(this);
    dataGroup = $this.data('graphic-data');
    labelsG = $this.data('graphic-labels');
    crearGrafica(dataGroup, labelsG, 'graficaGrupo', 'bar');
  });
        
})

function crearGrafica(dataG, labelsG, elemento, tipo) {
  let padre = $('#' + elemento).parent();
  $('#' + elemento).remove(); // this is my <canvas> element
  padre.append('<canvas id="' + elemento + '" style="max-height:525px;"><canvas>');
  ctx = document.getElementById(elemento).getContext('2d');
  var groupChart = new Chart(ctx, {
    type: tipo,
    data: {
      labels: labelsG,
      datasets: [{
        label: '# de alumnos',
        data: dataG,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 2
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      fill: false,
    }
  });
}