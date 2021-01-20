$(document).ready(function(){

    $("#form_index").validate({
      errorPlacement: function (error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('.form-group').find('.help-block').html('');
        },
      rules: {
        usuario: {
          required: true,
          minlength: 5,
          maxlength: 100
        },
        clave: {
          required: true,
          minlength: 5,
          maxlength: 100
        }
      },
      messages: {
        usuario: {
            required: "Por favor, ingrese usuario.",
            maxlength: "Debe ingresar m&aacute;ximo 100 carácteres.",
            minlength: "Debe ingresar m&iacute;nimo 5 carácteres."
        },
        clave: {
          required: "Por favor, ingrese contraseña.",
          maxlength: "Debe ingresar m&aacute;ximo 100 carácteres.",
          minlength: "Debe ingresar m&iacute;nimo 5 carácteres."
        }
      }
    });


  

});

$("#btningresar").click(function(){
    if($("#form_index").valid()){
      var usuario = $("#usuario").val();
      var clave = $("#clave").val();
          $.ajax({
            type: 'POST',
            url: 'build/controladores/validar_usuario.php',
            data: {'usuario': usuario, 'clave': clave}
          })
          .done(function(resultado_ajax){
            if(resultado_ajax===""){
              $("#usuario").val("");
              $("#clave").val("");
              $('#result_clave_error').text("Datos erróneos");
              $('#result_usuario').removeClass('has-success').addClass('has-error');
              $('#result_clave').removeClass('has-success').addClass('has-error');
            }else{
              $("#form_index").submit();
            }
          })
          .fail(function(){
            alert('Error al cargar la página')
          })
        }
 });