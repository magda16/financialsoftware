<?php


    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("conexion.php");
          
          $tipo_comprobante=$_POST["tipo_comprobante"];
          $codigo=$_POST["correlativo"];
          $cliente=$_POST["cliente"];
          $monto=$_POST["total"];
         
          $array_id_producto=$_POST["id_product"];
          $array_producto=$_POST["product"];
          $array_cantidad=$_POST["cantida"];
          $array_precio_venta=$_POST["precio_vent"];
          
          $estado="Cancelado";
          
          $stmt = $pdo->prepare("SELECT MAX(id_venta_contado)+1 AS 'id' FROM venta_contado");
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          if ($result) {
            foreach($result as $get_id){
              $id_venta_contado=$get_id['id'];
            }
          }
          if($id_venta_contado==null){
            $id_venta_contado=1;
          }

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $pdo->beginTransaction();

          $stmt=$pdo->prepare("INSERT INTO venta_contado (id_venta_contado, tipo_comprobante, codigo, monto, cliente, fecha_ingreso, estado, id_usuario) VALUES (:id_venta_contado, :tipo_comprobante, :codigo, :monto, :cliente, :fecha_ingreso, :estado, :id_usuario)");
          $stmt->bindParam(":id_venta_contado",$id_venta_contado,PDO::PARAM_INT);
          $stmt->bindParam(":tipo_comprobante",$tipo_comprobante,PDO::PARAM_STR);
          $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
          $stmt->bindParam(":monto",$monto,PDO::PARAM_STR);
          $stmt->bindParam(":cliente",$cliente,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
 
          $acum=0;
          

          for($i=0 ; $i <count($array_cantidad); $i++){

            $result="stmt".$i;
            $result=$pdo->prepare("INSERT INTO detalle_venta_contado (cantidad, precio, id_producto, id_venta_contado) VALUES (:cantidad, :precio, :id_producto, :id_venta_contado)");
            $result->bindParam(":cantidad",$array_cantidad[$i],PDO::PARAM_INT);
            $result->bindParam(":precio",$array_precio_venta[$i],PDO::PARAM_STR);
            $result->bindParam(":id_producto",$array_id_producto[$i],PDO::PARAM_INT);
            $result->bindParam(":id_venta_contado",$id_venta_contado,PDO::PARAM_INT);
            if($result->execute()){
              $acum++;
            }
            
          }
         
          

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