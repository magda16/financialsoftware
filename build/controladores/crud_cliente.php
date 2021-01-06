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


          $foto= substr($dato, 6);

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $fecha_nac=$fecha_nacimiento;
          list($dia, $mes, $year)=explode("/", $fecha_nacimiento);
          $fecha_nac=$year."-".$mes."-".$dia;

          $estado="Activo";
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $stmt=$pdo->prepare("INSERT INTO cliente (id_cliente, nombre, apellido, dui, nit, fecha_nac, genero, direccion, correo, telefono, fecha_ingreso, estado, id_usuario) VALUES (:id_cliente, :nombre, :apellido, :dui, :nit, :fecha_nac, :genero, :direccion, :correo, :telefono, :fecha_ingreso, :estado, :id_usuario)");
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

}else{
  throw new Exception("Error Processing Request", 1);   
}
 
    echo obtenerResultado();
?>