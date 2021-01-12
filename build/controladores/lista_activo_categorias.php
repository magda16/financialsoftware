<?php
    
    function obtenerCategoria(){
        require 'conexion.php';
        $stmt= $pdo->prepare("SELECT DISTINCT ac.id_activo_categoria, ac.codigo, ac.categoria FROM activo_categoria AS ac INNER JOIN activo_subcategoria AS asub ON (ac.id_activo_categoria=asub.id_activo_categoria) ORDER BY ac.categoria");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        $listas = "<option value=''>Seleccione Categoría...</option>";
        if ($result) {
            foreach($result as $lista_categoria){
            $listas .= "<option value='".$lista_categoria['id_activo_categoria']."'>".$lista_categoria['categoria']."</option>";
            }//fin for
            return $listas;
        }
    }

    echo obtenerCategoria();
?>  