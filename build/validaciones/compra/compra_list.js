$(document).ready(function(){
  table=$('#example1').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
  });
});

function detalle_compra(id){
    $("#id").val(id);
    $("#from_detalle_compra").submit();
    
}