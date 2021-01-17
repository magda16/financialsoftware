<?php


    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("conexion.php");
          
         
          $nombre=$_POST["nombre"];
          $nit=$_POST["nit"];
          $nombre_responsable=$_POST["nombre_responsable"];
          $apellido_responsable=$_POST["apellido_responsable"];
          $observaciones=$_POST["observaciones"];
          $direccion=$_POST["direccion"];
          $correo=$_POST["correo"];
          $telefono=$_POST["telefono"];
         
          $stmt = $pdo->prepare("SELECT MAX(id_proveedor)+1 AS 'id' FROM proveedor");
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          if ($result) {
            foreach($result as $get_id){
              $id_proveedor=$get_id['id'];
            }
          }
          if($id_proveedor==null){
            $id_proveedor=1;
          }

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $estado="Activo";
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $stmt=$pdo->prepare("INSERT INTO proveedor (id_proveedor, nombre, nit, nombre_responsable, apellido_responsable, direccion, correo, telefono, observaciones, fecha_ingreso, estado, id_usuario) VALUES (:id_proveedor, :nombre, :nit, :nombre_responsable, :apellido_responsable, :direccion, :correo, :telefono, :observaciones, :fecha_ingreso, :estado, :id_usuario)");
          $stmt->bindParam(":id_proveedor",$id_proveedor,PDO::PARAM_INT);
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":nombre_responsable",$nombre_responsable,PDO::PARAM_STR);
          $stmt->bindParam(":apellido_responsable",$apellido_responsable,PDO::PARAM_STR);
          $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
          $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
          $stmt->bindParam(":observaciones",$observaciones,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
          
          if($stmt->execute()){
            return "Exito";
          }else{
            return "Error";
          }
          $stmt->close();
        
          return $msj;
        }
    }else if($bandera=="edit"){
      $msj="Error";
    
      function obtenerResultado(){
        include ("conexion.php");
        $id_proveedor=$_POST["id_proveedor"];

        $nombre=$_POST["nombre"];
        $nombre_responsable=$_POST["nombre_responsable"];
        $apellido_responsable=$_POST["apellido_responsable"];
        $nit=$_POST["nit"];
        $observaciones=$_POST["observaciones"];
        $direccion=$_POST["direccion"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];
          
          
          /*$tipo_ayuda=$_POST["tipo_ayuda"];
          if($_POST["otro_tipo_ayuda"]!=""){
            $tipo_ayuda=$_POST["otro_tipo_ayuda"];
          }

          $fecha_ingres=$_POST["fecha_ingreso"];
          
          $id_emprendedor=$_POST["emp"];
          if($_POST["emprendedor"]!=""){
            $id_emprendedor=$_POST["emprendedor"];
          }

          if($tipo_ayuda==""){ $tipo_ayuda=$_POST["tipo_a"]; } 
          
          date_default_timezone_set('America/El_Salvador');
        
          $fecha_ingreso=$fecha_ingres;
          list($dia, $mes, $year)=explode("/", $fecha_ingres);
          $fecha_ingreso=$year."-".$mes."-".$dia;*/
          
          $stmt=$pdo->prepare("UPDATE proveedor SET nombre=:nombre, nit=:nit, nombre_responsable=:nombre_responsable, apellido_responsable=:apellido_responsable, direccion=:direccion, correo=:correo, telefono=:telefono, observaciones=:observaciones WHERE id_proveedor=:id_proveedor");
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":nombre_responsable",$nombre_responsable,PDO::PARAM_STR);
          $stmt->bindParam(":apellido_responsable",$apellido_responsable,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
          $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
          $stmt->bindParam(":observaciones",$observaciones,PDO::PARAM_STR);
          $stmt->bindParam(":id_proveedor",$id_proveedor,PDO::PARAM_INT);

          if($stmt->execute()){
            return "Exito";
          }else{
            return "Error";
          }
          $stmt->close();
      
        return $msj;
      }
  }else if($bandera=="dar_baja"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("conexion.php");
        $id_proveedor=$_POST["id"];
        $estado="Inactivo";
    
        $stmt=$pdo->prepare("UPDATE proveedor SET estado=:estado WHERE id_proveedor=:id_proveedor");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_proveedor",$id_proveedor,PDO::PARAM_INT);

        if($stmt->execute()){
          return "Exito";
        }else{
          return "Error";
        }
        $stmt->close();
    
      return $msj;
    }
  }else if($bandera=="dar_alta"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("conexion.php");
        $id_proveedor=$_POST["id"];
        $estado="Activo";
    
        $stmt=$pdo->prepare("UPDATE proveedor SET estado=:estado WHERE id_proveedor=:id_proveedor");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_proveedor",$id_proveedor,PDO::PARAM_INT);

        if($stmt->execute()){
          return "Exito";
        }else{
          return "Error";
        }
        $stmt->close();
    
      return $msj;
    }
  }

  }

 
    echo obtenerResultado();
?>