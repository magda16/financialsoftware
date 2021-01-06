<?php
    
    function obtenerCategoria(){
        require 'conexion.php';
        $stmt= $pdo->prepare("SELECT DISTINCT p.categoria FROM producto AS p INNER JOIN detalle_compra AS dc ON (p.id_producto=dc.id_producto) ORDER BY categoria");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Categoría...</option>";
        if ($result) {
            foreach($result as $lista_categoria){
            $listas .= "<option value='".$lista_categoria['categoria']."'>".$lista_categoria['categoria']."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerCategoria();
?>  