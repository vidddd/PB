<?php
namespace PB\VentasBundle\Printer;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class PrintPedidoFPDF {
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
		$entity = $this->em->getRepository('PBVentasBundle:Pedido')->find($id);
		if (!$entity) {
			throw $this->createNotFoundException('No se puede encontrar el pedido.');
		}

		$pdf = new \FPDF_FPDF;
		$pdf->AddPage();	$pdf->Ln();	$pdf->Ln();
		$pdf->Image('../web/images/PBbn.jpg',20,10,30);// (x,y,ancho)
		$pdf->Ln();
		$pdf->Cell(95);$pdf->Cell(80,10,"",'',0,'C');$pdf->Ln(8);
		
		$pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0);$pdf->SetDrawColor(0,0,0);$pdf->SetLineWidth(.2);$pdf->SetFont('Arial','B',20);
		
		$pdf->Cell(40,65,'PEDIDO');	$pdf->SetX(10); $pdf->SetFont('Arial','B',9); $pdf->Cell(95); $pdf->Cell(80,4,"",'LRT',0,'L',1); $pdf->Ln(4); $pdf->Cell(95);
		$pdf->Cell(80,4,utf8_decode($entity->getCliente()->getNombre()),'LR',0,'L',1);$pdf->Ln(4);$pdf->Cell(95);
		$pdf->Cell(80,4,utf8_decode($entity->getCliente()->getDireccion()),'LR',0,'L',1);
		$pdf->Ln(4);
		
		$pdf->Cell(95);
		$pdf->Cell(80,4,utf8_decode($entity->getCliente()->getCp()) . "  " . utf8_decode($entity->getCliente()->getLocalidad()) . "  (" . utf8_decode($entity->getCliente()->getProvinciaCliente()) . ")",'LR',0,'L',1);		$pdf->Ln(4);$pdf->Cell(95);
		$pdf->Cell(80,4,"Tlfno: " . $entity->getCliente()->getTelefono() . "  " . "Fax: " . utf8_decode($entity->getCliente()->getFax()),'LR',0,'L',1);
		$pdf->Ln(4);
		
		$pdf->Cell(95); $pdf->Cell(80,4,"",'LRB',0,'L',1); $pdf->Ln(10); $pdf->SetFillColor(200,200,200); $pdf->SetTextColor(0); $pdf->SetDrawColor(0,0,0); $pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',10); 	$pdf->SetY(50);	$pdf->Cell(30);
		$pdf->Cell(55,4,"SUBCLIENTE",1,0,'C',1);
		$pdf->Cell(30,4,"NIF",1,0,'C',1);
		$pdf->Cell(25,4,"Cod. Clien",1,0,'C',1);
		$pdf->Cell(30,4,"Fecha",1,0,'C',1);
		$pdf->Cell(20,4,utf8_decode("Nº Ped."),1,0,'C',1);		$pdf->Ln(4);
		
		$pdf->Cell(30);	$pdf->SetFillColor(250,250,250);$pdf->SetTextColor(0);$pdf->SetDrawColor(0,0,0);$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',10);
		
		$pdf->Cell(55,8,utf8_decode($entity->getSubcliente()),1,0,'C',1);
		$pdf->Cell(30,8,$entity->getCliente()->getNif(),1,0,'C',1);
		$pdf->Cell(25,8,$entity->getCliente()->getId(),1,0,'C',1);
		$pdf->Cell(30,8,$entity->getfecha()->format('d/m/Y'),1,0,'C',1);
		$pdf->Cell(20,8,$entity->getId(),1,0,'C',1);
		
		$pdf->Ln(20);$pdf->SetFont('Arial','B',9);	$pdf->SetFillColor(200,200,200);$pdf->SetTextColor(0);	$pdf->SetDrawColor(0,0,0); 	$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',10);
		
		
		$pdf->Cell(62,10,"EXTRUSION",1,0,'C',1);
		$pdf->Cell(62,10,"IMPRESION",1,0,'C',1);
		$pdf->Cell(62,10,"CORTE",1,0,'C',1); // (ancho,alto,txt,borderorbt,linea,align,fill,url)
		
		$pdf->Ln(10);	$pdf->SetFillColor(255,255,255);$pdf->SetTextColor(0);	$pdf->SetDrawColor(0,0,0);	$pdf->SetLineWidth(.2);	$pdf->SetFont('Arial','B',9);
		
		$pdf->Cell(30,3,"",'L',0,'C',1);$pdf->Cell(32,3,"",'R',0,'L',1);$pdf->Cell(30,3,"",'L',0,'C',1);	$pdf->Cell(32,3,"",'R',0,'L',1);$pdf->Cell(30,3,"",'L',0,'C',1);	$pdf->Cell(32,3,"",'R',0,'L',1);		$pdf->Ln();
		$kilosimp= number_format($entity->getKilosimp(),0,",",".");
		$ca= number_format($entity->getCantidad(),0,",",".");
		$pdf->Cell(30,7,"CANTIDAD:",'L',0,'C',1);
		$pdf->Cell(32,7,$ca,'R',0,'L',1);
		$pdf->Cell(30,7,"KILOS:",'L',0,'C',1);
		$pdf->Cell(32,7,$kilosimp,'R',0,'L',1);
		$pdf->Cell(30,7,"MAQUINA:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getMaquina(),'R',0,'L',1);
		$pdf->Ln();
		
		$cac= number_format((integer)$entity->getCantidadc(),0,",",".");
		$pdf->Cell(30,7,"MAT Y COLOR:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getMtycolor(),'R',0,'L',1);
		$pdf->Cell(30,7,"CLICHE:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getCliche(),'R',0,'L',1);
		$pdf->Cell(30,7,"CANTIDAD:",'L',0,'C',1);
		$pdf->Cell(32,7,$cac,'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"T. MATERIAL:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getTipomaterialText(),'R',0,'L',1);
		$pdf->Cell(30,7,"CARPETA:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getCarpeta(),'R',0,'L',1);
		$pdf->Cell(30,7,"ANCHO:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getAnchoc(),'R',0,'L',1);
		$pdf->Ln();
		
		
		$pdf->Cell(30,7,"ANCHO:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getAncho(),'R',0,'L',1);
		$pdf->Cell(30,7,"MEDIDA:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getMedidaimp(),'R',0,'L',1);
		$pdf->Cell(30,7,"LARGO:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getLargoc(),'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"GALGA:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getGalga(),'R',0,'L',1);
		$pdf->Cell(30,7,"SOLDADURA:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getSoldadura(),'R',0,'L',1);

		$pdf->Cell(30,7,"SOLAPA:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getSolapa(),'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"PLEGADO:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getPlegado(),'R',0,'L',1);
		$pdf->Cell(30,7,"IMPRESION:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getImpresion(),'R',0,'L',1);

		$pdf->Cell(30,7,"ALMACEN:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getAlmacen(),'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"BOBINAS:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getBobinas(),'R',0,'L',1);
		$pdf->Cell(30,7,"COLORES:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);

		$pdf->Cell(30,7,"OPERARIO:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getOperario(),'R',0,'L',1);
		$pdf->Ln();
		
		$largo=$entity->getLargoc();
		$ancho=$entity->getAnchoc();
		$galga=$entity->getGalga();
		$ca= number_format($entity->getCantidad(),0,",",".");
		$espec=0.047;
		$mil=1000;
		$pesoteorico=$ca*$ancho*$largo*$galga*$espec;
		$pes=$pesoteorico/$mil;
		
		$pdf->Cell(30,7,"METROS:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getMetros(),'R',0,'L',1);
		$pdf->Cell(62,7,$entity->getColores(),'R',0,'L',0);
		$pdf->Cell(30,7,"",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"PESOTEORICO:",'L',0,'C',1);
		$pdf->Cell(32,7,$pes,'R',0,'L',1);
		$pdf->Cell(30,7,"",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		
		$pdf->Cell(30,7,"TIPOTUBO:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getTipotuboText(),'R',0,'L',1);
		$pdf->Cell(30,7,"",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"TRATADO:",'L',0,'C',1);
		$pdf->Cell(32,7,$entity->getTratado(),'R',0,'L',1);
		$pdf->Cell(30,7,"",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"* OPERARIO:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"* OPERARIO:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"* OPERARIO:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"PESO EXTRUSION:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"PESO IMPRESION:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"PESO CORTE:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"* FECHA:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"* FECHA:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"* FECHA:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		$pdf->Cell(30,7,"* CANTIDAD:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"* CANTIDAD:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"* CANTIDAD:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		$pdf->Cell(30,7,"OBERVACIONES:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"OBSERVACIONES:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Cell(30,7,"OBSERVACIONES:",'L',0,'C',1);
		$pdf->Cell(32,7,"",'R',0,'L',1);
		$pdf->Ln();
		
		// 	$pdf->Write(62,$lafila["notasextrusion"],'');
		 
		$pdf->Cell(62,25,$entity->getNotasextrusion(),'LR',0,'C',false);
		$pdf->Cell(62,25,$entity->getNotasimpresion(),'LR',0,'L',0);
		$pdf->Cell(62,25,$entity->getNotascorte(),'LR',0,'L',0);
		$pdf->Ln();

		
		$pdf->Cell(62,42,'','LRB',0,'C',0);
		$pdf->Cell(62,42,'','LRB',0,'L',0);
		$pdf->Cell(62,42,'','LRB',0,'L',0);
		$pdf->Ln();
		
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(186,10,utf8_decode(" * Es OBLIGATORIO rellenar por el operario en cada proceso de fabricación"));
		// $pdf->SetY(-25);
		
		
		/*
		 $pdf->Ln(30);
		
		
		$pdf->SetFillColor(200,200,200);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetLineWidth(.2);
		$pdf->SetFont('Arial','B',10);
		
		$pdf->Cell(62,10,"EXTRUSION",1,0,'C',1);
		$pdf->Cell(62,10,"IMPRESION",1,0,'C',1);
		$pdf->Cell(62,10,"CORTE",1,0,'C',1); // (ancho,alto,txt,borderorbt,linea,align,fill,url)
		
		$pdf->Ln(10);                       */
		
		/*
		 $pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetLineWidth(.2);
		$pdf->SetFont('Arial','B',9);
		
		$pdf->Cell(30,10,"",'LB',0,'C',1);
		$pdf->Cell(32,10,"",'RB',0,'L',1);
		$pdf->Cell(30,10,"",'LB',0,'C',1);
		$pdf->Cell(32,10,"",'RB',0,'L',1);
		$pdf->Cell(30,10,"",'LB',0,'C',1);
		$pdf->Cell(32,10,"",'RB',0,'L',1);
		$pdf->Ln(5);             */
		/*
		 $pdf->SetFont('courier','BI',14);
		$pdf->Cell(186,15,'EXTRUSION','',0,'C');
		$pdf->Ln();
		
		$pdf->SetFillColor(255,255,255);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetLineWidth(.4);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(186,1,'','LTR',1,'L',1);
		$pdf->Cell(186,7,$lafila["notasextrusion"],'LR',1,'L',1);
		$pdf->Cell(186,7,'','LR',1,'L',1);
		$pdf->Cell(186,5,'','LRB',1,'L',1);
		
		$pdf->SetFont('courier','BI',14);
		$pdf->Cell(186,15,'IMPRESION','',0,'C');
		$pdf->Ln();
		$pdf->SetFillColor(255,255,255);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetLineWidth(.4);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(186,1,'','LTR',1,'L',1);
		$pdf->Cell(186,7,$lafila["notasimpresion"],'LR',1,'L',1);
		$pdf->Cell(186,7,'','LR',1,'L',1);
		$pdf->Cell(186,5,'','LRB',1,'L',1);
		
		$pdf->SetFont('courier','BI',14);
		$pdf->Cell(186,15,'CORTE','',0,'C');
		$pdf->Ln();
		$pdf->SetFillColor(255,255,255);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetLineWidth(.4);
		$pdf->SetTextColor(0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(186,1,'','LTR',1,'L',1);
		$pdf->Cell(186,7,$lafila["notascorte"],'LR',1,'L',1);
		$pdf->Cell(186,7,'','LR',1,'L',1);
		$pdf->Cell(186,5,'','LRB',1,'L',1);     // (ancho,alto,txt,borderorbt,linea,align,fill,url)
		$pdf->Ln();
		*/
		return $pdf->Output('Pedido-'.$entity->getId().'.pdf','I');
	
	}
}
