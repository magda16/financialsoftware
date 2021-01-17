<?php

if(isset($_POST['categoria'])){
    $categoria = $_POST['categoria'];

echo "<table id='datatable-responsive1' class='table table-striped table-bordered dt-responsive nowrap' cellspacing='0' width='100%'>";

  include ("../../build/controladores/conexion.php");
  $stmt= $pdo->prepare("SELECT id_producto, codigo, nombre, cantidad, precio, fotografia, estado FROM producto WHERE categoria=:categoria ORDER BY nombre");
  $stmt->bindParam(":categoria",$categoria,PDO::PARAM_STR);
  $stmt->execute();
  $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
  $contador=1;
  foreach($result as $lista_producto){

    $fotografia_r=$lista_producto['fotografia'];
    $foto="../../files/producto.png";
    if($fotografia_r!=""){
      $foto="../../".$fotografia_r;
    }
    
    $stmt1= $pdo->prepare("SELECT SUM(cantidad) AS v FROM detalle_venta_contado WHERE id_producto=:id_producto");
    $stmt1->bindParam(":id_producto",$lista_producto['id_producto'],PDO::PARAM_INT);
    $stmt1->execute();
    $result1=$stmt1->fetchAll(PDO::FETCH_ASSOC);
    foreach($result1 as $lista_dv){
        $vendido=$lista_dv['v'];
        if($vendido==""){
            $vendido=0;
        }
    }
    echo "<thead>";
    echo "<tr>";
    echo "<th colspan='8'> <h4 style='color: #00c0ef;'><strong>". $contador." - ".$lista_producto['nombre'].".</h4></strong></th>";                    
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
            
      echo "<tr>";
      echo "<td rowspan='3'><img src='".$foto."' width='100' height='100'/></td>";
      echo "<td colspan='2'><strong>Código: </strong>".$lista_producto['codigo']."</td>";
      echo "<td colspan='2'><strong>Precio: </strong>$ ".$lista_producto['precio']."</td>";
      echo "<td colspan='3'><strong>Estado: </strong>".$lista_producto['estado']."</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td colspan='2'><strong>Disponibles: </strong>".$lista_producto['cantidad']."</td>";
      echo "<td colspan='5'><strong>Vendidos: </strong>".$vendido."</td>";
      echo "</tr>";

      echo "<tr>";
      echo "<td colspan='5'><strong>OPCIONES</strong></td>";
      if($lista_producto['estado']=="Activo"){
        echo "<td><a class='btn btn-primary' type='button' onclick='editar_producto(".$lista_producto['id_producto'].")' data-toggle='tooltip' data-placement='top' title='Actualizar Producto'><i class='fa fa-refresh'></i></a></td>";
        echo "<td><a class='btn btn-danger' type='button' onclick='dar_baja_producto(".$lista_producto['id_producto'].")' data-toggle='tooltip' data-placement='top' title='Dar Baja Producto'><i class='fa fa-long-arrow-down'></i></a></td>";
      }else{
        echo "<td></td>";
        echo "<td><a class='btn bg-orange' onclick='dar_alta_producto(".$lista_producto['id_producto'].")' data-toggle='tooltip' data-placement='top' title='Activar Producto'><i class='fa fa-long-arrow-up'></i></a></td>";
      }
      echo "</tr>";

      echo "<tr>";
      echo "<td colspan='8'></td>";
      echo "</tr>";

      $contador++;
    
    }

  echo "</tbody>";
  echo "</table>";
}

?>