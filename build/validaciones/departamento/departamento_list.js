$(document).ready(function(){

    var estado = "Activo";
    var user = $('#user').val();
    var id_user = $('#id_usuario').val();
    
      $.ajax({
        type: 'POST',
        url: '../../pages/departamento/departamento_table.php',
        data: {'estado': estado}
        //data: {'estado': estado, 'user': user, 'id_user': id_user}
      })
      .done(function(obtenerDatos){
        $('#div_departamento_table').html(obtenerDatos);
        table=$('#example1').DataTable({
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          }
        });
                       
      })
      .fail(function(){
        alert('Error al cargar la Pagina')
      })
});

function mostrar_activo(){
  var estado = "Activo";
  // var user = $('#user').val();
  // var id_user = $('#id_usuario').val();
  var table = $('#example1').DataTable();
 $.ajax({
    type: 'POST',
    url: '../../pages/departamento/departamento_table.php',
    data: {'estado': estado}
    //data: {'estado': estado, 'user': user, 'id_user': id_user}
  })
  .done(function(obtenerDatos){
    table.destroy();
    $('#div_departamento_table').html(obtenerDatos);
    table=$('#example1').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
    });
  })
  .fail(function(){
    alert('Error al cargar la Pagina')
  })
}

function mostrar_inactivo(){

  var estado = "Inactivo";
  // var user = $('#user').val();
  //  var id_user = $('#id_usuario').val();
  var table = $('#example1').DataTable();
  $.ajax({
    type: 'POST',
    url: '../../pages/departamento/departamento_table.php',
    data: {'estado': estado}
    //data: {'estado': estado, 'user': user, 'id_user': id_user}
  })
  .done(function(obtenerDatos){
    table.destroy();
    $('#div_departamento_table').html(obtenerDatos);
    table=$('#example1').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      }
    });
  })
  .fail(function(){
    alert('Error al cargar la Pagina')
  })
}

function editar_departamento(id){
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
    $("#from_departamento_edit").submit();
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

 function dar_baja_departamento(id){
   
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
      var bandera = "dar_baja";
      $.ajax({
       type: 'POST',
       url: '../../build/controladores/crud_departamento.php',
       data: {'bandera' : bandera, 'id' : id}
      })
      .done(function(resultado_ajax){
 
       if(resultado_ajax === "Exito"){
          
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
                    location.href='../../pages/departamento/departamento_list.php';
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
          icons: 'bootstrap3'
        });
               
       }             
     })
     .fail(function(){
       alert('Error al cargar la Pagina')
     })
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


 function dar_alta_departamento(id){
 
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
      var bandera = "dar_alta";
      $.ajax({
       type: 'POST',
       url: '../../build/controladores/crud_departamento.php',
       data: {'bandera' : bandera, 'id' : id}
      })
      .done(function(resultado_ajax){
 
       if(resultado_ajax === "Exito"){
          
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
                    location.href='../../pages/departamento/departamento_list.php';
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
          icons: 'bootstrap3'
        });
               
       }             
     })
     .fail(function(){
       alert('Error al cargar la Pagina')
     })
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
 