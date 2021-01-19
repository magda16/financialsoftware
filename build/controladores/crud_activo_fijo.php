<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{

    if(isset($_POST["bandera"])){
  
    $bandera=$_POST["bandera"];

    if($bandera=="add"){
        $msj="Error";
        
        function obtenerResultado(){
          include ("conexion.php");

          /// todo activo mayor a 600 se calcula deprecion
          // Edificios 40 años vida util
          // moviliario 5 años
          // maquinaria y equipo 10
          // vehiculos 10 años
          
          
          $id_categoria=$_POST["categoria"];
          $id_subcategoria=$_POST["tipo_bien"];
          $codigo_inv=$_POST["codigo_inv"];
          $correlativo=$_POST["correlativo"];
          $descripcion=$_POST["descripcion"];
          $observacion=$_POST["observacion"];
          $calidad=$_POST["calidad"];
          $marca=$_POST["marca"];
          $modelo=$_POST["modelo"];
          $fecha_adq=$_POST["fecha_adquisicion"];
          $financiamiento=$_POST["financiamiento"];
          $anios_uso="0";
          if($_POST["anios_uso"]!=""){
            $anios_uso=$_POST["anios_uso"];
          }
          $valor_adquisicion=$_POST["valor_adquisicion"];
          $valor_estimado=$_POST["valor_estimado"];
          $valor_residual=$_POST["valor_residual"];
          $vida_util=$_POST["vida_util"];
          $id_proveedor=$_POST["proveedor"];
          $motivo="";
          $lote="";
          $acum=0;
          $directorio="";
          $stmt = $pdo->prepare("SELECT MAX(id_activo_fijo)+1 AS 'id' FROM activo_fijo");
          $stmt->execute();
          $result=$stmt->fetchAll(PDO::FETCH_ASSOC);  
          if ($result) {
            foreach($result as $get_id){
              $id_activo_fijo=$get_id['id'];
            }
          }
          if($id_activo_fijo==null){
            $id_activo_fijo=1;
          }
          $dato = "";
          $num_serie="";
          $cantidad="";
          $carpeta="";
          if($_POST["nserie"]!=""){
            $num_serie=$_POST["nserie"];
            $carpeta=$id_activo_fijo;
          }else{
            $cantidad=$_POST["cantidad"];
            $carpeta="lote-".$id_activo_fijo."-".($id_activo_fijo + ($cantidad-1));
          }
          if(($_FILES['doc_adquisicion']['tmp_name'])!=""){
            
            $ruta = "../../fixed_asset/".$carpeta;
            function llenarArchivos($ruta2){

              $doc_aq="";

              function validarTipoDoc($doc){
                $tipo=null;
                if($doc=="application/pdf"){
                  $tipo=".pdf";
                }else if ($doc=="image/jpg") {
                  $tipo=".jpg";
                }else if ($doc=="image/jpeg") {
                  $tipo=".jpeg";
                }else if ($doc=="image/png") {
                  $tipo=".png";
                }
                return $tipo;
              }
    
              $cmtype = $_FILES['doc_adquisicion']['type'];
              $cmtipo=validarTipoDoc($cmtype);
              
              $directorio=$ruta2."/documento_adquisicion".$cmtipo;
              if(move_uploaded_file($_FILES['doc_adquisicion']['tmp_name'], $directorio)){
                $doc_aq = $directorio;
              }
              return $doc_aq;                
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
            $doc_adquisicion = substr($dato, 6);
          }else {
            $doc_adquisicion="";
          }

          date_default_timezone_set('America/El_Salvador');
          $fecha_ingreso=date("Y-m-d H:i:s");

          $fecha_adquisicion=$fecha_adq;
          list($dia, $mes, $year)=explode("/", $fecha_adq);
          $fecha_adquisicion=$year."-".$mes."-".$dia;

          $estado="Activo";
          //$id_usuario=$_POST["id_usuario"];
          $id_usuario=1;

          $pdo->beginTransaction();

          if($num_serie!=""){
            
            $codigo=$codigo_inv."-".$correlativo;

            $stmt1=$pdo->prepare("INSERT INTO activo_fijo (id_activo_fijo, codigo, descripcion, observacion, calidad, marca, modelo, num_serie, lote, fecha_adquisicion, financiamiento, anios_uso, valor_adquisicion, valor_estimado, valor_residual, vida_util, doc_adquisicion, id_categoria, id_subcategoria, id_proveedor, fecha_ingreso, estado, motivo, id_usuario) VALUES (:id_activo_fijo, :codigo, :descripcion, :observacion, :calidad, :marca, :modelo, :num_serie, :lote, :fecha_adquisicion, :financiamiento, :anios_uso, :valor_adquisicion, :valor_estimado, :valor_residual, :vida_util, :doc_adquisicion, :id_categoria, :id_subcategoria, :id_proveedor, :fecha_ingreso, :estado, :motivo, :id_usuario)");
            $stmt1->bindParam(":id_activo_fijo",$id_activo_fijo,PDO::PARAM_INT);
            $stmt1->bindParam(":codigo",$codigo,PDO::PARAM_STR);
            $stmt1->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
            $stmt1->bindParam(":observacion",$observacion,PDO::PARAM_STR);
            $stmt1->bindParam(":calidad",$calidad,PDO::PARAM_STR);
            $stmt1->bindParam(":marca",$marca,PDO::PARAM_STR);
            $stmt1->bindParam(":modelo",$modelo,PDO::PARAM_STR);
            $stmt1->bindParam(":num_serie",$num_serie,PDO::PARAM_STR);
            $stmt1->bindParam(":lote",$lote,PDO::PARAM_STR);
            $stmt1->bindParam(":fecha_adquisicion",$fecha_adquisicion,PDO::PARAM_STR);
            $stmt1->bindParam(":financiamiento",$financiamiento,PDO::PARAM_STR);
            $stmt1->bindParam(":anios_uso",$anios_uso,PDO::PARAM_INT);
            $stmt1->bindParam(":valor_adquisicion",$valor_adquisicion,PDO::PARAM_STR);
            $stmt1->bindParam(":valor_estimado",$valor_estimado,PDO::PARAM_STR);
            $stmt1->bindParam(":valor_residual",$valor_residual,PDO::PARAM_STR);
            $stmt1->bindParam(":vida_util",$vida_util,PDO::PARAM_INT);
            $stmt1->bindParam(":doc_adquisicion",$doc_adquisicion,PDO::PARAM_STR);
            $stmt1->bindParam(":id_categoria",$id_categoria,PDO::PARAM_INT);
            $stmt1->bindParam(":id_subcategoria",$id_subcategoria,PDO::PARAM_INT);
            $stmt1->bindParam(":id_proveedor",$id_proveedor,PDO::PARAM_INT);
            $stmt1->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
            $stmt1->bindParam(":estado",$estado,PDO::PARAM_STR);
            $stmt1->bindParam(":motivo",$motivo,PDO::PARAM_STR);
            $stmt1->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
            if($stmt1->execute()){
              $pdo->commit();
              return "Exito";
            }else{
              $url="../../".$doc_adquisicion;
              if(file_exists($url)){
                if (unlink($url)) {
                  $dir="../../fixed_asset/".$carpeta;
                  rmdir($dir);
                }
              }

              $pdo->rollBack();
              return "Error";
            }
          }else {
            $lote=$carpeta;

            $cod=$correlativo;
            for($i=0 ; $i <$cantidad; $i++){

              $result="stmt".$i;
              $numeroConCeros = str_pad($cod, 6, "0", STR_PAD_LEFT);
              $codigo=$codigo_inv."-".$numeroConCeros;
              $result=$pdo->prepare("INSERT INTO activo_fijo (codigo, descripcion, observacion, calidad, marca, modelo, num_serie, lote, fecha_adquisicion, financiamiento, anios_uso, valor_adquisicion, valor_estimado, valor_residual, vida_util, doc_adquisicion, id_categoria, id_subcategoria, id_proveedor, fecha_ingreso, estado, motivo, id_usuario) VALUES (:codigo, :descripcion, :observacion, :calidad, :marca, :modelo, :num_serie, :lote, :fecha_adquisicion, :financiamiento, :anios_uso, :valor_adquisicion, :valor_estimado, :valor_residual, :vida_util, :doc_adquisicion, :id_categoria, :id_subcategoria, :id_proveedor, :fecha_ingreso, :estado, :motivo, :id_usuario)");
              $result->bindParam(":codigo",$codigo,PDO::PARAM_STR);
              $result->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
              $result->bindParam(":observacion",$observacion,PDO::PARAM_STR);
              $result->bindParam(":calidad",$calidad,PDO::PARAM_STR);
              $result->bindParam(":marca",$marca,PDO::PARAM_STR);
              $result->bindParam(":modelo",$modelo,PDO::PARAM_STR);
              $result->bindParam(":num_serie",$num_serie,PDO::PARAM_STR);
              $result->bindParam(":lote",$lote,PDO::PARAM_STR);
              $result->bindParam(":fecha_adquisicion",$fecha_adquisicion,PDO::PARAM_STR);
              $result->bindParam(":financiamiento",$financiamiento,PDO::PARAM_STR);
              $result->bindParam(":anios_uso",$anios_uso,PDO::PARAM_INT);
              $result->bindParam(":valor_adquisicion",$valor_adquisicion,PDO::PARAM_STR);
              $result->bindParam(":valor_estimado",$valor_estimado,PDO::PARAM_STR);
              $result->bindParam(":valor_residual",$valor_residual,PDO::PARAM_STR);
              $result->bindParam(":vida_util",$vida_util,PDO::PARAM_INT);
              $result->bindParam(":doc_adquisicion",$doc_adquisicion,PDO::PARAM_STR);
              $result->bindParam(":id_categoria",$id_categoria,PDO::PARAM_INT);
              $result->bindParam(":id_subcategoria",$id_subcategoria,PDO::PARAM_INT);
              $result->bindParam(":id_proveedor",$id_proveedor,PDO::PARAM_INT);
              $result->bindParam(":fecha_ingreso",$fecha_ingreso,PDO::PARAM_STR);
              $result->bindParam(":estado",$estado,PDO::PARAM_STR);
              $result->bindParam(":motivo",$motivo,PDO::PARAM_STR);
              $result->bindParam(":id_usuario",$id_usuario,PDO::PARAM_INT);
              if($result->execute()){
                $acum++;
                $cod++;
              }

            }

            if($i==$acum){
              $pdo->commit();
              return "Exito";
            }else{
              $url="../../".$doc_adquisicion;
              if(file_exists($url)){
                if (unlink($url)) {
                  $dir="../../fixed_asset/".$carpeta;
                  rmdir($dir);
                }
              }

              $pdo->rollBack();
              return "Error";
            }
            
          } 
          
          $stmt->close();
        
          return $msj;
        }
    }else if($bandera=="edit"){
      $msj="Error";
    
      function obtenerResultado(){
        include ("conexion.php");
      
          $id_activo_fijo=$_POST["id_activo_fijo"];
          $descripcion=$_POST["descripcion"];
          $observacion=$_POST["observacion"];
          $calidad=$_POST["calidad"];
          $marca=$_POST["marca"];
          $modelo=$_POST["modelo"];
          $fecha_adq=$_POST["fecha_adquisicion"];
          $financiamiento=$_POST["financiamiento"];
          $anios_uso="0";
          if($_POST["anios_uso"]!=""){
            $anios_uso=$_POST["anios_uso"];
          }

          if($financiamiento == "Nuevo" || $financiamiento == "Donado"){
            $anios_uso="0";
          }
          $valor_adquisicion=$_POST["valor_adquisicion"];
          $valor_estimado=$_POST["valor_estimado"];
          $valor_residual=$_POST["valor_residual"];
          $vida_util=$_POST["vida_util"];
          $id_proveedor=$_POST["proveedor"];
          
          $directorio="";
          
          $dato = "";
          $num_serie="";
          $carpeta="";
          if($_POST["nserie"]!=""){
            $num_serie=$_POST["nserie"];
            $carpeta=$id_activo_fijo;
          }else{
            $carpeta=$_POST["lote"];
          }
          if(($_FILES['doc_adquisicion']['tmp_name'])!=""){
            
            $ruta = "../../fixed_asset/".$carpeta;
            function llenarArchivos($ruta2){

              $doc_aq="";

              function validarTipoDoc($doc){
                $tipo=null;
                if($doc=="application/pdf"){
                  $tipo=".pdf";
                }else if ($doc=="image/jpg") {
                  $tipo=".jpg";
                }else if ($doc=="image/jpeg") {
                  $tipo=".jpeg";
                }else if ($doc=="image/png") {
                  $tipo=".png";
                }
                return $tipo;
              }
    
              $cmtype = $_FILES['doc_adquisicion']['type'];
              $cmtipo=validarTipoDoc($cmtype);
              
              $directorio=$ruta2."/documento_adquisicion".$cmtipo;
              if(move_uploaded_file($_FILES['doc_adquisicion']['tmp_name'], $directorio)){
                $doc_aq = $directorio;
              }
              return $doc_aq;                
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
            $doc_adquisicion = substr($dato, 6);
          }else {
            $doc_adquisicion = $_POST["doc_adquisicion_r"];;
          }

          date_default_timezone_set('America/El_Salvador');

          $fecha_adquisicion=$fecha_adq;
          list($dia, $mes, $year)=explode("/", $fecha_adq);
          $fecha_adquisicion=$year."-".$mes."-".$dia;

          $pdo->beginTransaction();
            
          $stmt1=$pdo->prepare("UPDATE activo_fijo SET descripcion=:descripcion, observacion=:observacion, calidad=:calidad, marca=:marca, modelo=:modelo, num_serie=:num_serie, fecha_adquisicion=:fecha_adquisicion, financiamiento=:financiamiento, anios_uso=:anios_uso, valor_adquisicion=:valor_adquisicion, valor_estimado=:valor_estimado, valor_residual=:valor_residual, vida_util=:vida_util, doc_adquisicion=:doc_adquisicion, id_proveedor=:id_proveedor WHERE id_activo_fijo=:id_activo_fijo");
          $stmt1->bindParam(":id_activo_fijo",$id_activo_fijo,PDO::PARAM_INT);
          $stmt1->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
          $stmt1->bindParam(":observacion",$observacion,PDO::PARAM_STR);
          $stmt1->bindParam(":calidad",$calidad,PDO::PARAM_STR);
          $stmt1->bindParam(":marca",$marca,PDO::PARAM_STR);
          $stmt1->bindParam(":modelo",$modelo,PDO::PARAM_STR);
          $stmt1->bindParam(":num_serie",$num_serie,PDO::PARAM_STR);
          $stmt1->bindParam(":fecha_adquisicion",$fecha_adquisicion,PDO::PARAM_STR);
          $stmt1->bindParam(":financiamiento",$financiamiento,PDO::PARAM_STR);
          $stmt1->bindParam(":anios_uso",$anios_uso,PDO::PARAM_INT);
          $stmt1->bindParam(":valor_adquisicion",$valor_adquisicion,PDO::PARAM_STR);
          $stmt1->bindParam(":valor_estimado",$valor_estimado,PDO::PARAM_STR);
          $stmt1->bindParam(":valor_residual",$valor_residual,PDO::PARAM_STR);
          $stmt1->bindParam(":vida_util",$vida_util,PDO::PARAM_INT);
          $stmt1->bindParam(":doc_adquisicion",$doc_adquisicion,PDO::PARAM_STR);
          $stmt1->bindParam(":id_proveedor",$id_proveedor,PDO::PARAM_INT);
          if($stmt1->execute()){
            $pdo->commit();
            return "Exito";
          }else{
            $url="../../".$doc_adquisicion;
            if(file_exists($url)){
              if (unlink($url)) {
                $dir="../../fixed_asset/".$carpeta;
                rmdir($dir);
              }
            }

            $pdo->rollBack();
            return "Error";
          }
          $stmt1->close();
        
          return $msj;
        }
  }else if($bandera=="dar_baja"){
    $msj="Error";
  
    function obtenerResultado(){
        include ("conexion.php");
        $id_activo_fijo=$_POST["baccion"];
        $motivo=$_POST["observacion"];
        $estado="Inactivo";
    
        $stmt=$pdo->prepare("UPDATE activo_fijo SET estado=:estado, motivo=:motivo WHERE id_activo_fijo=:id_activo_fijo");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":motivo",$motivo,PDO::PARAM_STR);
        $stmt->bindParam(":id_activo_fijo",$id_activo_fijo,PDO::PARAM_INT);
        

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
        $id_activo_fijo=$_POST["baccion"];
        $motivo=$_POST["observacion"];
        $estado="Activo";
    
        $stmt=$pdo->prepare("UPDATE activo_fijo SET estado=:estado, motivo=:motivo WHERE id_activo_fijo=:id_activo_fijo");
        $stmt->bindParam(":estado",$estado,PDO::PARAM_STR);
        $stmt->bindParam(":motivo",$motivo,PDO::PARAM_STR);
        $stmt->bindParam(":id_activo_fijo",$id_activo_fijo,PDO::PARAM_INT);

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