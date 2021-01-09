<?php

  if(isset($_POST["codigo"])){

    include ("conexion.php");
        
    $codigo=$_POST["codigo"];
   
    $stmt= $pdo->prepare("SELECT * FROM producto WHERE codigo=:codigo");
    $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  			     	
    foreach($result as $fila){
             
        $datos = array(
          0 => $fila["id_producto"],
          1 => $fila["nombre"],
          2 => $fila["margen_ganancia"],
          3 => $fila["cantidad"],
          4 => $fila["precio"],
          5 => $fila["descripcion"],
          6 => $fila["categoria"],
        );
      
    }			

    echo json_encode($datos);
        
    }        
?>