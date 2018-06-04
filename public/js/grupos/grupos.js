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

  
  $(document).on('click', '.registrarCalificaciones', function(e) {
    let alumnos = $(this).data('alumnos');
    console.log(alumnos);
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