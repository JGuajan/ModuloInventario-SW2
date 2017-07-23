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
$pdf->Ln(10);
$pdf->SetFillColor(2, 152, 116);
$pdf->Cell(0, 9, 'CABECERA DEL AJUSTE', 0, 0, 'C', 0);
$pdf->Ln(15);

$pdf->SetTextColor(240, 255, 240);
$pdf->CellFitSpace(95, 6, 'CODIGO DEL AJUSTE' , 1 , 0, 'C', 1);
$pdf->SetTextColor(3, 3, 3);
$pdf->CellFitSpace(95, 6, $_SESSION['cod'] , 1 , 0, 'C');
$pdf->Ln(6);

$pdf->SetTextColor(240, 255, 240);
$pdf->CellFitSpace(95, 6, 'MOTIVO DEL AJUSTE' , 1 , 0, 'C', 1);
$pdf->SetTextColor(3, 3, 3);
$pdf->CellFitSpace(95, 6, $_SESSION['mot'] , 1 , 0, 'C');
$pdf->Ln(6);

$pdf->Ln(15);

$pdf->Write(1, '_______________________________________________________________________________');
$pdf->Ln(15);
$pdf->Cell(0, 9, 'DETALLES DEL AJUSTE', 0, 0, 'C', 0);
$pdf->Ln(15);
$pdf->Write(1, '_______________________________________________________________________________');
$pdf->Ln(15);

$pdf->SetTextColor(240, 255, 240);
$pdf->CellFitSpace(40, 6, 'CODIGO DEL DETALLE' , 1 , 0, 'C', 1);
$pdf->CellFitSpace(50, 6, 'NOMBRE DEL PRODUCTO' , 1 , 0, 'C', 1 );
$pdf->CellFitSpace(25, 6, 'CANTIDAD' , 1 , 0, 'C', 1) ;
$pdf->CellFitSpace(25, 6, 'ACCION' , 1 , 0, 'C', 1);
$pdf->CellFitSpace(25, 6, 'PRECIO' , 1 , 0, 'C', 1);
$pdf->CellFitSpace(25, 6, 'GRABA IVA' , 1 , 0, 'C', 1);
$pdf->Ln(6);

$bandera = false;

if (isset($_SESSION['listadoDetAjuste'])) {
   
    $listado = unserialize($_SESSION['listadoDetAjuste']);
    
    foreach ($listado as $aju) {
       
        $detalle=$aju->getID_DETALLE_AJUSTE_PROD();
        $nombre=$aju->getNOMBRE_PROD();
        $stock=$aju->getCAMBIO_STOCK_PROD();
        
        if($aju->getTIPOMOV_DETAJUSTE_PROD()=='E'){
            $tipomov='Entrada';
        }else{
             $tipomov='Salida';
        }
        
        $pvp=$aju->getPVP_PROD();
        
        if($aju->getGRABA_IVA_PROD()=='S'){
            $iva='Si';
        }else{
            $iva='No';
        }
         
        $pdf->SetTextColor(3, 3, 3);
        $pdf->SetFillColor(229, 229, 229);
        
        $pdf->CellFitSpace(40, 6, $detalle, 1 , 0, 'C', $bandera);
        $pdf->CellFitSpace(50, 6, $nombre, 1 , 0, 'C', $bandera);
        $pdf->CellFitSpace(25, 6, $stock, 1 , 0, 'C', $bandera) ;
        $pdf->CellFitSpace(25, 6, $tipomov, 1 , 0, 'C', $bandera);
        $pdf->CellFitSpace(25, 6, $pvp , 1 , 0, 'C', $bandera);
        $pdf->CellFitSpace(25, 6, $iva, 1 , 0, 'C', $bandera);
        $pdf->Ln(6);
        
        $bandera=!$bandera;
    
        
        }
  
}else{
     $pdf->Cell(0, 0,'no', 0, 0, 'L', 0);
}
$pdf->Ln(10);
$pdf->Write(1, '_______________________________________________________________________________');
$pdf->Output();
//if (isset($_SESSION['listadoDetAjuste'])) {
//    // Deserializamos y mostraremos los atributos de los usuarios usando un ciclo for
//    $listado = unserialize($_SESSION['listadoDetAjuste']);
//    
//    foreach ($listado as $aju) {
//       
//        if($aju->getTIPOMOV_DETAJUSTE_PROD()=='E'){
//            $tipomov='Entrada';
//        }else{
//             $tipomov='Salida';
//        }
//        
//        if($aju->getGRABA_IVA_PROD()=='S'){
//            $iva='Si';
//        }else{
//            $iva='No';
//        }
//        $nomprod=$aju->getNOMBRE_PROD();
//        $FILADET= $aju->getID_DETALLE_AJUSTE_PROD()."   ".$nomprod."<--->".$aju->getCAMBIO_STOCK_PROD()
//                   ."<------>".$tipomov."<------>".$aju->getPVP_PROD()."<---->".$iva;
//        $pdf->Cell(0, 0,$FILADET , 0, 0, 'L', 0);
//        $pdf->Ln(5);
//    }
//  
//}else{
//     $pdf->Cell(0, 0,'no', 0, 0, 'L', 0);
//}
// $pdf->Write(1, '_______________________________________________________________________________');
////$pdf->Output();

?>


