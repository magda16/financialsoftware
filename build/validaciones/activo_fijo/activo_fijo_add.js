$(document).ready(function(){
  
    $("#divcantidad_lote").hide();
    $("#div_anios_uso").hide();

    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_activo_categorias.php'
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

    $('#tipo_bien').on('change', function(){
      var tipo_bien = $('#tipo_bien').val();
      $.ajax({
        type: 'POST',
        url: '../../build/controladores/obtener_codigo_inventario.php',
        data: {'tipo_bien':tipo_bien}
      })
      .done(function(obtenerDatos){
        var datos = eval(obtenerDatos);
        $('#codigo_inv').val(datos[3]+"-"+datos[0]+"-"+datos[1]);
        $('#correlativo').val(datos[2]);
      })
      .fail(function(){
        alert('Hubo un error al cargar el Tipo de Bien')
      })
    });

    //Date picker
    $('#fecha_adquisicion').datepicker({
      autoclose: true
    })

    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_proveedores.php'
    })
    .done(function(lista_proveedores){
      $('#proveedor').html(lista_proveedores)
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Proveedor')
    })

   // $('.select2').select2()

    $.validator.addMethod("letrasOespacio", function(value, element) {
        return /^[ a-záéíóúüñ]*$/i.test(value);
    }, "Ingrese sólo letras o espacios.");

    $.validator.addMethod("alfanumOespacio", function(value, element) {
        return /^[ a-z0-9áéíóúüñ.,]*$/i.test(value);
    }, "Ingrese sólo letras, números o espacios.");

    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9]*$/i.test(value);
    }, "Ingrese sólo números");

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
        descripcion: {
          required: true,
          minlength: 3
        },
        observacion: {
          required: false,
          minlength: 3
        },
        marca: {
          required: true,
          minlength: 3
        },
        modelo: {
          required: false,
          minlength: 3
        },
        nserie: {
          required: true,
          minlength: 3
        },
        cantidad: {
          numero: true,
          required: true,
          minlength: 1
        },
        fecha_adquisicion: {
          required:true,
        },
        financiamiento: {
          required: true
        },
        anios_uso: {
          required: true,
          minlength: 1
        },
        valor_adquisicion: {
          required: true,
          minlength: 1
        },
        valor_residual: {
          required: true,
          minlength: 1
        },
        vida_util: {
          required: true,
          minlength: 1
        },
        doc_adquisicion: {
          required: false
        },
        proveedor: {
          required: true
        }
      },
      messages: {
        categoria: {
          required: "Por favor, seleccione categoría."
        },
        tipo_bien: {
          required: "Por favor, seleccione tipo de bien."
        },
        descripcion: {
          required: "Por favor, ingrese descripción.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        observacion: {
          required: "Por favor, ingrese observación.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        marca: {
          required: "Por favor, ingrese marca.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        modelo: {
          required: "Por favor, ingrese modelo.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        nserie: {
          required: "Por favor, ingrese número de serie.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        cantidad: {
          required: "Por favor, ingrese cantidad.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        },
        fecha_adquisicion: {
          required:"Por favor, ingrese fecha de adquisición",
        },
        financiamiento: {
          required: "Por favor, seleccione financiamiento."
        },
        anios_uso: {
          required: "Por favor, ingrese años de uso.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        },
        valor_adquisicion: {
          required: "Por favor, ingrese valor de adquisición.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        },
        valor_residual: {
          required: "Por favor, ingrese valor residual.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        },
        vida_util: {
          required: "Por favor, ingrese vida útil.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        },
        doc_adquisicion: {
          required: "Por favor, ingrese documento de adquisición.",
        },
        proveedor: {
          required: "Por favor, seleccione proveedor."
        }
      }
    });

    $('input[type=checkbox]').on('change', function() {
      if ($(this).is(':checked') ) {
          $("#divcantidad_lote").show();
          $("#divserie").hide();
          $("#nserie").val("");
      } else {
          $("#divcantidad_lote").hide();
          $("#divserie").show();
          $("#cantidad").val("");
      }
    });

    $("#financiamiento").on('change', function() {

      var financiamiento = $("#financiamiento").val();
      $("#div_anios_uso").hide();
      if(financiamiento == "Usado"){
        $("#anios_uso").val("");
        $("#div_anios_uso").show();
      }
    });
    
});

$("#btnguardar").click(function(){
    if($("#form_activo_fijo").valid()){
        $("#bandera").val("add");
        var formData = new FormData($("#form_activo_fijo")[0]);
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
            
          if(resultado_ajax === "Exito"){
            $("#btnguardar").attr("disabled",true);
            PNotify.success({
              title: 'Éxito',
              text: 'Registro almacenado.',
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
                      location.href='../../pages/activo_fijo/activo_fijo_add.php';
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
                      location.href='../../pages/activo_fijo/activo_fijo_add.php';
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