<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Cruiser")
							 ->setLastModifiedBy("")
							 ->setTitle("Traffic from EBR to SITEID ")
							 ->setSubject("Traffic from EBR to SITEID ")
							 ->setDescription("Traffic from EBR to SITEID ")
							 ->setKeywords("Traffic from EBR to SITEID ")
							 ->setCategory("Traffic from EBR to SITEID ");


// Add some data header
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '  ')->mergeCells('A1:F1')
			->setCellValue('G1', 'L3')->mergeCells('G1:H1')
			->setCellValue('I1', 'L1')->mergeCells('I1:J1')
			->setCellValue('K1', 'ATTENUATION')->mergeCells('K1:L1')
			->setCellValue('M1', 'UTILIZATION')->mergeCells('M1:N1')
			->setCellValue('O1', 'L2')->mergeCells('O1:P1')
			
			
            ->setCellValue('A2', 'NODE')
            ->setCellValue('B2', 'DESTINATION')
            ->setCellValue('C2', 'INTERFACE')
            ->setCellValue('D2', 'LAG MEMBER')
            ->setCellValue('E2', 'SPEED (MBPS)')
            ->setCellValue('F2', 'CONNECTOR MODE')
			
            ->setCellValue('G2', 'LATENCY (ms)')
            ->setCellValue('H2', 'UTILIZATION (%)')
						
            ->setCellValue('I2', 'CRC')	
			->setCellValue('J2', 'FCS')	

            ->setCellValue('K2', 'TX (dbm)')
			->setCellValue('L2', 'RX (dbm)')	

            ->setCellValue('M2', 'INPUT (%)')	
			->setCellValue('N2', 'OUTPUT (%)')		
			
            ->setCellValue('O2', 'CPU (%)')	
			->setCellValue('P2', 'MEMORY (%)');	


// Add some data row

for($i=3;$i<=100;$i++) {
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, 'GPON03-D2-KRG-3')
				->setCellValue('B'.$i, 'DESTINATION-'.$i)
				->setCellValue('C'.$i, 'INTERFACE-'.$i)
				->setCellValue('D'.$i, 'LAG MEMBER-'.$i)
				->setCellValue('E'.$i, 'SPEED (MBPS)-'.$i)
				->setCellValue('F'.$i, 'CONNECTOR MODE-'.$i)
				
				->setCellValue('G'.$i, 'LATENCY (ms)-'.$i)
				->setCellValue('H'.$i, 'UTILIZATION (%)-'.$i)
							
				->setCellValue('I'.$i, 'CRC-'.$i)	
				->setCellValue('J'.$i, 'FCS-'.$i)	

				->setCellValue('K'.$i, 'TX (dbm)-'.$i)
				->setCellValue('L'.$i, 'RX (dbm)-'.$i)	

				->setCellValue('M'.$i, 'INPUT (%)-'.$i)	
				->setCellValue('N'.$i, 'OUTPUT (%)-'.$i)		
				
				->setCellValue('O'.$i, 'CPU (%)-'.$i)	
				->setCellValue('P'.$i, 'MEMORY (%)-'.$i);	
}	

//autosize kolom 
foreach(range('A','P') as $columnID) {
    $objPHPExcel->getActiveSheet(0)->getColumnDimension($columnID)
        ->setAutoSize(true);
}			

//beri bold to header
$objPHPExcel->getActiveSheet(0)->getStyle('A1:P2')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet(0)->getColumnDimension('A1:P2')->setAutoSize(true);
	
	
//Memberi border
$styleArray = array(
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$objPHPExcel->getActiveSheet(0)->getStyle('A1:P'.$i)->applyFromArray($styleArray);
unset($styleArray);	

	
// Rename worksheet
$objPHPExcel->getActiveSheet(0)->setTitle('Traffic from EBR to SITEID');

//set center text 
$objPHPExcel->getActiveSheet()
    ->getStyle('A1:P'.$i)
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Traffic from EBR to SITEID.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
