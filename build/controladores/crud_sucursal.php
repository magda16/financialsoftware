<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{

  if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="edit"){
      $msj="Error";
    
      function obtenerResultado(){
        include ("conexion.php");
          
          $nombre=$_POST["nombre"];
          $codigo=$_POST["codigo"];
          $nit=$_POST["nit"];
          $nrc=$_POST["nrc"];
          $giro=$_POST["giro"];
          $iva=$_POST["iva"];
          $direccion=$_POST["direccion"];
          $correo=$_POST["correo"];
          $telefono=$_POST["telefono"];

          date_default_timezone_set('America/El_Salvador');
          $fecha_update=date("Y-m-d H:i:s");

          if(($_FILES['file']['tmp_name'])!=""){
            $dbfile = "";
            $ruta = "../../files";        

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
            
            if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta."/logo".$cmtipo)){
              $dbfile = $ruta."/logo".$cmtipo;
            }

            $file= substr($dbfile, 6);
          }else{
            $file=$_POST["logo_r"]; 
          }
                  
          $stmt=$pdo->prepare("UPDATE sucursal SET nombre=:nombre, codigo=:codigo, nit=:nit, nrc=:nrc, giro=:giro, iva=:iva , direccion=:direccion, correo=:correo, telefono=:telefono, logo=:logo, fecha_update=:fecha_update WHERE id_sucursal=1");
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
          $stmt->bindParam(":nit",$nit,PDO::PARAM_STR);
          $stmt->bindParam(":nrc",$nrc,PDO::PARAM_STR);
          $stmt->bindParam(":giro",$giro,PDO::PARAM_STR);
          $stmt->bindParam(":iva",$iva,PDO::PARAM_STR);
          $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
          $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
          $stmt->bindParam(":logo",$file,PDO::PARAM_STR);
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