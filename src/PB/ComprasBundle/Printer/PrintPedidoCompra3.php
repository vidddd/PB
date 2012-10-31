<?php
namespace PB\ComprasBundle\Printer;

class PrintPedidoCompra3 extends \HTML2PDF {

	
	public function getPdf($html, $file = "html.pdf", $format = "S"){
		$this->init();
		
		$this->WriteHTML($html);
		return $this->Output('PedidoCompra.pdf', true);
		//return '';
	}
	
	public function init(){
	//	$this->SetAuthor('David Alvarez');
	//	$this->SetTitle('Plásticos Baltasar');
	//	$this->SetSubject('Pedido de Compra');
	}
}
