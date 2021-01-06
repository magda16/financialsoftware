$(document).ready(function(){

    var cont=0;
    
    //Date picker
    $('#fecha').datepicker({
      autoclose: true
    })

    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9]*$/i.test(value);
    }, "Ingrese sólo números");

    $("#form_venta").validate({
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
          minlength: 6
        },
        cantidad: {
          numero: true,
          required: true,
          minlength: 1
        },
        precio_venta: {
          required: true,
          minlength: 1
        }
      },
      messages: {
        codigo: {
          required: "Por favor, ingrese código.",
          minlength: "Debe ingresar m&iacute;nimo 6 dígitos."
        },
        cantidad: {
          required: "Por favor, ingrese cantidad.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        },
        precio_venta: {
          required: "Por favor, ingrese precio de venta.",
          minlength: "Debe ingresar m&iacute;nimo 10 dígitos."
        }
      }
    });

    $("#codigo").on('change', function() {
      var codigo = $("#codigo").val();
      
      $.ajax({
        type: 'POST',
        url: '../../build/controladores/obtener_producto.php',
        data: {'codigo': codigo}
      })
      .done(function(obtenerDatos){
        var datos = eval(obtenerDatos);
        $('#id_producto').val(datos[0]);
        $('#producto').val(datos[1]);
        $('#proveedor').val(datos[2]);
      })
      .fail(function(){
        alert('Hubo un error al cargar el código')
      })
      
    });


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
  

    $("#precio_venta").on('change', function() {
      var cantidad = parseFloat($("#cantidad").val());
      var precio_venta = parseFloat($("#precio_venta").val());

      if(cantidad != "" && precio_venta != ""){
        if(isNaN(cantidad)){ cantidad=0; }
        if(isNaN(precio_venta)){ precio_venta=0; }
        var subtotal = parseFloat((cantidad * precio_venta).toFixed(2));
        $("#subtotal").val(subtotal);
      }
      
    });

    $("#cantidad").on('change', function() {
      var cantidad = parseFloat($("#cantidad").val());
      var precio_venta = parseFloat($("#precio_venta").val());

      if(cantidad != "" && precio_venta != ""){
        if(isNaN(cantidad)){ cantidad=0; }
        if(isNaN(precio_venta)){ precio_venta=0; }
        var subtotal = parseFloat((cantidad * precio_venta).toFixed(2));
        $("#subtotal").val(subtotal);
      }
      
    });

    $("#btnagregar").click(function(){
      if($("#form_venta").valid()){
        var id_producto = $("#id_producto").val();
        var producto = $("#producto").val();
        var cantidad = parseInt($("#cantidad").val());
        var precio_venta = parseFloat($("#precio_venta").val());
        var subtotal = parseFloat($("#subtotal").val());

        var total = parseFloat($("#total").val());
        if(isNaN(total)){ total=0; }
        var sumtotal =  parseFloat((subtotal + total).toFixed(2));
    
        $("#filas").append("<tr id=tr"+ cont +" name=tr" + cont 
        +"><input type='hidden' id='id_product"+cont+"' name='id_product[]' value=" + id_producto
        +"><input type='hidden' id='cantida"+cont+"' name='cantida[]' value=" + cantidad
        +"><input type='hidden' id='precio_compr"+cont+"' name='precio_compr[]' value=" + precio_venta
        +"><td>" + producto 
        +"</td><td>" + cantidad 
        +"</td><td> $ " + precio_venta 
        +"</td><td> $ " + subtotal + "</td><td><i class='btn btn-danger fa fa-trash-o' onclick=borrar('" + cont 
        + "')></i></td></tr>");
    
        $("#total").val(sumtotal);
        cont=cont+1;

        //$("#form_venta")[0].reset();
        
        $("#codigo").val("");
        $("#producto").val("");
        $("#proveedor").val("");
        $("#cantidad").val("");
        $("#precio_venta").val("");
        $("#subtotal").val("");
        $(".form-group").find(".ic").removeClass("fa fa-check");
        $(".form-group").removeClass("has-success");
        
    
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

function borrar(id){
  var cantidad  = parseInt($("#cantida"+id).val());
  var precio_venta = parseFloat($("#precio_compr"+id).val());
 
  var subtotal = parseFloat((cantidad * precio_venta).toFixed(2));
  var total = parseFloat($("#total").val());
  if(isNaN(total)){ total=0; }
  var sumtotal = parseFloat((total - subtotal).toFixed(2));
  $("#total").val(sumtotal);

  $("#tr"+id).remove();
}


$("#btnguardar").click(function(){
    if($("#fecha").val() != ""){
        $("#bandera").val("add");
        $.ajax({
          type: 'POST',
          url: '../../build/controladores/crud_venta.php',
          data: $("#form_venta").serialize()
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
                      location.href='../../pages/venta/venta_add.php';
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
                      location.href='../../pages/venta/venta_add.php';
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
          alert('Error al cargar la Pagina venta')
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