$(document).ready(function(){

    var cont=0;
    
    //Date picker
    $('#fecha').datepicker({
      autoclose: true
    })

    $.validator.addMethod("numero", function(value, element) {
        return /^[ 0-9]*$/i.test(value);
    }, "Ingrese sólo números");

    $("#form_agregar_venta").validate({
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
        s_producto: {
          required: true
        },
        codigo: {
          required: true,
          minlength: 6
        },
        cantidad: {
          numero: true,
          required: true,
          minlength: 1
        }
      },
      messages: {
        categoria: {
          required: "Por favor, seleccione categoría."
        },
        s_producto: {
          required: "Por favor, seleccione producto."
        },
        codigo: {
          required: "Por favor, ingrese código.",
          minlength: "Debe ingresar m&iacute;nimo 6 dígitos."
        },
        cantidad: {
          required: "Por favor, ingrese cantidad.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        }
      }
    });

    $.ajax({
      type: 'POST',
      url: '../../build/controladores/lista_categoria_exis_pro.php'
    })
    .done(function(lista_categoria_exis_pro){
      $('#categoria').html(lista_categoria_exis_pro)
    })
    .fail(function(){
      alert('Error al cargar la Pagina Lista Categorías')
    })

    $("#categoria").on('change', function() {

      var categoria = $("#categoria").val();
  
      $.ajax({
        type: 'POST',
        url: '../../build/controladores/lista_exis_pro.php',
        data: {'categoria': categoria}
      })
      .done(function(lista_exis_pro){
        $('#s_producto').html(lista_exis_pro)
      })
      .fail(function(){
        alert('Error al cargar la Pagina Lista Productos')
      })
       
    });

    $("#s_producto").on('change', function() {

      var id_producto = $("#s_producto").val();
      
      $.ajax({
        type: 'POST',
        url: '../../build/controladores/obtener_exis_pro_nom.php',
        data: {'id_producto': id_producto}
      })
      .done(function(obtenerDatos){
        var datos = eval(obtenerDatos);
        $('#id_producto').val(datos[0]);
        $('#codigo').val(datos[1]);
        $('#producto').val(datos[2]);
        $('#existencias').val(datos[4]);
        var precio = parseFloat(datos[5]);
        var ganancia = parseFloat((((datos[3]/100)*precio)).toFixed(2));
        var iva = parseFloat((((datos[7]/100)*precio)).toFixed(2));
        var precio_venta = parseFloat(ganancia + iva + precio);
        $('#precio_venta').val(precio_venta);
      })
      .fail(function(){
        alert('Hubo un error al cargar el Producto')
      })
      
    });


    $("#codigo").on('change', function() {

      var codigo = $("#codigo").val();
      
      $.ajax({
        type: 'POST',
        url: '../../build/controladores/obtener_exis_pro_cod.php',
        data: {'codigo': codigo}
      })
      .done(function(obtenerDatos){
        var datos = eval(obtenerDatos);
       
        if(datos[3] > 0){
          $('#id_producto').val(datos[0]);
          $('#categoria').val(datos[6]);
          var categoria = $("#categoria").val();
    
          $.ajax({
            type: 'POST',
            url: '../../build/controladores/lista_exis_pro.php',
            data: {'categoria': categoria}
          })
          .done(function(lista_exis_pro){
            $('#s_producto').html(lista_exis_pro)
            var id_producto= $("#id_producto").val();
            $("#s_producto option[value='"+ id_producto +"']").attr("selected",true);
          })
          .fail(function(){
            alert('Error al cargar la Pagina Lista Productos')
          })

          $('#producto').val(datos[1]);
          $('#existencias').val(datos[3]);
          var precio = parseFloat(datos[4]);
          var ganancia = parseFloat((((datos[2]/100)*precio)).toFixed(2));
          var iva = parseFloat((((datos[7]/100)*precio)).toFixed(2));
          var precio_venta = parseFloat(ganancia + iva + precio);
          $('#precio_venta').val(precio_venta);
        }else{
          PNotify.notice({
            title: 'Advertencia',
            text: 'Se ha agotado la existencia.',
            styling: 'bootstrap3',
            icons: 'bootstrap3'
          });
          $("#form_agregar_venta")[0].reset();
          $(".form-group").find(".ic").removeClass("fa fa-check");
          $(".form-group").removeClass("has-success");
        }
      })
      .fail(function(){
        alert('Hubo un error al cargar el Código')
      })
      
    });

    $("#cantidad").on('change', function() {
      var existencias = parseInt($("#existencias").val());
      var cantidad = parseInt($("#cantidad").val());
      if(cantidad>existencias){
        PNotify.notice({
          title: 'Advertencia',
          text: 'Cantidad NO puede ser mayor a Existencias.',
          styling: 'bootstrap3',
          icons: 'bootstrap3'
        });
        $("#cantidad").val("");  
      }
      
    });

    $("#btnagregar").click(function(){
      if($("#form_agregar_venta").valid()){
        var id_producto = $("#id_producto").val();
        var producto = $("#producto").val();
        var cantidad = parseInt($("#cantidad").val());
        var precio_venta = parseFloat($("#precio_venta").val());
        var subtotal = parseFloat((cantidad*precio_venta).toFixed(2));

        var num_producto = parseInt($("#productos").val());
        if(isNaN(num_producto)){ num_producto=0; }
        var sumproductos = cantidad + num_producto;

        var total = parseFloat($("#total").val());
        if(isNaN(total)){ total=0; }
        var sumtotal =  parseFloat((subtotal + total).toFixed(2));
    
        $("#filas").append("<tr id=tr"+ cont +" name=tr" + cont 
        +"><input type='hidden' id='id_product"+cont+"' name='id_product[]' value=" + id_producto
        +"><input type='hidden' id='product"+cont+"' name='product[]' value=" + producto
        +"><input type='hidden' id='cantida"+cont+"' name='cantida[]' value=" + cantidad
        +"><input type='hidden' id='precio_vent"+cont+"' name='precio_vent[]' value=" + precio_venta
        +"><td>" + cantidad 
        +"</td><td>" + producto
        +"</td><td> $ " + precio_venta 
        +"</td><td> $ " + subtotal + "</td><td><i class='btn btn-danger fa fa-trash-o' onclick=borrar('" + cont 
        + "')></i></td></tr>");
    
        $("#productos").val(sumproductos);
        $("#total").val(sumtotal);
        cont=cont+1;

        $("#form_agregar_venta")[0].reset();
        
       /* $("#codigo").val("");
        $("#producto").val("");
        $("#proveedor").val("");
        $("#cantidad").val("");
        $("#precio_venta").val("");
        $("#subtotal").val("");*/
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
        tipo_comprobante: {
          required: true
        },
        cliente: {
          required: false,
          minlength: 6
        },
        efectivo: {
          required: true,
          minlength: 1
        }
      },
      messages: {
        tipo_comprobante: {
          required: "Por favor, seleccione tipo de comprobante."
        },
        cliente: {
          required: "Por favor, ingrese cliente.",
          minlength: "Debe ingresar m&iacute;nimo 6 dígitos."
        },
        efectivo: {
          required: "Por favor, ingrese efectivo.",
          minlength: "Debe ingresar m&iacute;nimo 1 dígitos."
        }
      }
    });

    $("#tipo_comprobante").on('change', function() {

      var tipo_comprobante = $("#tipo_comprobante").val();
      
      $.ajax({
        type: 'POST',
        url: '../../build/controladores/obtener_tc_correlativo.php',
        data: {'tipo_comprobante': tipo_comprobante}
      })
      .done(function(obtenerDatos){
        var datos = eval(obtenerDatos);
        $('#correlativo').val(datos[0]);
      })
      .fail(function(){
        alert('Hubo un error al cargar el Tipo Comprobante')
      })
      
    });

    $("#efectivo").on('change', function() {
      var total = parseFloat($("#total").val());
      var efectivo = parseFloat($("#efectivo").val());
      if(total>efectivo){
        PNotify.notice({
          title: 'Advertencia',
          text: 'Efectivo NO puede ser menor que el Total.',
          styling: 'bootstrap3',
          icons: 'bootstrap3'
        });
        $("#efectivo").val("");  
      }else{
        var total = parseFloat($("#total").val());
        var efectivo = parseFloat($("#efectivo").val());
        if(isNaN(total)){ total=0; }
        var resta = parseFloat((efectivo - total).toFixed(2));
        $("#cambio").val(resta);
      }
      
    });

});

function borrar(id){
  var cantidad  = parseInt($("#cantida"+id).val());
  var precio_venta = parseFloat($("#precio_vent"+id).val());
  var num_producto = parseInt($("#productos").val());

  if(isNaN(num_producto)){ num_producto=0; }
  var sumproductos = num_producto - cantidad;
  $("#productos").val(sumproductos);
 
  var subtotal = parseFloat((cantidad * precio_venta).toFixed(2));
  var total = parseFloat($("#total").val());
  if(isNaN(total)){ total=0; }
  var sumtotal = parseFloat((total - subtotal).toFixed(2));
  $("#total").val(sumtotal);

  $("#tr"+id).remove();
}


  $("#btnguardar").click(function(){
    if($("#form_venta").valid()){
        $("#bandera").val("add");
        $.ajax({
          type: 'POST',
          url: '../../build/controladores/crud_venta.php',
          data: $("#form_venta").serialize()
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

                     $("#form_venta").submit();
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