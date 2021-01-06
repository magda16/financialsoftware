$(document).ready(function(){

    var estado_list = $('#estado_list').val();
    
    $.ajax({
        type: 'POST',
        url: '../../pages/proveedor/proveedor_table.php',
        data: {'estado_list': estado_list}
      })
      .done(function(obtenerDatos){
        $('#div_proveedor_table').html(obtenerDatos);
        table=$('#example1').DataTable();        
      })
      .fail(function(){
        alert('Error al cargar la Pagina Proveedor')
      })
});