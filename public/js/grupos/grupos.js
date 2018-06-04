$(document).ready(function () {
  let dataGroup;

  $('.modal').modal({
    startingTop: '0%',
    endingTop: '2%'
  });

  $('.modalGraficaGrupo').click(function(){
    let $this = $(this);
    dataGroup = $this.data('graphic-data');
    labelsG = $this.data('graphic-labels');
    crearGrafica(dataGroup, labelsG, 'graficaGrupo', 'bar');
  });

  $('.modalGraficaAlumno').click(function () {
    let $this = $(this);
    dataGroup = $this.data('graphic-data');
    labelsG = $this.data('graphic-labels');
    console.log(dataGroup);
    crearGrafica(dataGroup, labelsG, 'graficaAlumno', 'bar');
  });

  let alumnos;
  let idGrupo;

  $('.registrarCalificaciones').on('click', function(e) {
    alumnos = $(this).data('alumnos');
    idGrupo= $(this).data('id-grupo');

    console.log(idGrupo);

    $('.remove').remove();

    for(i = 0; i < alumnos.length; i++) {
      let row = $('<tr class="remove"/>');
      let tdNombre = $('<td>' + alumnos[i].datos_usuario.nombre + '</td>');
      let tdParcial1 = $('<td/>');
      let tdParcial2 = $('<td/>');
      let tdParcial3 = $('<td/>');
      let tdDesertor = $('<td/>');
      let centerDesertor = $('<center />');
      let inputHiddenId = $('<input type="hidden" id="id" value="' + alumnos[i].id + '" name="id[]">')
      let inputHiddenGrupoId = $('<input type="hidden" id="id-grupo" value="'+ idGrupo + '" name="id_grupo">')

      let divInputCalificacion1 = $('<div class="input-field col s12"/>');
      let inputCalificacion1 = $('<input id="calificacion1" name="calificacion1[]" type="text">');
      let labelCalificacion1 = $('<label for="calificacion1">Calificación</label>');
      let divInputFaltas1 = $('<div class="input-field col s12"/>');
      let inputFaltas1 = $('<input id="faltas1" name="faltas1[]" type="text">');
      let labelFaltas1 = $('<label for="faltas1">Faltas</label>');

      let divInputCalificacion2 = $('<div class="input-field col s12"/>');
      let inputCalificacion2 = $('<input id="calificacion2" name="calificacion2[]" type="text">');
      let labelCalificacion2 = $('<label for="calificacion2">Calificación</label>');
      let divInputFaltas2 = $('<div class="input-field col s12"/>');
      let inputFaltas2 = $('<input id="faltas2" name="faltas2[]" type="text">');
      let labelFaltas2 = $('<label for="faltas2">Faltas</label>');

      let divInputCalificacion3 = $('<div class="input-field col s12"/>');
      let inputCalificacion3 = $('<input id="calificacion3" name="calificacion3[]" type="text">');
      let labelCalificacion3 = $('<label for="calificacion3">Calificación</label>');
      let divInputFaltas3 = $('<div class="input-field col s12"/>');
      let inputFaltas3 = $('<input id="faltas3" name="faltas3[]" type="text">');
      let labelFaltas3 = $('<label for="faltas3">Faltas</label>');
      
      let inputDesertor = $('<input id="desertor' + i + '"name="desertor[]" value="'+alumnos[i].id + '" type="checkbox" class="filled-in">');
      let labelDesertor = $('<label for="desertor' + i + '"></label>');

      divInputCalificacion1.append(inputCalificacion1);
      divInputCalificacion1.append(labelCalificacion1);
      divInputFaltas1.append(inputFaltas1);
      divInputFaltas1.append(labelFaltas1);
      tdParcial1.append(divInputCalificacion1);
      tdParcial1.append(divInputFaltas1);

      divInputCalificacion2.append(inputCalificacion2);
      divInputCalificacion2.append(labelCalificacion2);
      divInputFaltas2.append(inputFaltas2);
      divInputFaltas2.append(labelFaltas2);
      tdParcial2.append(divInputCalificacion2);
      tdParcial2.append(divInputFaltas2);

      divInputCalificacion3.append(inputCalificacion3);
      divInputCalificacion3.append(labelCalificacion3);
      divInputFaltas3.append(inputFaltas3);
      divInputFaltas3.append(labelFaltas3);
      tdParcial3.append(divInputCalificacion3);
      tdParcial3.append(divInputFaltas3);

      centerDesertor.append(inputDesertor);
      centerDesertor.append(labelDesertor);

      tdDesertor.append(centerDesertor);

      row.append(inputHiddenId);
      row.append(inputHiddenGrupoId);
      row.append(tdNombre);
      row.append(tdParcial1);
      row.append(tdParcial2);
      row.append(tdParcial3);
      row.append(tdDesertor);

      $('#tabla-alumnos').append(row);
    }

    alumnos = null;
  });
  
});//Termina document ready

let ctx;

function crearGrafica(dataG, labelsG, elemento, tipo){
  let padre = $('#'+elemento).parent();
  $('#'+elemento).remove(); // this is my <canvas> element
  padre.append('<canvas id="' + elemento +'" style="max-height:525px;"><canvas>');
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