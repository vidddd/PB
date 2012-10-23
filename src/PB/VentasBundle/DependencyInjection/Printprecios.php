<?php
namespace PB\VentasBundle\DependencyInjection;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

class Printprecios {
	/**
	 *
	 * @var EntityManager
	 */
	protected $em;
	
	public function __construct(Doctrine $doctrine)
	{
		$this->em      = $doctrine->getEntityManager();
	}
		
	public function printFPDF($id)
	{
		$entity = $this->em->getRepository('PBVentasBundle:Precio')->find($id);
		if (!$entity) {
			throw $this->createNotFoundException('No se puede encontrar el pedido.');
		}
		$pdf = new \Fpdf_Fpdf;
		$pdf->AddPage();$pdf->Ln();$pdf->Ln();
		
		$pdf->SetFillColor(230,230,230);$pdf->SetTextColor(0);$pdf->SetDrawColor(0,0,0);$pdf->SetLineWidth(.2);
		$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,8,"CLIENTE:",1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',14);
		$pdf->Cell(115,8,utf8_decode($entity->getCliente()->getNombre()),1,0,'L',1);$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(20,8,"Fecha:",1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',12);
		$pdf->Cell(30,8,$entity->getfecha()->format('d/m/Y'),1,0,'C',1);
		$pdf->Ln();	$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,5,utf8_decode("Código:"),1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',10);
		$pdf->Cell(25,5,$entity->getId(),1,0,'L',1);	$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,5,utf8_decode("Teléfono:"),1,0,'C',1);$pdf->SetFillColor(255,255,255);	$pdf->SetFont('Times','BI',10);
		$pdf->Cell(40,5,$entity->getCliente()->getTelefono(),1,0,'L',1);$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,5,"Fax:",1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',10);
		$pdf->Cell(40,5,$entity->getCliente()->getFax(),1,0,'L',1);
		$pdf->Ln(8);
		
		//$pdf->SetFont('Arial','BI',9);$pdf->Cell(180,5,"Estimado cliente con incremento de precio de la materia prima nos vemos obligados a aumentar los precios en:",0,0,'L',1);$pdf->SetY(32);	$pdf->SetTextColor(0);$pdf->SetFont('Arial','BI',11);		$pdf->Cell(180,8,"CAMISETA IMPRESA",0,0,'C',1);	$pdf->Ln(8);*/
		
		$pdf->SetFillColor(230,230,230);$pdf->SetTextColor(0);$pdf->SetDrawColor(0,0,0);$pdf->SetLineWidth(.2);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(30,8,"CANTIDAD",1,0,'C',1);
		$pdf->Cell(30,8,"HASTA 15000",1,0,'C',1);
		$pdf->Cell(30,8,"DE 15 A 30000",1,0,'C',1);
		$pdf->Cell(30,8,"DE 30 A 50000",1,0,'C',1);
		$pdf->Cell(30,8,"DE 50 A 100000",1,0,'C',1);
		$pdf->Cell(30,8,"DESDE 100000",1,0,'C',1);
		$pdf->Ln(8);
		$pdf->Cell(30,8,"PRECIO KG",1,0,'C',1);	$pdf->SetFillColor(255,255,255);
		$pdf->Cell(30,8,$entity->getCam15(),1,0,'C',1);
		$pdf->Cell(30,8,$entity->getCam30(),1,0,'C',1);
		$pdf->Cell(30,8,$entity->getCam50(),1,0,'C',1);
		$pdf->Cell(30,8,$entity->getCam100(),1,0,'C',1);
		$pdf->Cell(30,8,$entity->getCam100mas(),1,0,'C',1);
		$pdf->Ln(10);$pdf->SetFont('Arial','BI',9);
		$pdf->Cell(180,5,utf8_decode("- Material de color 0.24 Euros más el Kg."),0,0,'L',1);$pdf->Ln(5);
		$pdf->Cell(180,5,utf8_decode("- Material de color Rojo y Verde 0.30 Euros más el Kg."),0,0,'L',1);$pdf->Ln(5);
		$pdf->Cell(180,5,utf8_decode("- Material impreso en Oro 0.30 Euros."),0,0,'L',1);$pdf->Ln(5);
		$pdf->Cell(180,5,utf8_decode("- La medida camiseta 35X40, galga 70, tiene un precio mínimo de 13.45 Euros/Millar."),0,0,'L',1);$pdf->Ln(5);
		$pdf->Cell(180,5,utf8_decode("- Las medidas que no sean 35X50 - 40X50 - 45X55 - 50X60 tienen diferente valoracion y plazos de entregas mlas largos, 3.10 €/Kg."),0,0,'L',1);$pdf->Ln(7);
		
		$pdf->SetFont('Arial','BI',11);
		$pdf->Cell(180,8,"ASA TROQUELADA",0,0,'C',1);$pdf->Ln();$pdf->SetFont('Arial','B',10);$pdf->SetFillColor(230,230,230);$pdf->Cell(30);
		$pdf->Cell(80,6,"Medidas inferiores entre 20X30 y 30X40",1,0,'L',1);$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getAsa20(),1,0,'C',1);$pdf->Ln(6);	$pdf->SetFillColor(230,230,230);$pdf->Cell(30);
		$pdf->Cell(80,6,"Medidas inferiores entre 30X40 y 35X50",1,0,'L',1);$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getAsa30(),1,0,'C',1);	$pdf->Ln(6);$pdf->SetFillColor(230,230,230);$pdf->Cell(30);
		$pdf->Cell(80,6,"Medidas superiores a 35X50",1,0,'L',1);$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getAsa35(),1,0,'C',1);$pdf->Ln(9);
		
		$pdf->SetFont('Arial','BI',11);
		$pdf->Cell(180,8,utf8_decode("MEDIDAS ESPECIALES PEQUEÑAS"),0,0,'C',1);	$pdf->Ln();$pdf->SetFont('Arial','B',10);$pdf->SetFillColor(230,230,230);$pdf->Cell(30);
		$pdf->Cell(80,6,"Medidas especiales 10 y 12",1,0,'L',1);$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getEspeciales10(),1,0,'C',1);$pdf->Ln(6);$pdf->SetFillColor(230,230,230);$pdf->Cell(30);
		$pdf->Cell(80,6,"Medidas especiales 15",1,0,'L',1);	$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getEspeciales15(),1,0,'C',1);$pdf->Ln(10);	$pdf->SetFont('Arial','BI',11);	$pdf->Cell(20);
		
		$pdf->Cell(80,8,"MEDIDAS ESPECIALES",0,0,'C',1);$pdf->Cell(70,8,"BOBINAS",0,0,'C',1);$pdf->Ln(8);$pdf->SetFillColor(230,230,230);$pdf->SetFont('Arial','B',10);$pdf->Cell(30,8);
		$pdf->Cell(35,6,utf8_decode("Sin Impresión"),1,0,'C',1);$pdf->Cell(35,6,"Impreso",1,0,'C',1);$pdf->Cell(35,6,utf8_decode("Sin Impresión"),1,0,'C',1);$pdf->Cell(35,6,"Impreso",1,0,'C',1);$pdf->Ln(6);$pdf->Cell(30,6,"- 150 Kg.",1,0,'C',1); $pdf->SetFillColor(255,255,255);
		$pdf->Cell(35,6,$entity->getEspemenos150s(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getEspemenos150i(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getBobmenos150s(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getBobmenos150i(),1,0,'C',1);
		$pdf->Ln(6); $pdf->SetFillColor(230,230,230);$pdf->Cell(30,6,"+ 150 Kg.",1,0,'C',1);$pdf->SetFillColor(255,255,255);
		$pdf->Cell(35,6,$entity->getEspemas150s(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getEspemas150i(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getBobmas150s(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getBobmas150i(),1,0,'C',1);
		$pdf->Ln(6); $pdf->SetFillColor(230,230,230); $pdf->Cell(30,6,"+ 500 Kg.",1,0,'C',1); $pdf->SetFillColor(255,255,255);
		$pdf->Cell(35,6,$entity->getEspemas500s(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getEspemas500i(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getBobmas500s(),1,0,'C',1);
		$pdf->Cell(35,6,$entity->getBobmas500i(),1,0,'C',1);
		$pdf->Ln(10);
		
		$pdf->SetFont('Arial','B',10);$pdf->SetFillColor(230,230,230);$pdf->Cell(30);
		$pdf->Cell(80,6,"Bolleria o similares",1,0,'L',1);$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getBolleria(),1,0,'C',1);$pdf->Ln(10);
		
		$pdf->SetFont('Arial','BI',11);
		$pdf->Cell(180,8,"POLIPROPILENO",0,0,'C',1);$pdf->Ln();	$pdf->SetFont('Arial','B',10); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,"Bobinas",1,0,'L',1); $pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getPpbob(),1,0,'C',1); $pdf->Ln(6); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,utf8_decode("Bolsa sin impresión"),1,0,'L',1);	$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getPpbolsasin(),1,0,'C',1);	$pdf->Ln(6); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,utf8_decode("Bolsa impresa, medida pequeña"),1,0,'L',1); $pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getPpbolsapeque(),1,0,'C',1);  $pdf->Ln(6); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,"Bolsa impresa, medida grande",1,0,'L',1);	$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getPpbolsagrande(),1,0,'C',1);$pdf->Ln(10);
		
		$pdf->SetFont('Arial','BI',11);
		$pdf->Cell(180,8,"POLIPROPILENO MICROPERFORADO",0,0,'C',1);	$pdf->Ln(); $pdf->SetFont('Arial','B',10); $pdf->SetFillColor(230,230,230);	$pdf->Cell(30);
		$pdf->Cell(80,6,"Bobinas",1,0,'L',1); $pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getPpmbob(),1,0,'C',1); $pdf->Ln(6); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,"Bobina impresa",1,0,'L',1); $pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getPpmbobi(),1,0,'C',1); $pdf->Ln(6); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,utf8_decode("Bolsa sin impresión"),1,0,'L',1); 	$pdf->SetFillColor(255,255,255); 
		$pdf->Cell(40,6,$entity->getPpmsin(),1,0,'C',1);$pdf->Ln(6);$pdf->SetFillColor(230,230,230);	$pdf->Cell(30);
		$pdf->Cell(80,6,"Bolsa impresa",1,0,'L',1);	$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getPpmim(),1,0,'C',1); $pdf->Ln(8);
		
		$pdf->SetFont('Arial','BI',11);
		$pdf->Cell(180,8,"LAMINA",0,0,'C',1);$pdf->Ln(); $pdf->SetFont('Arial','B',10); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,"Lamina impresa",1,0,'L',1); $pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getLaminaim(),1,0,'C',1); $pdf->Ln(6); $pdf->SetFillColor(230,230,230); $pdf->Cell(30);
		$pdf->Cell(80,6,utf8_decode("Lamina sin impresión"),1,0,'L',1);$pdf->SetFillColor(255,255,255);
		$pdf->Cell(40,6,$entity->getLaminasin(),1,0,'C',1);
		$pdf->Ln(30);
		
		$pdf->SetFillColor(230,230,230);$pdf->SetTextColor(0);$pdf->SetDrawColor(0,0,0);$pdf->SetLineWidth(.2);
		$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,8,"CLIENTE:",1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',14);
		$pdf->Cell(115,8,utf8_decode($entity->getCliente()->getNombre()),1,0,'L',1);$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(20,8,"Fecha:",1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',12);
		$pdf->Cell(30,8,$entity->getfecha()->format('d/m/Y'),1,0,'C',1);
		$pdf->Ln();	$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,5,utf8_decode("Código:"),1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',10);
		$pdf->Cell(25,5,$entity->getId(),1,0,'L',1);	$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,5,utf8_decode("Teléfono:"),1,0,'C',1);$pdf->SetFillColor(255,255,255);	$pdf->SetFont('Times','BI',10);
		$pdf->Cell(40,5,$entity->getCliente()->getTelefono(),1,0,'L',1);$pdf->SetFillColor(230,230,230);$pdf->SetFont('Times','B',10);
		$pdf->Cell(30,5,"Fax:",1,0,'C',1);$pdf->SetFillColor(255,255,255);$pdf->SetFont('Times','BI',10);
		$pdf->Cell(40,5,$entity->getCliente()->getFax(),1,0,'L',1);
	
		$pdf->Ln(20);
		
		$pdf->SetFont('Arial','BI',12);	$pdf->Cell(180,8,"PEDIDOS ESPECIALES",0,0,'C',1);
		$pdf->Ln(8);
		
		$pdf->SetFillColor(230,230,230); $pdf->SetTextColor(0); $pdf->SetDrawColor(0,0,0); $pdf->SetLineWidth(.2); $pdf->SetFont('Arial','B',10);
		$pdf->Cell(10);
		$pdf->Cell(25,8,"CANTIDAD",1,0,'C',1);
		$pdf->Cell(75,8,"CONCEPTO",1,0,'C',1);
		$pdf->Cell(25,8,"MEDIDA",1,0,'C',1);
		$pdf->Cell(25,8,"GALGA",1,0,'C',1);
		$pdf->Cell(25,8,"PRECIO",1,0,'C',1);
		$pdf->Ln(8);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetFont('Arial','B',9);
		foreach ($entity->getPreciolineas() as $linea){
			$pdf->Cell(10);
			$pdf->Cell(25,6,$linea->getCantidad(),1,0,'C',1);
			$pdf->Cell(75,6,utf8_decode($linea->getConcepto()),1,0,'L',1);
			$pdf->Cell(25,6,$linea->getMedida(),1,0,'C',1);
			$pdf->Cell(25,6,$linea->getGalga(),1,0,'C',1);
			$pdf->Cell(25,6,$linea->getPrecio(),1,0,'C',1);
			$pdf->Ln(6);
		}
		return $pdf->Output();;
	
	}
}
