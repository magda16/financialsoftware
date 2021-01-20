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

  if($tipo_comprobante=="Ticket"){ 

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
<?php 
    }else if($tipo_comprobante=="Consumidor Final"){      
 ?>

<?php

require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Cabacera
        global $title;

        
        $this->Rect(95,7,50,20,'D');
        $this->SetXY(80,10);
        $this->SetFont('Arial','B',15);
        $this->Cell(80,0,'FACTURA',0,0,'C');
        $this->Ln();
        $this->SetXY(80,17);
        $this->SetFont('Arial','',14);
        $this->SetTextColor(220,50,50);
        $this->Cell(75,3,utf8_decode('N°     '),0,0,'C');
        $this->Ln();
        $this->SetXY(80,20);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',8);
        $this->Cell(49,5,'NIT:',0,0,'C');
        $this->Ln();
        $this->SetXY(80,22);
        $this->SetFont('Arial','B',8);
        $this->Cell(59,7,'N.R.C:',0,0,'C');
        $this->Ln();
        
       $this->SetXY(80,33);
       $this->SetFont('Arial','B',8);
       $this->Cell(80,7,'Fecha:___________________________________',0,0,'L');
        $this->Ln(8);
       
        $this->y1 = $this->GetY();
        
        //Nombre del cliente
        $this->SetXY(9,46); 
        $this->SetFont('Arial','B',8);
        $this->cell(100,1,'Nombre:______________________________________________________________________________');
        $this->Ln();

        //Direccion del cliente
        $this->SetXY(9,53);
        $this->SetFont('Arial','B',8);
        $this->cell(50,1,utf8_decode('Dirección:_____________________________________________________________________________'));
        $this->Ln();

        //NIT o DUI
        $this->SetXY(9,60); 
        $this->SetFont('Arial','B',8);
        $this->cell(50,1,utf8_decode('NIT ó DUI: ________________________'));
        $this->cell(5,1,'',0);
        $this->cell(100,1,'Venta a cuenta de: __________________________________');
        $this->Ln(8);

        $this->SetFont('Arial','B',5);
        $this->Cell(15,10,'CANT.',1);
        $this->Cell(75,10,utf8_decode('DESCRIPCIÓN'),1,0,'C');
        $this->Cell(15,10,'PRECIO UNI.',1);
        $this->Cell(15,10,'V. NO SUJETA',1);
        $this->Cell(15,10,'V. AFECTADAS',1);
        $this->Ln();
        for($i=0;$i<10;$i++){
        $this->Cell(15,10,'',1);
        $this->Cell(75,10,'',1);
        $this->Cell(15,10,'',1);
        $this->Cell(15,10,'',1);
        $this->Cell(15,10,'',1);
        $this->Ln();
        }
        $this->SetFont('Arial','B',6);
        $this->Cell(70,20,'Son:',1);
        $this->Cell(20,10,'Sumas',0);
        $this->Cell(15,10,'',1);
        $this->Cell(15,10,'',1);
        $this->Cell(15,10,'',1);
        $this->Ln();

        $this->Cell(70,25,utf8_decode('LLENAR SI LA OPERACIÓN ES IGUAL O SUPERIOR A $200.00'),0);  
        $this->Cell(20,15,'(-) IVA Retenido',0);
        $this->Cell(15,10,'',0);
        $this->Cell(15,10,'',0);
        $this->Cell(15,10,'',1);
        $this->Ln();
        $this->Cell(70,15,'NOMBRE:',0);  
        $this->Cell(20,15,'Sub-Total',0);
        $this->Cell(15,10,'',0);
        $this->Cell(15,10,'',0);
        $this->Cell(15,10,'',1);
        $this->Ln();

        $this->Cell(70,10,'NIT/DUI:',0);  
        $this->Cell(20,15,'Venta No sujeta',0);
        $this->Cell(15,10,'',0);
        $this->Cell(15,10,'',0);
        $this->Cell(15,10,'',1);
        $this->Ln();

        $this->Cell(70,5,'EXTRANJERO PASAPORTE/CARNET DE RECIDENCIA: ',0);  
        $this->Cell(50,15,'Venta Total',0);
        $this->Cell(15,10,'',1);
        $this->Ln();
        $this->SetXY(10, ($this->GetY()-50));
        $this->Cell(70,50,'',1); 
        $this->Ln();
        $this->Cell(120,0,'',1); 
        $this->Ln();
        $this->SetFont('Arial','B',5);
        $this->Cell(70,4,utf8_decode('Tipografía Cultural Juan Perez. Tel.: 0000-0000'),0);
        $this->Cell(50,4,'ORIGINAL - BLANCO - EMISOR',0);
        $this->Ln();
        $this->Cell(70,1,utf8_decode('Reg. 0000-0 NIT: 0000-00000-000-0 Aut. Imp. No. 000 Fecha Aut. '.date("d/m/Y")),0);
        $this->Cell(50,1,'DUPLICADO - AMARRILLO - CLIENTE',0);
        $this->Ln();
        $this->Cell(70,3,utf8_decode('Resolución No. 00000-RES-IN-00000-2021 Fecha Resol. '.date("d/m/Y")),0);
        $this->Ln();
        $this->Cell(70,2,utf8_decode('Tiraje 21VS00000 -21VS00000000 Fecha de Impresión: '.date("m/Y")),0);
        $this->Ln();

    }


    function Llenar_tabla($titulo_1_factura,$titulo_2_factura,$nombre_empresa,$eslogan1,$eslogan2,$direccion_empresa,$pais_factura,$correlativo_factura,$nit_empresa,$n_s_c_empresa,$nombre_cliente,$direccion_cliente,$nit_cliente, $venta_a_cuenta,$array_producto, $array_cantidad, $array_precio_venta,$array_ventas_no_sujetas,$iva,$carnet_pasaporte,$indice,$can){
        
        
        $suma_precio=0;//acumulador del precio
        $suma_venta_no_sujeta=0;
        $suma_venta_sujeta=0;

        //Titulo de la factura
        $this->SetFont('Arial','IB',15);
        $this->SetXY(5,11);
        $this->Cell(90,0,utf8_decode($titulo_1_factura),0,0,'C');
        $this->Ln();
        $this->SetXY(5,15);
        $this->Cell(90,2,utf8_decode($titulo_2_factura),0,0,'C');
        $this->Ln();
        $this->SetXY(5,19);
        $this->setFont('Arial','I','8');
        $this->Cell(90,3,utf8_decode($nombre_empresa),0,0,'C');
        $this->Ln();
        $this->SetXY(5,23);
        $this->setFont('Arial','B','7');
        $this->Cell(90,3,utf8_decode($eslogan1),0,0,'C');
        $this->Ln();
        $this->SetXY(5,27);
        $this->setFont('Arial','B','7');
        $this->Cell(90,3,utf8_decode($eslogan2),0,0,'C');
        $this->Ln();
        $this->SetXY(5,31);
        $this->setFont('Arial','','8');
        $this->Cell(90,2,utf8_decode($direccion_empresa),0,0,'C');
        $this->Cell(50,1,'',0,'C');
        $this->Ln();
        // Finaliza el Titulo de la factura
        //Despues de la palabra Factura
        $this->SetXY(80,13);
        $this->SetFont('Arial','',8);
        $this->Cell(80,2,$pais_factura,0,0,'C');
        $this->Ln();
        
        ///El correlativo de la factura.
        $this->SetXY(80,17);
        $this->SetFont('Arial','',14);
        $this->SetTextColor(225,50,50);
        $this->Cell(85,3,$correlativo_factura,0,0,'C');
        $this->Ln();

        //Reestablecemos el color de la letra a negro
        $this->SetTextColor(0,0,0);

        //El nit de la empresa
        $this->SetXY(80,20);
        $this->SetFont('Arial','B',8);
        $this->Cell(80,5,$nit_empresa,0,0,'C'); 

        // N.R.C
        $this->SetXY(80,22);
        $this->SetFont('Arial','B',8);
        $this->Cell(84,7,$n_s_c_empresa,0,0,'C');
        $this->Ln();

        //Fecha de la factura
        $this->SetXY(95,32);
        $this->SetFont('Arial','',8);
        $this->Cell(80,8,''.date("d/m/Y"),0,0,'L');

        //A nombre de quien la factura es decir el cliente
        $this->SetXY(25,46); 
        $this->SetFont('Arial','',8);
        $this->Cell(100,0,utf8_decode($nombre_cliente),0,0,'L');
        $this->Ln(); 

        // Direccion del cliente
        $this->SetXY(25,53); 
        $this->SetFont('Arial','',8);
        $this->Cell(100,0,utf8_decode($direccion_cliente),0,0,'L');
        $this->Ln();

        // NIT o DUI del cliente
        $this->SetXY(25,60); 
        $this->SetFont('Arial','',8);
        $this->Cell(50,0,$nit_cliente,0,0,'L');
        $this->Ln();


        $this->SetXY(92,60);
        $this->SetFont('Arial','',8);
        $this->cell(100,0,utf8_decode($venta_a_cuenta),0,0,'L');
        $this->Ln(8);

        //inicia llenar la tabla de la factura
        $this->SetXY(10,80); 
        $this->SetFont('Arial','',7);
        for($i=0; $i<$can;$i++)
        {
            $this->Cell(15,10,$array_cantidad[$indice],0,0,'L');
            $this->Cell(75,10,''.$array_producto[$indice],0,0,'L'); 
            $this->Cell(15,10,'$ '.$array_precio_venta[$indice],0,0,'L'); 
            if(!empty($array_ventas_no_sujetas))
            {
            $this->Cell(15,10,'$ '.$array_ventas_no_sujetas[$indice],0,0,'L');
            $this->Cell(15,10,' ',0,0,'L');

            $suma_venta_no_sujeta= $suma_venta_no_sujeta+$array_ventas_no_sujetas[$indice];
            } 
            
            $this->Cell(15,10,' ',0,0,'L');
            $ventas_efectuadas=round((floor($array_precio_venta[$indice]) * floor($array_cantidad[$indice])),2);
            $this->Cell(15,10,'$ '.$ventas_efectuadas,0,0,'L');
            $suma_venta_sujeta=$suma_venta_sujeta+$ventas_efectuadas;
            
            $this->Ln(); 
            $suma_precio=$suma_precio+ $array_precio_venta[$indice];
       
       
            $indice=$indice+1;  
        }
        
        //Linea de Suma
       
        $this->SetXY(100,183);
        $this->Cell(10,0,'$ '.round($suma_precio,2),0);
       
        if($suma_venta_no_sujeta>0){
            $this->SetXY(115,183);
            $this->Cell(10,0,'$ '.round($suma_venta_no_sujeta,2),0);
            $this->SetXY(130,183);
            $this->Cell(10,0,'',0);
        }else{
            $this->SetXY(115,183);
            $this->Cell(10,0,'',0);
            $this->SetXY(130,183);
            $this->Cell(10,0,'$ '.round($suma_venta_sujeta,2),0);
            }

        $this->Ln();
        //Linea de Suma finaliza

        //Las lineas de Iva retenidas
        $this->SetXY(130,194); 
        $iva_aplicado=0;
        if(!empty($iva)){
            $iva_aplicado=$suma_venta_sujeta*$iva;
            $this->Cell(60,0,'$ '.round($iva_aplicado,2),0);// 
        }else{
            $this->Cell(60,0,'---------------',0);
        }
        

         //Las lineas de Sub-Total
         $this->SetXY(130,204); 
         $this->Cell(60,0,'$ '.round($suma_venta_sujeta+$iva_aplicado,2),0);// 

          //Las lineas de Venta No sujeta
          $this->SetXY(130,214); 
          if($suma_venta_no_sujeta>0){
            $this->Cell(60,0,'$ '.round($suma_venta_no_sujeta,2),0);// 
          }else{
            $this->Cell(60,0,'---------------',0); 
          }
          
           //Las lineas de Venta Total
           $this->SetXY(130,224); 
           $venta_total=$suma_venta_sujeta+$suma_venta_no_sujeta+$iva_aplicado;
           $this->Cell(60,0,'$ '.round($venta_total,2),0);// 
           $this->Ln();

           //Linea de son en letras.

        $formtterES = new NumberFormatter("es-ES",NumberFormatter::SPELLOUT);
        
        $derecha=intval(floor($venta_total));
        $izquierda=intval(($venta_total - floor($venta_total))*100);
       
        $this->SetXY(10,190);
        $this->Cell(60,0, $formtterES->format($derecha).' coma '.$formtterES->format($izquierda),0,0,'L');
        $this->Ln();
        if($venta_total>=200){
                //Las lineas de trabajo son LLENAR SI LA OPERACIÓN ES IGUAL O SUPERIOR A $200.00
                $this->SetXY(21,205); 
                $this->Cell(60,0,utf8_decode($nombre_cliente),0);// Nombre
                $this->SetXY(19,213);
                $this->Cell(60,0,$nit_cliente,0); // NIT/DUI
                $this->SetXY(10,223);
                $this->Cell(60,0,$carnet_pasaporte,0);//PASAPORTE o CARNET
                $this->Ln();
        }
        return $indice;
    }
    
}
$indice=0;//para saber la ubicacion del vector
$pdf = new PDF('P','mm',array(245,155));

$pdf->SetFont('Arial','',14);


    //Esta parte solo es el es logan de la factura
    $titulo_1_factura='';
    $titulo_2_factura='';
    $nombre_empresa=$nombre_r;
    $eslogan1='VENTAS AL POR MENOR DE NUESTROS PRODUCTOS';
    $eslogan2='EN COMERCIOS NO ESPECIALIZADOS';
    $direccion_empresa =$direccion_r;
    //Fin del eslogan

    // Informacion referente a la factura
      $pais_factura='21VS000F';
      $correlativo_factura=$codigo;
      $nit_empresa=$nit_r;
      $n_s_c_empresa=$nrc_r;
    // Finaliza Informacion referente a la factura

    //Informacion del cliente
      $nombre_cliente=$cliente;
      $direccion_cliente='';
      $nit_cliente= '';
      $venta_a_cuenta='';
    // Finaliza Informacion del cliente
    
    //Llenan la tabla de la factura 
    $array_producto = $_POST["product"];
    $array_cantidad = $_POST["cantida"];
    $array_precio_venta = $_POST["precio_vent"];
    $array_ventas_no_sujetas = null;
 
    //// Fin Llenan la tabla de la factura 

    $iva=null;// es el iva

    //carnet o pasaporte
    $carnet_pasaporte='';
    $can_fact=count($array_producto)/10; 
	
    //$can_fact=cantidad_facturas(count($array_producto),0);//es obligatorio por esta funcion extrae el numero de facturas
    $can=$can_fact;//para saber el numero de vuelta 1 representa a diez productos que sean mostrado en una factura
    $vueltas=ceil($can_fact);//el numero de vueltas es decir facturas cuantas son

    $aux=0;
    for($i=0; $i<$vueltas; $i++){
        if($can>1){
            $can=$can-1;//aqui se le resta ya que cada vuelta representa un numero entero 1.2 es decir que hara una vuelta y como la debe de realizar se le quita
            $pdf->AddPage();
            $aux=$pdf->Llenar_tabla($titulo_1_factura,$titulo_2_factura,$nombre_empresa,$eslogan1,$eslogan2,$direccion_empresa,$pais_factura,$correlativo_factura,$nit_empresa,$n_s_c_empresa,$nombre_cliente,$direccion_cliente,$nit_cliente, $venta_a_cuenta,$array_producto, $array_cantidad, $array_precio_venta, $array_ventas_no_sujetas,$iva,$carnet_pasaporte, $indice,10);
             $indice=$aux;
        }else{
            $pdf->AddPage();
            $can=$can*10; //Hacer el decimal a  decena es decir 0.2*10=2 es decir que son dos productos que va ha mostrar
            $aux=$pdf->Llenar_tabla($titulo_1_factura,$titulo_2_factura,$nombre_empresa,$eslogan1,$eslogan2,$direccion_empresa,$pais_factura,$correlativo_factura,$nit_empresa,$n_s_c_empresa,$nombre_cliente,$direccion_cliente,$nit_cliente, $venta_a_cuenta,$array_producto, $array_cantidad, $array_precio_venta, $array_ventas_no_sujetas,$iva,$carnet_pasaporte, $indice,$can);
            $indice=$aux;
        }
        
    }
    


$pdf->Output(); //mostrar el pdf

function cantidad_facturas($size_array,$conta){ //sirve para saber la cantidad de facturas que se haran
        
    $mod=0;
        $resultado=0;
        $resultado=$size_array/10;
        $mod=$size_array%10;
            if($mod==0){
              return $resultado;
            }else if($mod<=9){
                if($resultado%2!=0){
                    
                    $conta=$conta+$resultado;  
                    return $conta;
                }else{
                    $conta+=1;       
                return $conta;
                }
                
            }else{
                $conta+=1;
                return cantidad_facturas($mod,($conta));  
            }
    }
?>

<?php } ?>