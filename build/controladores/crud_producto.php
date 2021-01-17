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
          $marca=$_POST["marca"];
          $modelo=$_POST["modelo"];
          $margen_ganancia=$_POST["margen_ganancia"];
          $stock_minimo=$_POST["stock_minimo"];
          $descripcion=$_POST["descripcion"];
          $categoria=$_POST["categoria"];
          $proveedor=$_POST["proveedor"];
          $cantidad=0;
          $precio=0;

          $dato = "";

          $stmt = $pdo->prepare("SELECT MAX(id_producto)+1 AS 'id' FROM producto");
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          if ($result) {
            foreach($result as $get_id){
              $id_producto=$get_id['id'];
            }
          }
          if($id_producto==null){
            $id_producto=1;
          }

          if(($_FILES['file']['tmp_name'])!=""){
            
            $ruta = "../../product/".$id_producto;
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
              
              $directorio=$ruta2."/producto".$cmtipo;
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

          $num_correlativo = str_pad($id_producto, 4, "0", STR_PAD_LEFT);

          $nom = substr($nombre, 0, 2);
          $codigo=$nom."".$num_correlativo;

         // $foto= substr($dato, 6);

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $estado="Activo";
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $stmt=$pdo->prepare("INSERT INTO producto (id_producto, codigo, nombre, marca, modelo, margen_ganancia, stock_minimo, cantidad, precio, descripcion, fotografia, categoria, proveedor, fecha_ingreso, estado, id_usuario) VALUES (:id_producto, :codigo, :nombre, :marca, :modelo, :margen_ganancia, :stock_minimo, :cantidad, :precio, :descripcion, :fotografia, :categoria, :proveedor, :fecha_ingreso, :estado, :id_usuario)");
          $stmt->bindParam(":id_producto",$id_producto,PDO::PARAM_INT);
          $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":marca",$marca,PDO::PARAM_STR);
          $stmt->bindParam(":modelo",$modelo,PDO::PARAM_STR);
          $stmt->bindParam(":margen_ganancia",$margen_ganancia,PDO::PARAM_INT);
          $stmt->bindParam(":stock_minimo",$stock_minimo,PDO::PARAM_STR);
          $stmt->bindParam(":cantidad",$cantidad,PDO::PARAM_INT);
          $stmt->bindParam(":precio",$precio,PDO::PARAM_STR);
          $stmt->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
          $stmt->bindParam(":fotografia",$fotografia,PDO::PARAM_STR);
          $stmt->bindParam(":categoria",$categoria,PDO::PARAM_STR);
          $stmt->bindParam(":proveedor",$proveedor,PDO::PARAM_INT);
          $stmt->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
          $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
          $stmt->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
          
          if($stmt->execute()){
            return "Exito";
          }else{
            $url="../../".$fotografia;
            if(file_exists($url)){
              if (unlink($url)) {
                $dir="../../product/".$id_producto;
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
          
          $id_producto=$_POST["id_producto"];
          $nombre=$_POST["nombre"];
          $marca=$_POST["marca"];
          $modelo=$_POST["modelo"];
          $margen_ganancia=$_POST["margen_ganancia"];
          $stock_minimo=$_POST["stock_minimo"];
          $descripcion=$_POST["descripcion"];
          $categoria=$_POST["categoria"];
          $proveedor=$_POST["proveedor"];

          $num_correlativo = str_pad($id_producto, 4, "0", STR_PAD_LEFT);

          $nom = substr($nombre, 0, 2);
          $codigo=$nom."".$num_correlativo;

          $dato = "";

          if(($_FILES['file']['tmp_name'])!=""){
            
            $ruta = "../../product/".$id_producto;
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
              
              $directorio=$ruta2."/producto".$cmtipo;
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

          $stmt=$pdo->prepare("UPDATE producto SET codigo=:codigo, nombre=:nombre, marca=:marca, modelo=:modelo, margen_ganancia=:margen_ganancia, stock_minimo=:stock_minimo, descripcion=:descripcion, fotografia=:fotografia, categoria=:categoria, proveedor=:proveedor WHERE id_producto=:id_producto");
          $stmt->bindParam(":id_producto",$id_producto,PDO::PARAM_INT);
          $stmt->bindParam(":codigo",$codigo,PDO::PARAM_STR);
          $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
          $stmt->bindParam(":marca",$marca,PDO::PARAM_STR);
          $stmt->bindParam(":modelo",$modelo,PDO::PARAM_STR);
          $stmt->bindParam(":margen_ganancia",$margen_ganancia,PDO::PARAM_INT);
          $stmt->bindParam(":stock_minimo",$stock_minimo,PDO::PARAM_STR);
          $stmt->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
          $stmt->bindParam(":fotografia",$fotografia,PDO::PARAM_STR);
          $stmt->bindParam(":categoria",$categoria,PDO::PARAM_STR);
          $stmt->bindParam(":proveedor",$proveedor,PDO::PARAM_INT);
          
          if($stmt->execute()){
            return "Exito";
          }else{
            $url="../../".$fotografia;
            if(file_exists($url)){
              if (unlink($url)) {
                $dir="../../product/".$id_producto;
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
        $id_producto=$_POST["id"];
        $estado="Inactivo";
    
        $stmt=$pdo->prepare("UPDATE producto SET estado=:estado WHERE id_producto=:id_producto");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_producto",$id_producto,PDO::PARAM_INT);

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
        $id_producto=$_POST["id"];
        $estado="Activo";
    
        $stmt=$pdo->prepare("UPDATE producto SET estado=:estado WHERE id_producto=:id_producto");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":id_producto",$id_producto,PDO::PARAM_INT);

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