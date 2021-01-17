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

  $("#form_activo_fijo").validate({
    errorPlacement: function (error, element) {
          $(element).closest('.form-group').find('.help-block').html(error.html());
      },
      highlight: function (element) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
          $(element).closest('.form-group').find('.ic').removeClass('fa fa-check').addClass('fa fa-times-circle-o');
      },
      unhighlight: function (element, errorClass, validClass) {
          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
          $(element).closest('.form-group').find('.ic').removeClass('fa fa-times-circle-o').addClass('fa fa-check');
          $(element).closest('.form-group').find('.help-block').html('');
      },
    rules: {
      categoria: {
        required: true
      },
      tipo_bien: {
        required: true
      },
      activo_fijo: {
        required: true
      },
      fecha: {
        required: false
      }
    },
    messages: {
      categoria: {
        required: "Por favor, seleccione categoría."
      },
      tipo_bien: {
        required: "Por favor, seleccione tipo de bien."
      },
      activo_fijo: {
        required: "Por favor, seleccione activo fijo."
      },
      fecha: {
        required: "Por favor, ingrese fecha."
      }
    }
  });

});

$("#btncalcular").click(function(){
  if($("#form_activo_fijo").valid()){

    var activo_fijo = $('#activo_fijo').val();
   
    $("#id").val(activo_fijo);
    $("#form_activo_fijo").submit();

  }else{
    PNotify.info({
      title: 'Información',
      text: 'Revise que los datos esten completos.',
      styling: 'bootstrap3',
      icons: 'bootstrap3'
    });

  }
      
});
