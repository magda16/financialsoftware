<?php
    
    function obtenerProveedor(){
        require 'conexion.php';
        $stmt= $pdo->prepare("SELECT * FROM proveedor ORDER BY nombre");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Proveedor...</option>";
        if ($result) {
            foreach($result as $lista_proveedor){
            $listas .= "<option value='".$lista_proveedor['id_proveedor']."'>".$lista_proveedor['nombre']."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerProveedor();
?>  