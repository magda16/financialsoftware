$(document).ready(function(){



  $.ajax({
    type: 'POST',
    url: '../../build/controladores/lista_categorias.php'
  })
  .done(function(lista_categorias){
    $('#categoria').html(lista_categorias)
  })
  .fail(function(){
    alert('Error al cargar la Pagina Lista Categorías')
  })

  $("#form_producto").validate({
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
      producto: {
        required: true
      }
    },
    messages: {
      categoria: {
        required: "Por favor, seleccione categoría."
      },
      producto: {
        required: "Por favor, seleccione producto."
      }
    }
  });

  $("#categoria").on('change', function() {

    var categoria = $("#categoria").val();

    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_categoria_productos.php',
      data: {'categoria': categoria}
    })
    .done(function(lista_categoria_productos){
      $('#producto').html(lista_categoria_productos)
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Productos')
    })
     
  });

  $("#btngenerar").click(function(){
    if($("#form_kardex").valid()){

    var producto = $('#producto').val();
    
    $.ajax({
        type: 'POST',
        url: '../../pages/inventario/kardex_table.php',
        data: {'producto': producto}
      })
      .done(function(obtenerDatos){
        $('#div_kardex_table').html(obtenerDatos);    
      })
      .fail(function(){
        alert('Error al cargar la Pagina Kardex')
      })

    }else{
      PNotify.info({
        title: 'Información',
        text: 'Revise que los datos esten completos.',
        styling: 'bootstrap3',
        icons: 'bootstrap3'
      });

    }
        
  });

});