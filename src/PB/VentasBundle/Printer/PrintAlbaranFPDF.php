<?php
namespace PB\VentasBundle\Printer;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class PrintAlbaranFPDF {
	/**
	 *
	 * @var EntityManager
	 */
	protected $em;
	
	public function __construct(Doctrine $doctrine)
	{
		$this->em  = $doctrine->getEntityManager();
	}
		
	public function printFPDF($id)
	{
		$entity = $this->em->getRepository('PBVentasBundle:Albaran')->find($id);
		if (!$entity) {
			throw $this->createNotFoundException('No se puede encontrar el albaran.');
		}
		$tope = 35;
		switch ($entity->getTipo()){
			case '2':
				$pdf = new ComunesbFPDF();
				$tope = 45;
			break;
			default:
				$pdf = new ComunesFPDF();
		}

		
		$pdf->AddPage(); $pdf->Ln(3); $pdf->Cell(80,4,"",'',0,'C'); $pdf->Ln(4);
		
		$pdf->SetFillColor(255,255,255); $pdf->SetTextColor(0); $pdf->SetDrawColor(0,0,0);	$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',15);
		
		$pdf->Cell(40,65,utf8_decode('# ALBARÁN #'));$pdf->SetX(10);	$pdf->SetFont('Arial','B',10);$pdf->Cell(95); $pdf->Cell(90,4,"",'LRT',0,'L',1); $pdf->Ln(4);
		
		$pdf->Cell(95);	$pdf->Cell(90,4,utf8_decode($entity->getCliente()->getNombre()),'LR',0,'L',1); $pdf->Ln(4);$pdf->Cell(95);
		$pdf->Cell(90,4,utf8_decode($entity->getCliente()->getDireccion()),'LR',0,'L',1);
		$pdf->Ln(4);
		$pdf->Cell(95);
		$pdf->Cell(90,4,$entity->getCliente()->getCp() . "  " . utf8_decode($entity->getCliente()->getLocalidad()) . "  (" . utf8_decode($entity->getCliente()->getProvinciacliente()) . ")",'LR',0,'L',1);
		$pdf->Ln(4);
		
		$pdf->Cell(95);
		$pdf->Cell(90,4,"Tlfno: " . $entity->getCliente()->getTelefono() . "  " . "Fax: " . $entity->getCliente()->getFax(),'LR',0,'L',1);
		$pdf->Ln(4);
		
		$pdf->Cell(95);	$pdf->Cell(90,4,"",'LRB',0,'L',1);$pdf->Ln(10);
		
		$pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0);	$pdf->SetDrawColor(0,0,0);	$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',10);
		
		$pdf->Cell(80);	$pdf->Cell(30,4,"NIF",1,0,'C',1);	$pdf->Cell(30,4,"Cod. Clien",1,0,'C',1);	$pdf->Cell(30,4,"Fecha",1,0,'C',1);	$pdf->Cell(20,4,utf8_decode("N Alb."),1,0,'C',1);$pdf->Ln(4);

		$pdf->Cell(80);	$pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0);$pdf->SetDrawColor(0,0,0);$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',10);
		
		$pdf->Cell(30,4,utf8_decode($entity->getCliente()->getNif()),1,0,'C',1);
		$pdf->Cell(30,4,utf8_decode($entity->getCliente()->getId()),1,0,'C',1);
		$pdf->Cell(30,4,utf8_encode($entity->getFecha()->format('d/m/Y')),1,0,'C',1);
		$pdf->Cell(20,4,$entity->getId(),1,0,'C',1);
	
		//ahora mostramos las lineas del albaran
		$pdf->Ln(10);$pdf->Cell(1);	$pdf->SetFillColor(200,200,200);$pdf->SetTextColor(0);	$pdf->SetDrawColor(0,0,0);	$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',10);	$pdf->Cell(15,4,"Codigo",1,0,'C',1);
		$pdf->Cell(65,4,"Concepto",1,0,'C',1);
		$pdf->Cell(14,4,"Ancho",1,0,'C',1);
		$pdf->Cell(14,4,"Largo",1,0,'C',1);
		$pdf->Cell(14,4,"Galga",1,0,'C',1);
		$pdf->Cell(14,4,"Solapa",1,0,'C',1);
		$pdf->Cell(19,4,"Cantidad",1,0,'C',1);
		$pdf->Cell(15,4,"Precio",1,0,'C',1);
		$pdf->Cell(20,4,"Importe",1,0,'C',1);
		$pdf->Ln(4);
			
		$pdf->SetFillColor(224,235,255);$pdf->SetTextColor(0);	$pdf->SetDrawColor(0,0,0);	$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','',9);
		
		$contador=1;
		$importeneto = 0;
		foreach ($entity->getAlbaranlineas() as $linea){
			//include("controlimpresionalb.php");
			//$pdf->Cell(1);
			$pdf->Cell(1);
			$pdf->Cell(15,4,$linea->getReferencia(),'LR',0,'R');
			$pdf->Cell(65,4,$linea->getDescripcion(),'LR',0,'L');
			$pdf->Cell(14,4,$linea->getAncho(),'LR',0,'R');
			$pdf->Cell(14,4,$linea->getLargo(),'LR',0,'R');
			$pdf->Cell(14,4,$linea->getGalga(),'LR',0,'R');
			$pdf->Cell(14,4,$linea->getSolapa(),'LR',0,'R');
			if ($linea->getCantidad()==0) {
				$cantidad="";
			} else {
				$cantidad=number_format($linea->getCantidad(),3,",",".");
			}
			$pdf->Cell(19,4,$cantidad,'LR',0,'R');
			if ($linea->getPrecio()==0) {
				$precio="";
			} else {
				$precio=number_format($linea->getPrecio(),3,",",".");
			}
			$pdf->Cell(15,4,$precio,'LR',0,'R');
			$importe=number_format($linea->getImporte(),2,",",".");
			$pdf->Cell(20,4,$importe,'LR',0,'R');
			$pdf->Ln(4);
			$importeneto+=$linea->getImporte();
			$contador=$contador + 1;
		}

		while ($contador<$tope)
		{
			$pdf->Cell(1);
			$pdf->Cell(15,4,"",'LR',0,'C');
			$pdf->Cell(65,4,"",'LR',0,'C');
			$pdf->Cell(14,4,"",'LR',0,'C');
			$pdf->Cell(14,4,"",'LR',0,'C');
			$pdf->Cell(14,4,"",'LR',0,'C');
			$pdf->Cell(14,4,"",'LR',0,'C');
			$pdf->Cell(19,4,"",'LR',0,'C');
			$pdf->Cell(15,4,"",'LR',0,'C');
			$pdf->Cell(20,4,"",'LR',0,'C');
			$pdf->Ln(4);
			$contador=$contador +1;
		}
		$pdf->Cell(1);
		$pdf->Cell(15,4,"",'LRB',0,'C');
		$pdf->Cell(65,4,"",'LRB',0,'C');
		$pdf->Cell(14,4,"",'LRB',0,'C');
		$pdf->Cell(14,4,"",'LRB',0,'C');
		$pdf->Cell(14,4,"",'LRB',0,'C');
		$pdf->Cell(14,4,"",'LRB',0,'C');
		$pdf->Cell(19,4,"",'LRB',0,'C');
		$pdf->Cell(15,4,"",'LRB',0,'C');
		$pdf->Cell(20,4,"",'LRB',0,'C');
		$pdf->Ln(4);
		
		
		//ahora mostramos el final de la factura
		$pdf->Ln(5);$pdf->SetFillColor(200,200,200);	$pdf->SetTextColor(0);	$pdf->SetDrawColor(0,0,0);	$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',10);
		
		$pdf->Cell(26,4,"NETO",1,0,'C',1);
		$pdf->Cell(26,4,"%DTO: ".$linea->getDescuento(),1,0,'C',1);
		$pdf->Cell(26,4,"BASE",1,0,'C',1);
		$pdf->Cell(26,4,"CUOTA IVA",1,0,'C',1);
		$pdf->Cell(26,4,"IVA",1,0,'C',1);
		$pdf->Cell(26,4,"RECARGO",1,0,'C',1);
		$pdf->Cell(35,4,"TOTAL",1,0,'C',1);
		$pdf->Ln(4);
		
		$pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0);	$pdf->SetDrawColor(0,0,0);	$pdf->SetLineWidth(.2);		$pdf->SetFont('Arial','B',10);
		
		
		$importe4=number_format($importeneto,2,",",".");
		$pdf->Cell(26,6,$importe4,1,0,'R',1);
		$desc=$entity->getDescuento();
		$descuento=$importeneto*$desc/100;
		$descuento=sprintf("%01.2f",$descuento);
		$desc=number_format($descuento,2,",",".");
		$pdf->Cell(26,6,$desc,1,0,'R',1);
		$baseimp=$importeneto-$descuento;
		$base=number_format($baseimp,2,",",".");
		$pdf->Cell(26,6,$base,1,0,'R',1);
		$ivai=$entity->getIva();
		$pdf->Cell(26,6,$ivai."%",1,0,'R',1);
		$impo=$baseimp*($ivai/100);
		$impoiva=sprintf("%01.2f", $impo);
		$impoiva=number_format($impoiva,2,",",".");
		$pdf->Cell(26,6,$impoiva,1,0,'R',1);
		$re=$entity->getRecargo();
		if ($re=='1') {
			$re=5.2/100;
			$recargof=$baseimp*$re;
		} else {
			$recargof=0;
		}
		$recargo=number_format($recargof,2,",",".");
		$pdf->Cell(26,6,$recargo,1,0,'R',1);
		$total=$baseimp+$impo+$recargof;
		$importetotal=sprintf("%01.2f", $total);
		$importetotal=number_format($importetotal,2,",",".");
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(35,6,$importetotal .iconv('UTF-8', 'windows-1252', "€"),1,0,'R',1);
		$pdf->Ln(4);
		
		return $pdf->Output('Albaran-'.$entity->getId().'.pdf','I');
	
	}
}
