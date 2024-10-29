<?php
require_once("fpdf/fpdf.php");
require_once("include/PdoMiniChat.php");
require_once ("include/fct.php");
include ("controleurs/connectes.php");

/*$pdf = new FPDF();
$pdf->AddPAge();
$pdf-> SetFont('Arial','B',16);
$pdf->Image('images/logo.png');
$pdf->Cell(100,10,utf8_decode('Mini-Chat'));
$pdf->Ln(20);
$pdf->Cell(100,10,'Adresse IP :'.$adr);
$pdf->Ln(20);
$pdf->Cell(100,10,'PSEUDO:'.$pseu2);
$pdf->Ln(20);
$pdf->Cell(100,10,'MOT DE PASSE :'.$mdp2);
$pdf->Ln(10);*/

/*$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);
// Infos du client calées à droite
$pdf->Text(120,38,utf8_decode($adr));
$pdf->Text(120,43,utf8_decode($row1['adresse']));
$pdf->Text(120,48,$row1['code_postal'].' '.utf8_decode($row1['ville']));*/

/*foreach($ipAll as $ip){
    $pdf->Cell(50,10,$ip['IP'],1);
    $pdf->Cell(30,10,$ip['PSEUDO_USER'],1);
    $pdf->Ln(10);
}*/

$pdf = new FPDF();
$pdf->AddPAge();
$pdf->SetTitle(utf8_decode('Récapitulatif'));
$pdf->Image	('images/plage.jpg', 0, 0, 210, 60, 'JPG');
$pdf-> SetFont('Arial','B',30);
//$pdf->Image('images/logo.png');

$pdf->Text(80,30,utf8_decode('Mini-Chat'));

$pdf->Ln(60);

$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(61,109,247);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('','B');




$pdf->Cell(40, 10,'ADRESSE IP :',1,0,'C',true);
$pdf->Cell(40, 10,'PSEUDO :',1,0,'C',true);
$pdf->Ln();

$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');


foreach($ipAll as $ip){
    $pdf->Cell(40,10,$ip['IP'],1);
    $pdf->Cell(40,10,$ip['PSEUDO_USER'],1);
    $pdf->Ln(10);
}

$pdf->Ln(60);
$pdf->Text(100,70,' Votre adresse IP :'.$adr);
$pdf->Text(102,80,'Votre Pseudo :'.$pseu2);
$pdf->Text(102,90,'Votre Mot de passe :'.$mdp2);

ob_clean();
$pdf->Output(utf8_decode('Récapitulatif.pdf'),'I'); 
//$pdf->Output('Récapitulatif','I');
//$pdf->Output();
?>
