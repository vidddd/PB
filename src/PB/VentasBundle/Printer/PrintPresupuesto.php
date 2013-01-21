<?php
namespace PB\VentasBundle\Printer;

class PrintPresupuesto extends \HTML2PDF {
	
	public function getPdf($html, $file = "html.pdf", $format = "S"){
		$this->init();
		//$this->pdf->SetDisplayMode('fullpage');
		//$this->pdf->setDefaultFont('Arial');
		//$this->setModeDebug();
		$this->WriteHTML($html);
		return $this->Output('Presupuesto.pdf', true);
	}
	
	public function init(){
	//	$this->SetAuthor('David Alvarez');
	//	$this->SetTitle('Plásticos Baltasar');
	//	$this->SetSubject('Pedido de Compra');
	}
}
