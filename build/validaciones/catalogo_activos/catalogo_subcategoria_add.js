$(document).ready(function(){

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

    $("#form_catalogo_subcategoria").validate({
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
        codigo: {
          required: true,
          minlength: 3
        },
        subcategoria: {
          letrasOespacio: true,
          required: true,
          minlength: 3
        },
        categoria: {
          required: true
        }
      },
      messages: {
        codigo: {
          required: "Por favor, ingrese código.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        subcategoria: {
          required: "Por favor, ingrese subcategoría.",
          minlength: "Debe ingresar m&iacute;nimo 3 dígitos."
        },
        categoria: {
          required: "Por favor, seleccione categoría."
        }
      }
    });
    
});

$("#btnguardar").click(function(){
    if($("#form_catalogo_subcategoria").valid()){
        $("#bandera").val("add");
        $.ajax({
          type: 'POST',
          url: '../../build/controladores/crud_catalogo_subcategoria.php',
          data: $("#form_catalogo_subcategoria").serialize()
        })
        .done(function(resultado_ajax){
           // alert(resultado_ajax);
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
                      location.href='../../pages/catalogo_activos/catalogo_subcategoria_add.php';
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
                      location.href='../../pages/catalogo_activos/catalogo_subcategoria_add.php';
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
          alert('Error al cargar la Pagina Catalogo Activos')
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