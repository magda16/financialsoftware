<?php
	require 'fpdf/fpdf.php';
	 $estado_list="Cancelado";
	include ("../build/controladores/conexion.php");
	ini_set('date.timezone', 'America/El_salvador');
	
	class PDF extends FPDF
	{
		function Header()
		{
			
			$this->SetFont('Arial','B',12);
			$this->Ln(20);
			$this->Cell(30);
			
			$this->Cell(130,10,'REPORTE DE PRODUCTOS',0,1,'C');
			$this->Cell(30);
			$this->Cell(130,5,'-----------------------------------------',0,1,'C');
			$this->Cell(30);
			
			
			
			$this->Ln(20);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
			
			$this->Cell(0,10,'Fecha y hora de imprecion: '.date('d/m/Y,h:i:s'),0,0,'R');

		}		
	}

	$pdf = new PDF('P','mm','letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();


	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(25,5,'Comprobante',1,0,'C',0);
	$pdf->Cell(25,5,utf8_decode('Código'),1,0,'C',0);
	$pdf->Cell(25,5,'Cliente',1,0,'C',0);
	$pdf->Cell(25,5,'Producto',1,0,'C',0);
	$pdf->Cell(25,5,'Cantidad',1,0,'C',0);
	$pdf->Cell(25,5,'Precio',1,0,'C',0);
	$pdf->Cell(50,5,'Fecha',1,1,'C',0);
	

	$pdf->SetFont('Arial','',10);

$stmt1= $pdo->prepare("SELECT vc.tipo_comprobante,vc.codigo,vc.cliente,p.nombre,
					  dvc.cantidad, dvc.precio ,vc.fecha_ingreso
					  FROM detalle_venta_contado as dvc 
					  INNER JOIN venta_contado AS vc ON vc.id_venta_contado=dvc.id_venta_contado
					  INNER JOIN producto AS p ON  dvc.id_producto=p.id_producto
 					  WHERE vc.estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_producto){

                    $pdf->Cell(25,5, $lista_producto['tipo_comprobante'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto['codigo'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto[ 'cliente'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto['nombre'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto[ 'cantidad'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto['precio'] ,1,0,'C',0);
                    $pdf->Cell(50,5, $lista_producto['fecha_ingreso'] ,1,1,'C',0);
                    
		
	}
	$pdf->Output();
	
?>