<?php
    if(isset($_POST['categoria'])){
        function obtenerProducto(){
            require 'conexion.php';
            $id_activo_categoria = $_POST['categoria'];
            $stmt= $pdo->prepare("SELECT id_activo_subcategoria, codigo, subcategoria FROM activo_subcategoria WHERE id_activo_categoria=:id_activo_categoria ORDER BY subcategoria");
            $stmt->bindParam(":id_activo_categoria",$id_activo_categoria,PDO::PARAM_INT);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            $listas = "<option value=''>Seleccione Tipo de Bien...</option>";
            if ($result) {
                foreach($result as $lista_subcategoria){
                $listas .= "<option value='".$lista_subcategoria['id_activo_subcategoria']."'>".$lista_subcategoria['subcategoria']."</option>";
                }//fin for
                return $listas;
            }
        }

        echo obtenerProducto();
    }
?> 