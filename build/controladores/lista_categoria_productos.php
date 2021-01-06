<?php
    if(isset($_POST['categoria'])){
        function obtenerProducto(){
            require 'conexion.php';
            $categoria = $_POST['categoria'];
            $stmt= $pdo->prepare("SELECT DISTINCT p.id_producto, p.nombre FROM producto AS p INNER JOIN detalle_compra AS dc ON (p.id_producto=dc.id_producto) WHERE categoria=:categoria ORDER BY nombre ");
            $stmt->bindParam(":categoria",$categoria,PDO::PARAM_STR);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            $listas = "<option value=''>Seleccione Producto...</option>";
            if ($result) {
                foreach($result as $lista_producto){
                $listas .= "<option value='".$lista_producto['id_producto']."'>".$lista_producto['nombre']."</option>";
                }//fin for
                return $listas;
            }
        }

        echo obtenerProducto();
    }
?> 