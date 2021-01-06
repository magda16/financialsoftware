<?php
  if(isset($_POST["codigo"])){

    include ("conexion.php");
        
    $codigo=$_POST["codigo"];
   
    $stmt= $pdo->prepare("SELECT p.id_producto, p.nombre AS producto, pr.id_proveedor ,pr.nombre AS proveedor FROM producto AS p INNER JOIN proveedor AS pr ON (p.proveedor=pr.id_proveedor) WHERE codigo=:codigo");
    $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  			     	
    foreach($result as $fila){
             
        $datos = array(
          0 => $fila["id_producto"],
          1 => $fila["producto"],
          2 => $fila["proveedor"],
        );
      
    }			

    echo json_encode($datos);
        
}        
?>