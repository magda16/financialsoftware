$(document).ready(function(){

    var estado_list = $('#estado_list').val();
    
    $.ajax({
        type: 'POST',
        url: '../../pages/cliente/cliente_table.php',
        data: {'estado_list': estado_list}
      })
      .done(function(obtenerDatos){
        $('#div_cliente_table').html(obtenerDatos);
        table=$('#example1').DataTable();        
      })
      .fail(function(){
        alert('Error al cargar la Pagina Clientes')
      })
});

function editar_cliente(id){
  var notice = PNotify.notice({
    title: 'Advertencia',
    text: '¿Esta seguro que desea modificar el registro?'+id,
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
    $("#form_cliente_edit").submit();
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
