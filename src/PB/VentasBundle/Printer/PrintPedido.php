<?php
namespace PB\VentasBundle\Printer;

class PrintPedido extends \HTML2PDF {

	
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
