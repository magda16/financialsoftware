<?php

  if(isset($_POST["tipo_comprobante"])){

    include ("conexion.php");
        
    $tipo_comprobante=$_POST["tipo_comprobante"];
   
    $stmt= $pdo->prepare("SELECT COUNT(id_venta_contado)+1 AS id_factura FROM venta_contado WHERE tipo_comprobante=:tipo_comprobante");
    $stmt->bindParam(":tipo_comprobante",$tipo_comprobante,PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  			     	
    foreach($result as $fila){

        $num = str_pad($fila["id_factura"], 5, "0", STR_PAD_LEFT);
             
        $datos = array(
          0 => $num,
        );
      
    }			

    echo json_encode($datos);
        
    }        
?>