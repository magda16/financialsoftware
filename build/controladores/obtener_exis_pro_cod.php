<?php

  if(isset($_POST["codigo"])){

    include ("conexion.php");
        
    $codigo=$_POST["codigo"];

    $stmt= $pdo->prepare("SELECT * FROM sucursal WHERE id_sucursal=1");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $lista_sucursal){ 
      $iva_r=$lista_sucursal['iva'];
    }
   
    $stmt1= $pdo->prepare("SELECT * FROM producto WHERE codigo=:codigo AND cantidad > 0");
    $stmt1->bindParam(":codigo",$codigo,PDO::PARAM_STR);
    $stmt1->execute();
    $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);  			     	
    foreach($result as $fila){
             
        $datos = array(
          0 => $fila["id_producto"],
          1 => $fila["nombre"],
          2 => $fila["margen_ganancia"],
          3 => $fila["cantidad"],
          4 => $fila["precio"],
          5 => $fila["descripcion"],
          6 => $fila["categoria"],
          7 => $iva_r,
        );
      
    }			

    echo json_encode($datos);
        
    }        
?>