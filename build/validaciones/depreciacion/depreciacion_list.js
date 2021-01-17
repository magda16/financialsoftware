$(document).ready(function(){
    
  $.ajax({
    type: 'POST',
    url: '../../build/controladores/lista_categoria_activos_fijos.php'
  })
  .done(function(lista_activo_categorias){
    $('#categoria').html(lista_activo_categorias)
  })
  .fail(function(){
    alert('Error al cargar la Pagina Lista Categorías')
  })

  $("#categoria").on('change', function() {

    var categoria = $("#categoria").val();

    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_activo_subcategorias.php',
      data: {'categoria': categoria}
    })
    .done(function(lista_activo_subcategorias){
      $('#tipo_bien').html(lista_activo_subcategorias)
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Subcategorías')
    })
     
  });

  $("#tipo_bien").on('change', function() {

    var subcategoria = $("#tipo_bien").val();

    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_activos_fijos.php',
      data: {'subcategoria': subcategoria}
    })
    .done(function(lista_activos_fijos){
      $('#activo_fijo').html(lista_activos_fijos)
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Activos Fijos')
    })
     
  });

  //Date picker
  $('#fecha').datepicker({
    autoclose: true
  })


 

});

$("#btngenerar").click(function(){
  //if($("#form_producto").valid()){

  var activo_fijo = $('#activo_fijo').val();
  
  $.ajax({
      type: 'POST',
      url: '../../pages/depreciacion/depreciacion_table.php',
      data: {'activo_fijo': activo_fijo}
    })
    .done(function(obtenerDatos){
      $('#div_depreciacion_table').html(obtenerDatos);    
    })
    .fail(function(){
      alert('Error al cargar la Pagina Depreciación')
    })

 /* }else{
    PNotify.info({
      title: 'Información',
      text: 'Revise que los datos esten completos.',
      styling: 'bootstrap3',
      icons: 'bootstrap3'
    });

  }*/
      
});