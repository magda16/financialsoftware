<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("conexion.php");
         
          $nit=$_POST["nit"];
          $direccion=$_POST["direccion"];
          $correo=$_POST["correo"];
          $telefono=$_POST["telefono"];

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $estado="Activo";
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $tipo_cliente=$_POST["tipo_cliente"];

          if($tipo_cliente == "Persona"){

            $nombre=$_POST["nombre"];
            $apellido=$_POST["apellido"];
            $dui=$_POST["dui"];
            $fecha_nacimiento=$_POST["fecha_nacimiento"];
            $genero=$_POST["genero"];

            $dato = "";

            $stmt = $pdo->prepare("SELECT MAX(id_cliente)+1 AS 'id' FROM cliente");
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            if ($result) {
              foreach($result as $get_id){
                $id_cliente=$get_id['id'];
              }
            }
            if($id_cliente==null){
              $id_cliente=1;
            }
  
            if(($_FILES['file']['tmp_name'])!=""){
              
              $ruta = "../../client/".$id_cliente;
              function llenarArchivos($ruta2){
  
                $foto="";
  
                function validarTipoDoc($doc){
                  $tipo=null;
                  if ($doc=="image/jpg") {
                    $tipo=".jpg";
                  }else if ($doc=="image/jpeg") {
                    $tipo=".jpeg";
                  }else if ($doc=="image/png") {
                    $tipo=".png";
                  }
                  return $tipo;
                }
      
                $cmtype = $_FILES['file']['type'];
                $cmtipo=validarTipoDoc($cmtype);
                
                $directorio=$ruta2."/fotografia".$cmtipo;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $directorio)){
                  $foto = $directorio;
                }
                return $foto;                
              }
  
              if(!file_exists($ruta)){
                mkdir($ruta, 0777,true);
                if(file_exists($ruta)){
                  $dato = llenarArchivos($ruta);
                }
              }else{
                $dato = llenarArchivos($ruta);
              }
           
            }
  
            if($dato != ""){
              $fotografia = substr($dato, 6);
            }else {
              $fotografia ="";
            }

            $fecha_nac=$fecha_nacimiento;
            list($dia, $mes, $year)=explode("/", $fecha_nacimiento);
            $fecha_nac=$year."-".$mes."-".$dia;

            $stmt=$pdo->prepare("INSERT INTO cliente (id_cliente, nombre, apellido, dui, nit, fecha_nac, genero, direccion, correo, telefono, fotografia, fecha_ingreso, estado, id_usuario) VALUES (:id_cliente, :nombre, :apellido, :dui, :nit, :fecha_nac, :genero, :direccion, :correo, :telefono, :fotografia, :fecha_ingreso, :estado, :id_usuario)");
            $stmt->bindParam(":id_cliente",$id_cliente,PDO::PARAM_INT);
            $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $stmt->bindParam(":apellido",$apellido,PDO::PARAM_STR);
            $stmt->bindParam(":dui",$dui,PDO::PARAM_STR);
            $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nac",$fecha_nac,PDO::PARAM_STR);
            $stmt->bindParam(":genero",$genero,PDO::PARAM_STR);
            $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
            $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
            $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
            $stmt->bindParam(":fotografia",$fotografia,PDO::PARAM_STR);
            $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
            $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);

            if($stmt->execute()){
              return "Exito";
            }else{
              $url="../../".$fotografia;
              if(file_exists($url)){
                if (unlink($url)) {
                  $dir="../../client/".$id_cliente;
                  rmdir($dir);
                }
              }
              return "Error";
            }

          }else{

            $nombre=$_POST["nombre_institucion"];
            $nrc=$_POST["nrc"];

            $dato = "";

            $stmt = $pdo->prepare("SELECT MAX(id_cliente_institucion)+1 AS 'id' FROM cliente_institucion");
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
            if ($result) {
              foreach($result as $get_id){
                $id_cliente_institucion=$get_id['id'];
              }
            }
            if($id_cliente_institucion==null){
              $id_cliente_institucion=1;
            }
  
            if(($_FILES['file']['tmp_name'])!=""){
              
              $ruta = "../../institution_client/".$id_cliente_institucion;
              function llenarArchivos($ruta2){
  
                $foto="";
  
                function validarTipoDoc($doc){
                  $tipo=null;
                  if ($doc=="image/jpg") {
                    $tipo=".jpg";
                  }else if ($doc=="image/jpeg") {
                    $tipo=".jpeg";
                  }else if ($doc=="image/png") {
                    $tipo=".png";
                  }
                  return $tipo;
                }
      
                $cmtype = $_FILES['file']['type'];
                $cmtipo=validarTipoDoc($cmtype);
                
                $directorio=$ruta2."/fotografia".$cmtipo;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $directorio)){
                  $foto = $directorio;
                }
                return $foto;                
              }
  
              if(!file_exists($ruta)){
                mkdir($ruta, 0777,true);
                if(file_exists($ruta)){
                  $dato = llenarArchivos($ruta);
                }
              }else{
                $dato = llenarArchivos($ruta);
              }
           
            }
  
            if($dato != ""){
              $fotografia = substr($dato, 6);
            }else {
              $fotografia ="";
            }

            $stmt=$pdo->prepare("INSERT INTO cliente_institucion (id_cliente_institucion, nombre, nit, nrc, direccion, correo, telefono, fotografia, fecha_ingreso, estado, id_usuario) VALUES (:id_cliente_institucion, :nombre, :nit, :nrc, :direccion, :correo, :telefono, :fotografia, :fecha_ingreso, :estado, :id_usuario)");
            $stmt->bindParam(":id_cliente_institucion",$id_cliente_institucion,PDO::PARAM_INT);
            $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
            $stmt->bindParam(":nrc",$nrc,PDO::PARAM_STR);
            $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
            $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
            $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
            $stmt->bindParam(":fotografia",$fotografia,PDO::PARAM_STR);
            $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
            $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);

            if($stmt->execute()){
              return "Exito";
            }else{
              $url="../../".$fotografia;
              if(file_exists($url)){
                if (unlink($url)) {
                  $dir="../../institution_client/".$id_cliente_institucion;
                  rmdir($dir);
                }
              }
              return "Error";
            }

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

}else{
  throw new Exception("Error Processing Request", 1);   
}
 
    echo obtenerResultado();
?>