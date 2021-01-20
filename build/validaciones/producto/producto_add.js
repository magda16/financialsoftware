$(document).ready(function(){

  $('#preview').hover(
    function() {
        $(this).find('a').fadeIn();
    }, function() {
        $(this).find('a').fadeOut();
  });

  $('#file-select').on('click', function(e) {
    e.preventDefault();
        
    $('#file').click();
  });

  $('input[type=file]').change(function() {
    var file = (this.files[0].name).toString();
    var reader = new FileReader();
        
    reader.onload = function (e) {
      $('#preview img').attr('src', e.target.result);
    }
         
    reader.readAsDataURL(this.files[0]);
  });
    
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

    $.validator.addMethod("letrasOespacio", function(value, element) {
        return /^[ a-záéíóúüñ]*$/i.test(value);
    }, "Ingrese sólo letras o espacios.");

    $.validator.addMethod("alfanumOespacio", function(value, element) {
        return /^[ a-z0-9áéíóúüñ.,]*$/i.test(value);
    }, "Ingrese sólo letras, números o espacios.");

    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9]*$/i.test(value);
    }, "Ingrese sólo números enteros");

    $.validator.addMethod("correo", function(value, element) {
        return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
    }, "Ingrese un correo v&aacute;lido.");

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
        nombre: {
          letrasOespacio: true,
          required: true,
          minlength: 3
        },
        categoria: {
          required: true
        },
        marca: {
          required: true,
          minlength: 3
        },
        modelo: {
          required: true,
          minlength: 3
        },
        proveedor: {
          required: true
        },
        stock_minimo: {
          required: true,
          minlength: 1
        },
        margen_ganancia: {
          numero: true,
          required: true,
          minlength: 1,
          range: [0, 100]
        },
        descripcion: {
          required: true,
          minlength: 3
        }
        /*,
        file:"required"*/
      },
      messages: {
        nombre: {
          required: "Por favor, ingrese producto.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        categoria: {
          required: "Por favor, seleccione categoría."
        },
        marca: {
          required: "Por favor, ingrese marca.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        modelo: {
          required: "Por favor, ingrese modelo.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        proveedor: {
          required: "Por favor, seleccione proveedor."
        },
        stock_minimo: {
          required: "Por favor, ingrese stock mínimo.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígito."
        },
        margen_ganancia: {
          required: "Por favor, ingrese margen de ganancia.",
          minlength: "Debe ingresar m&iacute;nimo 1 carácter.",
          range: "Debe ingresar un valor entre 0 y 100."
        },
        descripcion: {
          required: "Por favor, ingrese descripción.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        }
        /*,
        file: "Por favor, seleccione una foto."*/
      }
    });
});

$("#btnguardar").click(function(){
    if($("#form_producto").valid()){
        $("#bandera").val("add");
       
        var formData = new FormData($("#form_producto")[0]);
        $.ajax({
          type: 'POST',
          url: '../../build/controladores/crud_producto.php',
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
                      location.href='../../pages/producto/producto_add.php';
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
                      location.href='../../pages/producto/producto_add.php';
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