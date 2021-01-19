<?php
	require 'fpdf/fpdf.php';
	 $estado_list="Activo";
	include ("../build/controladores/conexion.php");
	ini_set('date.timezone', 'America/El_salvador');
	
	class PDF extends FPDF
	{
		function Header()
		{
			
			$this->SetFont('Arial','B',12);
			$this->Ln(10);
			$this->Cell(30);
			
			$this->Cell(130,10,'STOCK DE PRODUCTOS',0,1,'C');
			$this->Cell(30);
			$this->Cell(130,5,'-----------------------------------------',0,1,'C');
			$this->Cell(30);
			
			
			
			$this->Ln(10);
		}
		
		function Footer()
		{
			$this->SetY(-35);
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
	$pdf->Cell(40,5,' ',0,0,'C',0);
	$pdf->Cell(25,5,'Codigo',1,0,'C',0);
	$pdf->Cell(25,5,'Producto',1,0,'C',0);
	$pdf->Cell(25,5,'Stock',1,0,'C',0);
	$pdf->Cell(50,5,'Descripcion',1,1,'C',0);
	

	$pdf->SetFont('Arial','',10);

$stmt1= $pdo->prepare("SELECT * FROM producto WHERE estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_producto){

            		$pdf->Cell(40,5,' ',0,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto['codigo'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto['nombre'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_producto[ 'stock_minimo'] ,1,0,'C',0);
                    $pdf->Cell(50,5, $lista_producto['descripcion'] ,1,1,'C',0);
                    
		
	}
	$pdf->Output();
	
?>