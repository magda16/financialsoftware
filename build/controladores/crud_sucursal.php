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

          if(($_FILES['foto']['tmp_name'])!=""){
            $ruta = "../../Archivos";
            $ruta2 = "../../Archivos/".$id_emprendedor;
          
            function llenarArchivos($ruta3){
              $cv = null;
    
              $cv = $_FILES['foto']['tmp_name'];
            
              if(move_uploaded_file($cv, $ruta3."/".$_FILES['foto']['name'])){
                $dbfoto = $ruta3."/".$_FILES['foto']['name'];
              }
  
              return $dbfoto;    
            }
         
            if(!file_exists($ruta)){
              mkdir($ruta, 0777,true);
              if(!file_exists($ruta2)){
                mkdir($ruta2, 0777,true);
                if(file_exists($ruta2)){
                  $dato = llenarArchivos($ruta2);
                }
              }else{
                $dato = llenarArchivos($ruta2);
              }
            }else{
              if(!file_exists($ruta2)){
                mkdir($ruta2, 0777,true);
                if(file_exists($ruta2)){
                  $dato = llenarArchivos($ruta2);
                }
              }else{
                $dato = llenarArchivos($ruta2);
              }
            }
          }

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


          $foto= substr($dato, 6);

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $fecha_nac=$fecha_nacimiento;
          list($dia, $mes, $year)=explode("/", $fecha_nacimiento);
          $fecha_nac=$year."-".$mes."-".$dia;

          $estado="Activo";
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $stmt=$pdo->prepare("INSERT INTO empleado (id_empleado, nombre, apellido, dui, nit, fecha_nac, genero, puesto, direccion, correo, telefono, fecha_ingreso, estado, id_usuario) VALUES (:id_empleado, :nombre, :apellido, :dui, :nit, :fecha_nac, :genero, :puesto, :direccion, :correo, :telefono, :fecha_ingreso, :estado, :id_usuario)");
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
          
          $nombre=$_POST["nombre"];
          $codigo=$_POST["codigo"];
          $nit=$_POST["nit"];
          $giro=$_POST["giro"];
          $iva=$_POST["iva"];
          $direccion=$_POST["direccion"];
          $correo=$_POST["correo"];
          $telefono=$_POST["telefono"];
          $logo="";

          date_default_timezone_set('America/El_Salvador');
          $fecha_update=date("Y-m-d H:i:s");
         
          $stmt=$pdo->prepare("UPDATE sucursal SET nombre=:nombre, codigo=:codigo, nit=:nit, giro=:giro, iva=:iva , direccion=:direccion, correo=:correo, telefono=:telefono, logo=:logo, fecha_update=:fecha_update WHERE id_sucursal=1");
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":giro",$giro,PDO::PARAM_STR);
          $stmt->bindParam(":iva",$iva,PDO::PARAM_STR);
          $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
          $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
          $stmt->bindParam(":logo",$logo,PDO::PARAM_STR);
          $stmt->bindParam(":fecha_update",$fecha_update,PDO::PARAM_STR);

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