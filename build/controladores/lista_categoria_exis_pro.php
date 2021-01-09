<?php
    
    function obtenerCategoria(){
        require 'conexion.php';
        $stmt= $pdo->prepare("SELECT DISTINCT categoria FROM producto WHERE cantidad > 0 ORDER BY categoria");
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