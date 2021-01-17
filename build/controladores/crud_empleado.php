<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("conexion.php");
          
         
          $nombre=$_POST["nombre"];
          $apellido=$_POST["apellido"];
          $dui=$_POST["dui"];
          $nit=$_POST["nit"];
          $fecha_nacimiento=$_POST["fecha_nacimiento"];
          $genero=$_POST["genero"];
          $puesto=$_POST["puesto"];
          $direccion=$_POST["direccion"];
          $correo=$_POST["correo"];
          $telefono=$_POST["telefono"];
         
          $dato = "";

          $stmt = $pdo->prepare("SELECT MAX(id_empleado)+1 AS 'id' FROM empleado");
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          if ($result) {
            foreach($result as $get_id){
              $id_empleado=$get_id['id'];
            }
          }
          if($id_empleado==null){
            $id_empleado=1;
          }

          if(($_FILES['file']['tmp_name'])!=""){
            
            $ruta = "../../employee/".$id_empleado;
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

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $fecha_nac=$fecha_nacimiento;
          list($dia, $mes, $year)=explode("/", $fecha_nacimiento);
          $fecha_nac=$year."-".$mes."-".$dia;

          $estado="Activo";
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $stmt=$pdo->prepare("INSERT INTO empleado (id_empleado, nombre, apellido, dui, nit, fecha_nac, genero, puesto, direccion, correo, telefono, fotografia, fecha_ingreso, estado, id_usuario) VALUES (:id_empleado, :nombre, :apellido, :dui, :nit, :fecha_nac, :genero, :puesto, :direccion, :correo, :telefono, :fotografia, :fecha_ingreso, :estado, :id_usuario)");
          $stmt->bindParam(":id_empleado",$id_empleado,PDO::PARAM_INT);
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":apellido",$apellido,PDO::PARAM_STR);
          $stmt->bindParam(":dui",$dui,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_nac",$fecha_nac,PDO::PARAM_STR);
          $stmt->bindParam(":genero",$genero,PDO::PARAM_STR);
          $stmt->bindParam(":puesto",$puesto,PDO::PARAM_STR);
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
                $dir="../../employee/".$id_empleado;
                rmdir($dir);
              }
            }
            return "Error";
          }
          $stmt->close();
        
          return $msj;
        }
    }else if($bandera=="edit"){
      $msj="Error";
    
      function obtenerResultado(){
        include ("conexion.php");
        
        $id_empleado=$_POST["id_empleado"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $dui=$_POST["dui"];
        $nit=$_POST["nit"];
        $fecha_nacimiento=$_POST["fecha_nacimiento"];
        $genero=$_POST["genero"];
        $puesto=$_POST["puesto"];
        $direccion=$_POST["direccion"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];
       
        $dato = "";

        if(($_FILES['file']['tmp_name'])!=""){
          
          $ruta = "../../employee/".$id_empleado;
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
          $fotografia =$_POST["foto"];
        }

        date_default_timezone_set('America/El_Salvador');
        $fecha_ingreso=date("Y-m-d H:i:s");

        $fecha_nac=$fecha_nacimiento;
        list($dia, $mes, $year)=explode("/", $fecha_nacimiento);
        $fecha_nac=$year."-".$mes."-".$dia;

        $estado="Activo";
        //$id_usuario=$_POST["id_usuario"];
        $id_usuario=1;

        $stmt=$pdo->prepare("UPDATE empleado SET nombre=:nombre, apellido=:apellido, dui=:dui, nit=:nit, fecha_nac=:fecha_nac, genero=:genero, puesto=:puesto, direccion=:direccion, correo=:correo, telefono=:telefono, fotografia=:fotografia WHERE id_empleado=:id_empleado");
        $stmt->bindParam(":id_empleado",$id_empleado,PDO::PARAM_INT);
        $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $stmt->bindParam(":apellido",$apellido,PDO::PARAM_STR);
        $stmt->bindParam(":dui",$dui,PDO::PARAM_STR);
        $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nac",$fecha_nac,PDO::PARAM_STR);
        $stmt->bindParam(":genero",$genero,PDO::PARAM_STR);
        $stmt->bindParam(":puesto",$puesto,PDO::PARAM_STR);
        $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
        $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
        $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
        $stmt->bindParam(":fotografia",$fotografia,PDO::PARAM_STR);
        
        if($stmt->execute()){
          return "Exito";
        }else{
          $url="../../".$fotografia;
          if(file_exists($url)){
            if (unlink($url)) {
              $dir="../../employee/".$id_empleado;
              rmdir($dir);
            }
          }
          return "Error";
        }
        $stmt->close();
      
        return $msj;
      }
  }else if($bandera=="dar_baja"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("conexion.php");
        $id_empleado=$_POST["id"];
        $estado="Inactivo";
    
        $stmt=$pdo->prepare("UPDATE empleado SET estado=:estado WHERE id_empleado=:id_empleado");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_empleado",$id_empleado,PDO::PARAM_INT);

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
        $id_empleado=$_POST["id"];
        $estado="Activo";
    
        $stmt=$pdo->prepare("UPDATE empleado SET estado=:estado WHERE id_empleado=:id_empleado");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_empleado",$id_empleado,PDO::PARAM_INT);

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