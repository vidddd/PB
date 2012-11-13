<?php
namespace PB\VentasBundle\Printer;

class ComunesFPDF extends \FPDF_Fpdf {

		function Header()
		{	
			//Logo
			$this->SetFont('Arial','BI',28);
			$this->Cell(40,10,utf8_decode('Plásticos Baltasar, S.A.'));
			$this->Ln();
			$this->SetFont('Arial','',16);
			$this->Cell(40,10,utf8_decode('Fabricación de Bolsas de plástico'));
			$this->Ln(8);
			$this->SetFont('Arial','',11);
			$this->Cell(40,10,utf8_decode('Las Viñas, 41'));
			$this->Ln(5);
			$this->SetFont('Arial','',11);
			$this->Cell(40,10,'Madridejos (TOLEDO)');
			$this->Ln(5);
			$this->SetFont('Arial','',11);
			$this->Cell(40,10,'Telf: 925461699 Fax:925112012');
			$this->Ln(5);
			$this->SetFont('Arial','',11);
			$this->Cell(40,10,'CIF: A45042033');
			$this->Ln(5);
			$this->SetFont('Arial','',10);
			$this->Cell(40,10,'email: plasticosbaltasar@gmail.com');
			$this->Image('http://localhost:8888/PB2.2/web/images/PB100.jpg',150,8,38,38);// (x,y,ancho)
		}

		function Footer()
		{

			$this->SetY(-18);
			//Arial italic 8
			$this->SetFont('Arial','',8);
			//Numero de pagina
			$this->Cell(0,10,utf8_decode('Plásticos Baltasar ,S.A.'),0,0,'C');
			//Posición: a 1,5 cm del final
			$this->SetY(-10);
			//Arial italic 8
			$this->SetFont('Arial','',8);
			//Numero de pagina
			$this->Cell(0,10,'-- '.$this->PageNo().' --',0,0,'C');
		}
	
	
	}
