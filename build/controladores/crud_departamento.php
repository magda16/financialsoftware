<?php
  if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
      $msj="Error";
        
      function obtenerResultado(){
        include ("conexion.php");
          
        $codigo=$_POST["codigo"];
        $nombre=$_POST["nombre"];
        $descripcion=$_POST["descripcion"];
         
        $stmt = $pdo->prepare("SELECT MAX(id_departamento)+1 AS 'id' FROM departamento");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        if ($result) {
          foreach($result as $get_id){
            $id_departamento=$get_id['id'];
          }
        }

        if($id_departamento==null){
          $id_departamento=1;
        }

        date_default_timezone_set('America/El_Salvador');
        $fecha_ingreso=date("Y-m-d H:i:s");

        $estado="Activo";
        //$id_usuario=$_POST["id_usuario"];
        $id_usuario=1;

        $stmt=$pdo->prepare("INSERT INTO departamento (id_departamento, codigo, nombre, descripcion, fecha_ingreso, estado, id_usuario) VALUES (:id_departamento, :codigo, :nombre, :descripcion, :fecha_ingreso, :estado, :id_usuario)");
        $stmt->bindParam(":id_departamento",$id_departamento,PDO::PARAM_INT);
        $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
        $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $stmt->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
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
        include ("../conexion.php");
        $id_cooperante=$_POST["actualizar"];

        $nombre_cooperante=$_POST["nombre_cooperante"];
          $monto=$_POST["monto"];
          
          
          $tipo_ayuda=$_POST["tipo_ayuda"];
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
          $fecha_ingreso=$year."-".$mes."-".$dia;
          
          $stmt=$pdo->prepare("UPDATE cooperante SET nombre_cooperante=:nombre_cooperante, monto=:monto, tipo_ayuda=:tipo_ayuda, fecha_ingreso=:fecha_ingreso, id_emprendedor=:id_emprendedor WHERE id_cooperante=:id_cooperante");
          $stmt->bindParam(":nombre_cooperante",$nombre_cooperante,PDO::PARAM_STR);
          $stmt->bindParam(":monto",$monto,PDO::PARAM_STR);
          $stmt->bindParam(":tipo_ayuda",$tipo_ayuda,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
          $stmt->bindParam(":id_emprendedor",$id_emprendedor,PDO::PARAM_INT);
          $stmt->bindParam(":id_cooperante",$id_cooperante,PDO::PARAM_INT);

          if($stmt->execute()){
            return "Exito";
          }else{
            return "Error";
          }
          $stmt->close();
      
        return $msj;
      }
    }else if($bandera=="delete"){
      $msj="Error";
    
      function obtenerResultado(){
          include ("../conexion.php");
          $id_cooperante=$_POST["id"];
      
          $stmt=$pdo->prepare("DELETE FROM cooperante WHERE id_cooperante=:id_cooperante");
          $stmt->bindParam(":id_cooperante",$id_cooperante,PDO::PARAM_INT);

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