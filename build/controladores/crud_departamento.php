<?php

  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{

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
        include ("conexion.php");
        $id_departamento=$_POST["id_departamento"];
        $codigo=$_POST["codigo"];
        $nombre=$_POST["nombre"];
        $descripcion=$_POST["descripcion"];
          
 
          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");
          
          $stmt=$pdo->prepare("UPDATE departamento SET codigo=:codigo, nombre=:nombre, descripcion=:descripcion WHERE id_departamento=:id_departamento");
          $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
          $stmt->bindParam(":id_departamento",$id_departamento,PDO::PARAM_INT);

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
          $id_departamento=$_POST["id"];
          $estado="Inactivo";

          $stmt=$pdo->prepare("UPDATE departamento SET estado=:estado  WHERE id_departamento=:id_departamento");
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_departamento",$id_departamento,PDO::PARAM_INT);

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
        $id_departamento=$_POST["id"];
        $estado="Activo";
    
        $stmt=$pdo->prepare("UPDATE departamento SET estado=:estado WHERE id_departamento=:id_departamento");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_departamento",$id_departamento,PDO::PARAM_INT);

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
