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
			$this->Ln(20);
			$this->Cell(30);
			
			$this->Cell(130,10,'REPORTE DE PROVEEDORES',0,1,'C');
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
	$pdf->Cell(40,5,'Nit',1,0,'C',0);
	$pdf->Cell(30,5,'Nombre',1,0,'C',0);
	$pdf->Cell(30,5,'Responsable',1,0,'C',0);
	$pdf->Cell(25,5,utf8_decode('Teléfono'),1,0,'C',0);
	$pdf->Cell(30,5,utf8_decode('Dirección'),1,0,'C',0);
	$pdf->Cell(40,5,'Correo',1,1,'C',0);
	

	$pdf->SetFont('Arial','',10);

$stmt1= $pdo->prepare("SELECT * FROM proveedor WHERE estado=:estado");
            $stmt1->bindParam(":estado",$estado_list,PDO::PARAM_STR);
            $stmt1->execute();
            $result=$stmt1->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $lista_proveedor){

                    $pdf->Cell(40,5, $lista_proveedor['nit'] ,1,0,'C',0);
                    $pdf->Cell(30,5, $lista_proveedor['nombre'] ,1,0,'C',0);
                    $pdf->Cell(30,5, $lista_proveedor[ 'nombre_responsable'].' '.$lista_proveedor[ 'apellido_responsable'] ,1,0,'C',0);
                    $pdf->Cell(25,5, $lista_proveedor['telefono'] ,1,0,'C',0);
                    $pdf->Cell(30,5, $lista_proveedor[ 'direccion'] ,1,0,'C',0);
                    $pdf->Cell(40,5, $lista_proveedor['correo'] ,1,1,'C',0);
                    
		
	}
	$pdf->Output();
	
?>