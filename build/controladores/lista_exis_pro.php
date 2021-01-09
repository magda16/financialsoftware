<?php
    if(isset($_POST['categoria'])){
        function obtenerProducto(){
            require 'conexion.php';
            $categoria = $_POST['categoria'];
            $stmt= $pdo->prepare("SELECT DISTINCT id_producto, nombre FROM producto WHERE categoria=:categoria AND cantidad > 0 ORDER BY nombre");
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