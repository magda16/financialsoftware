<?php


    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("conexion.php");
          
         
          $array_id_producto=$_POST["id_product"];
          $array_cantidad=$_POST["cantida"];
          $array_precio_compra=$_POST["precio_compr"];
          $tipo_pago=$_POST["tipo_pago"];
          $fecha_compra=$_POST["fecha"];
          $monto=$_POST["total"];

          if($tipo_pago == "Contado"){
            $estado="Cancelado";
          }else{
            $estado="Pendiente";
          }
          $stmt = $pdo->prepare("SELECT MAX(id_compra)+1 AS 'id' FROM compra");
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          if ($result) {
            foreach($result as $get_id){
              $id_compra=$get_id['id'];
            }
          }
          if($id_compra==null){
            $id_compra=1;
          }

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $fecha=$fecha_compra;
          list($dia, $mes, $year)=explode("/", $fecha_compra);
          $fecha=$year."-".$mes."-".$dia;

         
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $stmt=$pdo->prepare("INSERT INTO compra (id_compra, tipo_pago, monto, fecha, fecha_ingreso, estado, id_usuario) VALUES (:id_compra, :tipo_pago, :monto, :fecha, :fecha_ingreso, :estado, :id_usuario)");
          $stmt->bindParam(":id_compra",$id_compra,PDO::PARAM_INT);
          $stmt->bindParam(":tipo_pago",$tipo_pago,PDO::PARAM_STR);
          $stmt->bindParam(":monto",$monto,PDO::PARAM_STR);
          $stmt->bindParam(":fecha",$fecha,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
 
          $acum=0;

          for($i=0 ; $i <count($array_cantidad); $i++){

            $result="stmt".$i;
            $result=$pdo->prepare("INSERT INTO detalle_compra (cantidad, precio, id_producto, id_compra) VALUES (:cantidad, :precio, :id_producto, :id_compra)");
            $result->bindParam(":cantidad",$array_cantidad[$i],PDO::PARAM_INT);
            $result->bindParam(":precio",$array_precio_compra[$i],PDO::PARAM_STR);
            $result->bindParam(":id_producto",$array_id_producto[$i],PDO::PARAM_INT);
            $result->bindParam(":id_compra",$id_compra,PDO::PARAM_INT);
            if($result->execute()){
              $acum++;
            }
            
          }
         
          $pdo->beginTransaction();

          if($stmt->execute() && $i==$acum){
            $pdo->commit();
            return "Exito";
          }else{
            $pdo->rollBack();
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