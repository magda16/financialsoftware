$(document).ready(function(){

  $("#div_anios_uso").hide();
  
    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_activo_categorias.php'
    })
    .done(function(lista_activo_categorias){
      $('#categoria').html(lista_activo_categorias)
      var categoria = $("#id_categoria").val();
      $("#categoria option[value='"+ categoria +"']").attr("selected",true);
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Categorías')
    })
    
    var categoria = $("#id_categoria").val();
    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_activo_subcategorias.php',
      data: {'categoria': categoria}
    })
    .done(function(lista_activo_subcategorias){
      $('#tipo_bien').html(lista_activo_subcategorias)
      var id_subcategoria = $("#id_subcategoria").val();
      $("#tipo_bien option[value='"+ id_subcategoria +"']").attr("selected",true);
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Subcategorías')
    })

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
      var id_proveedor= $("#id_proveedor").val();
      $("#proveedor option[value='"+ id_proveedor +"']").attr("selected",true);
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Proveedor')
    })

    if($("#financiamiento").val() == "Usado"){
      $("#div_anios_uso").show();
      $("#anios_uso").val($("#anios_u").val());
    }

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

    $("#financiamiento").on('change', function() {

      var financiamiento = $("#financiamiento").val();
      $("#div_anios_uso").hide();
      if(financiamiento == "Usado"){
        $("#anios_uso").val($("#anios_u").val());
        $("#div_anios_uso").show();
      }
    });
    
});

$("#btneditar").click(function(){
    if($("#form_activo_fijo").valid()){
        $("#bandera").val("edit");
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
            $("#btneditar").attr("disabled",true);
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