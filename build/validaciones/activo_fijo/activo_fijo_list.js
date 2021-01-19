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
        }
      },
      messages: {
        categoria: {
          required: "Por favor, seleccione categoría."
        },
        tipo_bien: {
          required: "Por favor, seleccione tipo de bien."
        }
      }
    });

  
  });
  
  $("#btngenerar").click(function(){
    if($("#form_activo_fijo").valid()){
  
      var tipo_bien = $('#tipo_bien').val();
      var estado = "Activo";

      var table = $('#example1').DataTable();
      $.ajax({
        type: 'POST',
        url: '../../pages/activo_fijo/activo_fijo_table.php',
        data: {'tipo_bien': tipo_bien, 'estado': estado}
      })
      .done(function(obtenerDatos){
        table.destroy();
        $('#div_activo_fijo_table').html(obtenerDatos);  
        table=$('#example1').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          }
        });
      })
      .fail(function(){
        alert('Error al cargar la Pagina Activo Fijo')
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


  function mostrar_activo(){
    if($("#form_activo_fijo").valid()){
      var tipo_bien = $('#tipo_bien').val();
      var estado = "Activo";
      // var user = $('#user').val();
      // var id_user = $('#id_usuario').val();
      var table = $('#example1').DataTable();
      $.ajax({
        type: 'POST',
        url: '../../pages/activo_fijo/activo_fijo_table.php',
        data: {'tipo_bien': tipo_bien, 'estado': estado}
        //data: {'estado': estado, 'user': user, 'id_user': id_user}
      })
      .done(function(obtenerDatos){
        table.destroy();
        $('#div_activo_fijo_table').html(obtenerDatos);  
        table=$('#example1').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          }
        });
      })
      .fail(function(){
        alert('Error al cargar la Pagina')
      })

    }else{
      PNotify.info({
        title: 'Información',
        text: 'Revise que los datos esten completos.',
        styling: 'bootstrap3',
        icons: 'bootstrap3'
      });

    }
  }
  
  function mostrar_inactivo(){
    if($("#form_activo_fijo").valid()){

      var tipo_bien = $('#tipo_bien').val();
      var estado = "Inactivo";
      // var user = $('#user').val();
      //  var id_user = $('#id_usuario').val();
      var table = $('#example1').DataTable();
      $.ajax({
        type: 'POST',
        url: '../../pages/activo_fijo/activo_fijo_table.php',
        data: {'tipo_bien': tipo_bien, 'estado': estado}
        //data: {'estado': estado, 'user': user, 'id_user': id_user}
      })
      .done(function(obtenerDatos){
        table.destroy();
        $('#div_activo_fijo_table').html(obtenerDatos);  
        table=$('#example1').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          }
        });
      })
      .fail(function(){
        alert('Error al cargar la Pagina')
      })

    }else{
      PNotify.info({
        title: 'Información',
        text: 'Revise que los datos esten completos.',
        styling: 'bootstrap3',
        icons: 'bootstrap3'
      });

    }
  }
  
  function editar_activo_fijo(id){
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
      $("#from_activo_fijo_edit").submit();
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

 

   function dar_baja_activo_fijo(id){

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
      $('#bandera').val("dar_baja");
      $('#baccion').val(id);
      $('#darBaja').modal({show:true});
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
  
  function dar_alta_activo_fijo(id){
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
      $('#bandera').val("dar_alta");
      $('#baccion').val(id);
      $('#darBaja').modal({show:true});
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

  $("#form_activo_fijo_baja_alta").validate({
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
      descripcion: {
        required: true,
        minlength: 3
      }
    },
    messages: {
      descripcion: {
        required: "Por favor, ingrese descripción.",
        minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
      }
    }
  });
  
  
  $("#btneditarmodal").click(function(){
    var descripcion = $("#observacion").val();

    if(descripcion != ""){
      var formData = new FormData($("#form_activo_fijo_baja_alta")[0]);
      $.ajax({
        type: 'POST',
        url: '../../build/controladores/crud_activo_fijo.php',
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
      })
      .done(function(resultado_ajax){
          alert(resultado_ajax);
        if(resultado_ajax === "Exito"){
          $("#btneditarmodal").attr("disabled",true);
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
                    location.href='../../pages/activo_fijo/activo_fijo_list.php';
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
                    location.href='../../pages/activo_fijo/activo_fijo_list.php';
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
      })
      .fail(function(){
        alert('Error al cargar la Pagina Activo Fijo')
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