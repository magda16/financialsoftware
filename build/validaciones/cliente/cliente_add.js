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

    $.validator.addMethod("alfanumOespacio", function(value, element) {
        return /^[ a-z0-9áéíóúüñ.,]*$/i.test(value);
    }, "Ingrese sólo letras, números o espacios.");

    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9-()]*$/i.test(value);
    }, "Ingrese sólo números");

    $.validator.addMethod("correo", function(value, element) {
        return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
    }, "Ingrese un correo v&aacute;lido.");

    $("#form_cliente").validate({
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
          letrasOespacio: true,
          required: true,
          minlength: 3,
          maxlength: 150
        },
        apellido: {
          letrasOespacio: true,
          required: true,
          minlength: 3,
          maxlength: 150
        },
        dui: {
          numero: true,
          required: true,
          minlength: 10
        },
        nit: {
          numero: true,
          required: true,
          minlength: 17
        }/*,
        telefono1:{
          numero: true,
          required: true,
          minlength: 9
        },
        telefono2:{
          numero: true,
          required: false,
          minlength: 9
        }*/,
        direccion: {
          alfanumOespacio: true,
          required: true,
          minlength: 6
        },
        correo: {
          correo: true,
          required:true,
          minlength: 8,
          maxlength: 150
        },
        fecha_nacimiento: {
          required:true,
        }/*,
        estadofam: {
          required: true
        }*/
        /*,
        file:"required"*/
      },
      messages: {
        nombre: {
          required: "Por favor, ingrese nombre.",
          maxlength: "Debe ingresar m&aacute;ximo 150 dígitos.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        apellido: {
          required: "Por favor, ingrese apellido.",
          maxlength: "Debe ingresar m&aacute;ximo 150 dígitos.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        dui: {
          required: "Por favor, ingrese DUI.",
          minlength: "Debe ingresar m&iacute;nimo 10 dígitos."
        },
        nit: {
          required: "Por favor, ingrese NIT.",
          minlength: "Debe ingresar m&iacute;nimo 17 dígitos."
        }/*,
        telefono1: {
          required: "Por favor, ingrese n&uacute;mero tel&eacute;fonico",
          minlength: "Debe ingresar m&iacute;nimo 9 dígitos."
        },
        telefono2: {
          required: "Por favor, ingrese n&uacute;mero tel&eacute;fonico",
          minlength: "Debe ingresar m&iacute;nimo 9 dígitos."
        }*/,
        direccion: {
          required: "Por favor, ingrese direcci&oacute;n.",
          minlength: "Debe ingresar m&iacute;nimo 6 dígitos."
        },
        correo: {
          required: "Por favor, ingrese un correo v&aacute;lido",
          maxlength: "Debe ingresar m&aacute;ximo 150 dígitos.",
          minlength: "Debe ingresar m&iacute;nimo 8 dígitos."
        },
        fecha_nacimiento: {
          required:"Por favor, ingrese fecha de nacimiento",
        }/*,
        estadofam: {
          required: "Por favor, seleccione estado."
        }*/
        /*,
        file: "Por favor, seleccione una foto."*/
      }
    });
});

$("#btnguardar").click(function(){
    if($("#form_cliente").valid()){
        $("#bandera").val("add");
        $.ajax({
          type: 'POST',
          url: '../../build/controladores/crud_cliente.php',
          data: $("#form_cliente").serialize()
        })
        .done(function(resultado_ajax){
            alert(resultado_ajax);
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
                      location.href='../pages/cliente/cliente_add.php';
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
                      location.href='../pages/cliente/cliente_add.php';
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
          alert('Error al cargar la Pagina Cliente')
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