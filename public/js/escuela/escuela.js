$(function(){
  $('.modal').modal({
    startingTop: '0%',
    endingTop: '2%'
  });
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
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    $('#campus_id').val(campusId);
    // $('#formEliminar').submit();
  });

  //Funcion de editar carrera
  $('.edit-carrera').on('click', function (e) {
    let $this = $(this);
    let carreraId = $this.data('carrera-id');
    let padre = $this.parents('.collapsible');

    let imgCarrera = $('.imgCarrera', padre).attr('src');
    let carreraNombre = $('.carreraNombre', padre).text();
    let carreraAbreviatura = $('.carreraAbreviatura', padre).text();
    let totalCreditos = $('.totalCreditos', padre).text();
    let estructuraGenericaCreditos = $('.estructuraGenericaCreditos', padre).text();
    let residenciaProfesionalCreditos = $('.residencia_profesional_creditos', padre).text();
    let servicioSocialCreditos = $('.servicio_social_creditos', padre).text();
    let actividadesComplementariasCreditos = $('.actividades_complementarias_creditos', padre).text();

    $('#modalEditarCarrera #imgEditarCarrera').attr('src',imgCarrera);
    $('#modalEditarCarrera #nombre').val(carreraNombre);
    $('#modalEditarCarrera #abreviatura').val(carreraAbreviatura);
    $('#modalEditarCarrera #totalCreditos').val(parseInt(totalCreditos));
    $('#modalEditarCarrera #estructuraGenericaCreditos').val(estructuraGenericaCreditos);
    $('#modalEditarCarrera #residenciaProfesionalCreditos').val(residenciaProfesionalCreditos);
    $('#modalEditarCarrera #servicioSocialCreditos').val(servicioSocialCreditos);
    $('#modalEditarCarrera #actividadesComplementariasCreditos').val(actividadesComplementariasCreditos);
    
    Materialize.updateTextFields()
  });

  // Funcion de eliminar carrera
  $('.delete-carrera').on('click', function (e) {
    let carreraId = $(this).data('carrera-id');
    // $('#formEliminar').attr('action', url + '/escuela/eliminarCampus/' + campusId);
    $('#campus_id').val(carreraId);
  });
});