<?php

  if(isset($_POST["id_producto"])){

    include ("conexion.php");
        
    $id_producto=$_POST["id_producto"];

    $stmt= $pdo->prepare("SELECT * FROM sucursal WHERE id_sucursal=1");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $lista_sucursal){ 
      $iva_r=$lista_sucursal['iva'];
    }
   
    $stmt1= $pdo->prepare("SELECT * FROM producto WHERE id_producto=:id_producto");
    $stmt1->bindParam(":id_producto",$id_producto,PDO::PARAM_INT);
    $stmt1->execute();
    $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);  			     	
    foreach($result as $fila){
             
        $datos = array(
          0 => $fila["id_producto"],
          1 => $fila["codigo"],
          2 => $fila["nombre"],
          3 => $fila["margen_ganancia"],
          4 => $fila["cantidad"],
          5 => $fila["precio"],
          6 => $fila["descripcion"],
          7 => $iva_r,
        );
      
    }			

    echo json_encode($datos);
        
    }        
?>