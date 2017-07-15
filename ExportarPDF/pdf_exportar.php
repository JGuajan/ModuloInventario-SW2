<?php
session_start();

include_once '../Model/AjusteDet.php';
include_once '../Model/AjustesModel.php';


 
       
require ('FPDF/PDF_HTML.php');

$pdf = new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->Image('img/Titulo_X2.jpg', 3, 0, 200, 57);
$pdf->Ln(50);
$pdf->Write(1, '_______________________________________________________________________________');
$pdf->Ln(13);
$pdf->Cell(0, 9, 'CABECERA DEL AJUSTE', 0, 0, 'C', 0);
$pdf->Ln(15);
$pdf->Cell(0, 9, 'Codigo del Ajuste : ' . $_SESSION['cod'], 0, 0, 'L', 0);
$pdf->Ln(8);
$pdf->Cell(0, 9, 'Motivo : ' . $_SESSION['mot'], 0, 0, 'L', 0);
$pdf->Ln(13);
$pdf->Write(1, '_______________________________________________________________________________');
$pdf->Ln(13);
$pdf->Cell(0, 9, 'DETALLES DEL AJUSTE', 0, 0, 'C', 0);
$pdf->Ln(15);
$pdf->Write(1, '_______________________________________________________________________________');
$pdf->Ln(15);

if (isset($_SESSION['listadoDetAjuste'])) {
    // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
    $listado = unserialize($_SESSION['listadoDetAjuste']);
    
    foreach ($listado as $aju) {
       
        if($aju->getTIPOMOV_DETAJUSTE_PROD()=='E'){
            $tipomov='Entrada';
        }else{
             $tipomov='Salida';
        }
        
        if($aju->getGRABA_IVA_PROD()=='S'){
            $iva='Si';
        }else{
            $iva='No';
        }
        $nomprod=$aju->getNOMBRE_PROD();
        $FILADET= $aju->getID_DETALLE_AJUSTE_PROD()."   ".$nomprod."<--->".$aju->getCAMBIO_STOCK_PROD()
                   ."<------>".$tipomov."<------>".$aju->getPVP_PROD()."<---->".$iva;
        $pdf->Cell(0, 0,$FILADET , 0, 0, 'L', 0);
        $pdf->Ln(5);
    }
  
}else{
     $pdf->Cell(0, 0,'no', 0, 0, 'L', 0);
}
 $pdf->Write(1, '_______________________________________________________________________________');
$pdf->Output();

?>


