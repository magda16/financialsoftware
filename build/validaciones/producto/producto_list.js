$(document).ready(function(){

  $.ajax({
    type: 'POST',
    url: '../../build/controladores/lista_categoria_producto_list.php'
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
      }
    },
    messages: {
      categoria: {
        required: "Por favor, seleccione categoría."
      }
    }
  });

  $("#btngenerar").click(function(){
    if($("#form_producto").valid()){

    var categoria = $('#categoria').val();
    
    $.ajax({
        type: 'POST',
        url: '../../pages/producto/producto_table.php',
        data: {'categoria': categoria}
      })
      .done(function(obtenerDatos){
        $('#div_producto_table').html(obtenerDatos);    
      })
      .fail(function(){
        alert('Error al cargar la Pagina Producto')
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

function editar_producto(id){
  var notice = PNotify.notice({
    title: 'Advertencia',
    text: '¿Esta seguro que desea modificar el registro?',
    styling: 'bootstrap3',
    icons: 'bootstrap3',
    icon: true,
    hide: false,
    stack: {
      'dir1': 'down',
      'modal': true,
      'firstpos1': 25
    },
    modules: {
      Confirm: {
        confirm: true
      },
      Buttons: {
        closer: false,
        sticker: false
      },
      History: {
        history: false
      },
    }
  });
  notice.on('pnotify.confirm', function() {
    $("#id").val(id);
    $("#from_producto_edit").submit();
  });
  notice.on('pnotify.cancel', function() {
    PNotify.success({
      title: 'Éxito',
      text: 'Proceso Cancelado.',
      styling: 'bootstrap3',
      icons: 'bootstrap3'
    });
  });
  
 }

 function dar_baja_producto(id){
   
  var notice = PNotify.notice({
    title: 'Advertencia',
    text: '¿Esta seguro que desea dar de baja al registro?',
    styling: 'bootstrap3',
    icons: 'bootstrap3',
    icon: true,
    hide: false,
    stack: {
      'dir1': 'down',
      'modal': true,
      'firstpos1': 25
    },
    modules: {
      Confirm: {
        confirm: true
      },
      Buttons: {
        closer: false,
        sticker: false
      },
      History: {
        history: false
      },
    }
  });

  notice.on('pnotify.confirm', function() {
      var bandera = "dar_baja";
      $.ajax({
       type: 'POST',
       url: '../../build/controladores/crud_producto.php',
       data: {'bandera' : bandera, 'id' : id}
      })
      .done(function(resultado_ajax){
 
       if(resultado_ajax === "Exito"){
          
          PNotify.success({
            title: 'Éxito',
            text: 'Registro actualizado.',
            styling: 'bootstrap3',
            icons: 'bootstrap3',
            hide: false,
            modules: {
              Confirm: {
                confirm: true,
                buttons: [{
                  text: 'Aceptar',
                  primary: true,
                  click: function(notice) {
                    notice.close();
                    location.href='../../pages/producto/producto_list.php';
                  }
                }]
              },
              Buttons: {
                closer: false,
                sticker: false
              },
              History: {
                history: false
              }
            }
          });
          
       }
       if(resultado_ajax === "Error"){
        PNotify.error({
          title: 'Error',
          text: 'Sin conexión a la base de datos.',
          styling: 'bootstrap3',
          icons: 'bootstrap3'
        });
               
       }             
     })
     .fail(function(){
       alert('Error al cargar la Pagina')
     })
  });
  notice.on('pnotify.cancel', function() {
    PNotify.success({
      title: 'Éxito',
      text: 'Proceso Cancelado.',
      styling: 'bootstrap3',
      icons: 'bootstrap3'
    });
  });
  
 }


 function dar_alta_producto(id){
 
  var notice = PNotify.notice({
    title: 'Advertencia',
    text: '¿Esta seguro que desea activar el registro?',
    styling: 'bootstrap3',
    icons: 'bootstrap3',
    icon: true,
    hide: false,
    stack: {
      'dir1': 'down',
      'modal': true,
      'firstpos1': 25
    },
    modules: {
      Confirm: {
        confirm: true
      },
      Buttons: {
        closer: false,
        sticker: false
      },
      History: {
        history: false
      },
    }
  });

  notice.on('pnotify.confirm', function() {
      var bandera = "dar_alta";
      $.ajax({
       type: 'POST',
       url: '../../build/controladores/crud_producto.php',
       data: {'bandera' : bandera, 'id' : id}
      })
      .done(function(resultado_ajax){
 
       if(resultado_ajax === "Exito"){
          
          PNotify.success({
            title: 'Éxito',
            text: 'Registro actualizado.',
            styling: 'bootstrap3',
            icons: 'bootstrap3',
            hide: false,
            modules: {
              Confirm: {
                confirm: true,
                buttons: [{
                  text: 'Aceptar',
                  primary: true,
                  click: function(notice) {
                    notice.close();
                    location.href='../../pages/producto/producto_list.php';
                  }
                }]
              },
              Buttons: {
                closer: false,
                sticker: false
              },
              History: {
                history: false
              }
            }
          });
          
       }
       if(resultado_ajax === "Error"){
        PNotify.error({
          title: 'Error',
          text: 'Sin conexión a la base de datos.',
          styling: 'bootstrap3',
          icons: 'bootstrap3'
        });
               
       }             
     })
     .fail(function(){
       alert('Error al cargar la Pagina')
     })
  });
  notice.on('pnotify.cancel', function() {
    PNotify.success({
      title: 'Éxito',
      text: 'Proceso Cancelado.',
      styling: 'bootstrap3',
      icons: 'bootstrap3'
    });
  });
  
 }
 