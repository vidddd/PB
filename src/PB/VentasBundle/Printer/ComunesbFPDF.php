<?php
namespace PB\VentasBundle\Printer;

class ComunesbFPDF extends \FPDF_Fpdf {

		function Header()
		{	
			//Logo

		}

		function Footer()
		{
			$this->SetY(-18);
			//Arial italic 8
			$this->SetFont('Arial','',8);
			//Numero de pagina
			$this->Cell(0,10,utf8_decode('Número de Página'),0,0,'C');
			//Posición: a 1,5 cm del final
			$this->SetY(-10);
			//Arial italic 8
			$this->SetFont('Arial','',8);
			//Numero de pagina
			$this->Cell(0,10,'-- '.$this->PageNo().' --',0,0,'C');
		}
	
	
	}
