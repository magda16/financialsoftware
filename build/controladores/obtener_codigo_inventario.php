<?php

  if(isset($_POST["tipo_bien"])){

    include ("conexion.php");
        
    $id_activo_subcategoria = $_POST['tipo_bien'];

    $stmt= $pdo->prepare("SELECT * FROM sucursal WHERE id_sucursal=1");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $lista_sucursal){ 
      $codigo_r=$lista_sucursal['codigo'];
    }
   
    $stmt1= $pdo->prepare("SELECT ac.codigo AS cod_ac, asub.codigo AS cod_sub, COUNT(af.id_subcategoria)+1 AS correlativo FROM activo_categoria AS ac INNER JOIN activo_subcategoria AS asub ON (ac.id_activo_categoria=asub.id_activo_categoria) INNER JOIN activo_fijo AS af ON (asub.id_activo_subcategoria=af.id_subcategoria) WHERE id_activo_subcategoria=:id_activo_subcategoria");
    $stmt1->bindParam(":id_activo_subcategoria",$id_activo_subcategoria,PDO::PARAM_INT);
    $stmt1->execute();
    $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);  			     	
    foreach($result as $fila){
             
        $datos = array(
          0 => $fila["cod_ac"],
          1 => $fila["cod_sub"],
          2 => str_pad($fila["correlativo"], 6, "0", STR_PAD_LEFT),
          3 => $codigo_r,
        );
      
    }			

    echo json_encode($datos);
        
    }        
?>
