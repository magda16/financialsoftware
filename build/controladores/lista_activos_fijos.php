<?php
    if(isset($_POST['subcategoria'])){
        function obtenerProducto(){
            require 'conexion.php';
            $id_subcategoria = $_POST['subcategoria'];
            $stmt= $pdo->prepare("SELECT af.id_activo_fijo, af.codigo, asub.subcategoria FROM activo_fijo AS af INNER JOIN activo_subcategoria AS asub ON (af.id_subcategoria=asub.id_activo_subcategoria) WHERE af.id_subcategoria=:id_subcategoria");
            $stmt->bindParam(":id_subcategoria",$id_subcategoria,PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            $listas = "<option value=''>Seleccione Activo Fijo...</option>";
            if ($result) {
                foreach($result as $lista_activo_fijo){
                $listas .= "<option value='".$lista_activo_fijo['id_activo_fijo']."'>".$lista_activo_fijo['subcategoria']."-->".$lista_activo_fijo['codigo']."</option>";
                }//fin for
                return $listas;
            }
        }

        echo obtenerProducto();
    }
?> 