<?php
  if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
      $msj="Error";
        
      function obtenerResultado(){
        include ("conexion.php");
          
        $codigo=$_POST["codigo"];
        $categoria=$_POST["categoria"];
        $tipo=$_POST["tipo"];
         
        $stmt = $pdo->prepare("SELECT MAX(id_catalogo_activos)+1 AS 'id' FROM catalogo_activos");
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
        if ($result) {
          foreach($result as $get_id){
            $id_catalogo_activos=$get_id['id'];
          }
        }

        if($id_catalogo_activos==null){
          $id_catalogo_activos=1;
        }

        date_default_timezone_set('America/El_Salvador');
        $fecha_ingreso=date("Y-m-d H:i:s");

        $estado="Activo";
        //$id_usuario=$_POST["id_usuario"];
        $id_usuario=1;

        $stmt=$pdo->prepare("INSERT INTO catalogo_activos (id_catalogo_activos, codigo, categoria, tipo, fecha_ingreso, estado, id_usuario) VALUES (:id_catalogo_activos, :codigo, :categoria, :tipo, :fecha_ingreso, :estado, :id_usuario)");
        $stmt->bindParam(":id_catalogo_activos",$id_catalogo_activos,PDO::PARAM_INT);
        $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
        $stmt->bindParam(":categoria",$categoria,PDO::PARAM_STR);
        $stmt->bindParam(":tipo",$tipo,PDO::PARAM_STR);
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