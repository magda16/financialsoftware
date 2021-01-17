<?php

    $codigo=$_POST["correlativo"];
    $cliente=$_POST["cliente"];
    $tipo_comprobante=$_POST["tipo_comprobante"];
    $productos=$_POST["productos"];// cantidad de articulos
    $total=$_POST["total"];
    $efectivo=$_POST["efectivo"];
    $cambio=$_POST["cambio"];

    $array_producto=$_POST["product"];
    $array_cantidad=$_POST["cantida"];
    $array_precio_venta=$_POST["precio_vent"];

    include ("../../build/controladores/conexion.php");

    $stmt= $pdo->prepare("SELECT * FROM sucursal WHERE id_sucursal=1");
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $lista_sucursal){ 
        $nombre_r=strtoupper($lista_sucursal['nombre']);
        $codigo_r=$lista_sucursal['codigo'];
        $nit_r=$lista_sucursal['nit'];
        $nrc_r=$lista_sucursal['nrc'];
        $giro_r=strtoupper($lista_sucursal['giro']);
        $direccion_r=strtoupper($lista_sucursal['direccion']);
        $telefono_r=$lista_sucursal['telefono'];
        $logo_r=$lista_sucursal['logo'];
    }


/*$bandera= (isset($_REQUEST["bandera"])) ? $_REQUEST["bandera"] : "";

  if ($bandera == "add") {

    require_once "../dao/DAOVenta.php";  
    $daoV=new DAOVenta();
    require_once "../dao/DAOFactura.php";  
    $daoF=new DAOFactura();
    
    $cliente=$_POST["cliente"];
    $fecha=$_POST["fecha"];
    $tipo=$_POST["tipo"];
    $codigo=$_POST["codigo_e"];
    $productos=$_POST["productos_e"];
    $total=$_POST["total_e"];
    $efectivo=$_POST["efectivo"];
    $cambio=$_POST["cambio_e"];

    $array_id=$_POST["id"];
    $array_nombre=$_POST["nombre"];
    $array_existencia=$_POST["existencia"];
    $array_costo=$_POST["costo_u"];
    $array_cantidad=$_POST["cantidad_u"];
    $id_usuario=$_POST["id_usuario"];
    $estado="cancelado";
   
        if ($daoV->insertar(new ClaseVenta(null,$codigo,$tipo,$productos,$total))==1) {   
            for($i=0 ; $i <count($array_id); $i++ ){
              if($array_id[$i] !=""){
                $resta=($array_existencia[$i]-$array_cantidad[$i]);
                  $daoF->insertar(new ClaseFactura(null,$tipo,$codigo,$fecha,$array_id[$i],$array_cantidad[$i],$array_costo[$i],$cliente,$id_usuario,$estado));
                  if($resta>0){
                    $daoV->actualizarM($array_cantidad[$i],$array_id[$i]);
                  }else{
                    $daoV->actualizarMedicamentoC($array_id[$i]);
                  }
                }
            }

            msg("Sys-Farmacia", "Datos almacenados", "success","ventaa.php",1000);
        } else {
            msg("Sys-Farmacia", "Error de guardado!", "danger","ventaa.php",1000);
        }
   
              
              
  }

  function msg($titulo, $texto, $tipo,$pagina,$tiempo)
  {
      echo "<script type='text/javascript'>";
      echo "mostrarMensaje('$titulo','$texto','$tipo','$pagina','$tiempo');";
      echo "</script>";
  }

  if($tipo=="Ticket"){ */

?>

<!DOCTYPE html>
<html>
    <head>
    <title>Ticket</title>
    <style type="text/css">
		* {
        font-size: 12px;
        font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.producto,
        th.producto {
            width: 75px;
            max-width: 75px;
        }

        td.cantidad,
        th.cantidad {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.precio,
        th.precio {
            width: 60px;
            max-width: 60px;
            word-break: break-all;
        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 155px;
            max-width: 155px;
        }

        img {
            max-width: inherit;
            width: inherit;
        }
        @media print {
        .oculto-impresion,
        .oculto-impresion * {
            display: none !important;
        }
	</style>
	<script type="text/javascript">
		function imprimir() {
            window.print();
        }
	</script>
    </head>
    <body>
        <div class="ticket">
        
            <img
                src="<?php echo "../../".$logo_r; ?>"
                alt="Logotipo">
            <p class="centrado"><?php echo $nombre_r ?>
                <br>TICKET
                <br>No. <?php echo $codigo ?>
                <br><?php echo $direccion_r ?>
                <br>Caja: <?php// echo $id_usuario ?>
                <br>NIT: <?php echo $nit_r ?>
                <br>NRC: <?php echo $nrc_r ?>
                <br>Tel: <?php echo $telefono_r ?>
                <br>Giro: <?php echo $giro_r ?>
                <br><?php   date_default_timezone_set('America/El_Salvador');
                            echo "Fecha: ".date('d/m/Y');
                            echo "<br>Hora: ".date('h:i:s a');
                 ?></p>
            <table>
                <thead>
                    <tr>
                        <th class="cantidad">Cant</th>
                        <th class="producto">Descripción</th>
                        <th class="precio">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            for($i=0 ; $i <count($array_cantidad); $i++ ){
                                if($array_cantidad[$i] !=""){
                                    echo "<tr>";
                                        echo "<td class='cantidad'>".$array_cantidad[$i]."</td>";
                                        echo "<td class='producto'>".$array_producto[$i]."</td>";
                                        echo "<td class='precio'>$ ".number_format($array_precio_venta[$i],2)."</td>";
                                    echo "</tr>";
                                    
                                }
                              }
                            
                        ?>
                    <tr>
                        <td class="cantidad"></td>
                        <td class="producto">TOTAL</td>
                        <td class="precio"><?php echo "$ ".number_format($total,2); ?></td>
                    </tr>
                    <tr>
                        <td class="cantidad"></td>
                        <td class="producto">EFECTIVO</td>
                        <td class="precio"><?php echo "$ ".number_format($efectivo,2); ?></td>
                    </tr>
                    <tr>
                        <td class="cantidad"></td>
                        <td class="producto">CAMBIO</td>
                        <td class="precio"><?php echo "$ ".number_format($cambio,2); ?></td>
                    </tr>
                </tbody>
            </table>
            <p class="centrado">*Gracias por Preferirnos*</p>
            
                
        </div>
        <button class="centrado oculto-impresion" onclick="imprimir()">Imprimir</button>

    </body>
</html>
<?php//} ?>