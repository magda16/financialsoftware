<?php
   include ("conexion.php");
    if(isset($_POST['usuario'])){
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
       
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND clave=:clave");
        $stmt->bindParam(":usuario",$usuario,PDO::PARAM_STR);
        $stmt->bindParam(":clave",$clave,PDO::PARAM_STR);
		$stmt->execute();
        
        if ($stmt) {
            while ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                echo "exito";
            }//fin while
        }
    }
   
?>