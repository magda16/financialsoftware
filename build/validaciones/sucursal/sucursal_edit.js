$(document).ready(function(){
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#fecha_nacimiento').datepicker({
      autoclose: true
    })

   // $('.select2').select2()

    $.validator.addMethod("letrasOespacio", function(value, element) {
        return /^[ a-záéíóúüñ]*$/i.test(value);
    }, "Ingrese sólo letras o espacios.");

    $.validator.addMethod("num", function(value, element) {
        return /^[ 0-9.]*$/i.test(value);
    }, "Ingrese sólo números.");

    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9-]*$/i.test(value);
    }, "Ingrese sólo números");

    $.validator.addMethod("correo", function(value, element) {
        return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
    }, "Ingrese un correo v&aacute;lido.");

    $("#form_sucursal").validate({
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
        nombre: {
          required: true,
          minlength: 3,
          maxlength: 200
        },
        codigo: {
          required: true,
          minlength: 6
        },
        nit: {
          numero: true,
          required: true,
          minlength: 17
        },
        giro: {
          required: true,
          minlength: 3,
          maxlength: 200
        },
        iva: {
          num: true,
          required: true,
          minlength: 1,
        },
        direccion: {
          required: true,
          minlength: 6
        },
        correo: {
          correo: true,
          required:true,
          minlength: 8,
          maxlength: 150
        },
        telefono:{
          numero: true,
          required: true,
          minlength: 9
        }/*,
        file:"required"*/
      },
      messages: {
        nombre: {
          required: "Por favor, ingrese nombre.",
          maxlength: "Debe ingresar m&aacute;ximo 200 dígitos.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        codigo: {
          required: "Por favor, ingrese código.",
          minlength: "Debe ingresar m&iacute;nimo 6 dígitos."
        },
        nit: {
          required: "Por favor, ingrese NIT.",
          minlength: "Debe ingresar m&iacute;nimo 17 dígitos."
        },
        giro: {
          required: "Por favor, ingrese giro.",
          maxlength: "Debe ingresar m&aacute;ximo 200 dígitos.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        iva: {
          required: "Por favor, ingrese impuesto iva.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        },
        direccion: {
          required: "Por favor, ingrese direcci&oacute;n.",
          minlength: "Debe ingresar m&iacute;nimo 6 dígitos."
        },
        correo: {
          required: "Por favor, ingrese un correo v&aacute;lido",
          maxlength: "Debe ingresar m&aacute;ximo 150 dígitos.",
          minlength: "Debe ingresar m&iacute;nimo 8 dígitos."
        },
        telefono: {
          required: "Por favor, ingrese n&uacute;mero tel&eacute;fonico",
          minlength: "Debe ingresar m&iacute;nimo 9 dígitos."
        }
        /*,
        file: "Por favor, seleccione una foto."*/
      }
    });
});

$("#btneditar").click(function(){
    if($("#form_sucursal").valid()){
        $("#bandera").val("edit");
        $.ajax({
          type: 'POST',
          url: '../../build/controladores/crud_sucursal.php',
          data: $("#form_sucursal").serialize()
        })
        .done(function(resultado_ajax){
           // alert(resultado_ajax);
          if(resultado_ajax === "Exito"){
            $("#btneditar").attr("disabled",true);
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
                      location.href='../../pages/sucursal/sucursal_edit.php';
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
                      location.href='../../pages/sucursal/sucursal_edit.php';
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
          alert('Error al cargar la Pagina sucursal')
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