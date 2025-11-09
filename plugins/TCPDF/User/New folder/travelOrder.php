<?php
ob_start();
session_start();

require_once('tcpdf_include.php');
include('../../../config/db_config.php');
//include ('update_print.php');


$width = 10;
$height = 10;
$pageLayout = array($width, $height);

// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('SP Document Tracking Sytem');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

//$pdf->SetFont('dejavusans', '', 8);


$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$pdf->Ln(10);

$pdf->SetFont('helvetica', 'B', 20);
$pdf->AddPage('P');

$pdf->Write(0, 'Authority to Travel', '', 0, 'L', true, 0, false, false, 0);

$pdf->Ln(7);


$pdf->SetFont('times', '', 12);

$travelno=$_GET['travelno'];

  $get_travel_sql = "SELECT * FROM alltravelorder WHERE travelOrderNo = :travelno";
    $get_travel_data = $con->prepare($get_travel_sql);
    $get_travel_data->execute([':travelno' => $travelno]);    
       while ($result = $get_travel_data->fetch(PDO::FETCH_ASSOC)) {


    // $fullname = ucfirst($result['first_name']) . ' ' . ucwords($result['middle_name']) . ' ' . ucfirst($result['last_name']);
    // $email = $result['email'];
    // $contact_number = $result['contact_number'];
        $travelno = $result['travelOrderNo'];
        $fullname = $result['fullname'];
        $position = $result['Position'];
        $division = $result['Division'];
        $destination = $result['Destination'];
        $dateDeparture = $result['dateDeparture'];
        $dateArrival = $result['dateArrival'];
        $sponsoring = $result['SponsoringAgency']; 
        $purpose = $result['Purpose'];
        $modetrans = $result['modeTransportation'];
        $typevehicle = $result['TypeOfVehicle'];
        $natureTravel= $result['natureOfTravel'];
        $source = $result['SourceOfFund'];
        $datefiled = $result['DateFiled'];
        $recommend = $result['Recommending'];
        $approved = $result['Approved'];



$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)


$pdf->SetFillColor(255, 250, 200);


$pdf->Cell(38, 8, 'Date Filed', 1, 0);
$pdf->Cell(60, 8, $datefiled, 1, 0,);
$pdf->SetFont('times', 'B', 14);
$pdf->Cell(40, 8, 'Travel Order No.', 1, 0,);
$pdf->SetFont('times', '', 13);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(45, 8, '2020-'.$travelno, 1, 1,);//end of the line

$pdf->SetTextColor('');
$pdf->SetFont('times', '', 12);
$pdf->Cell(38, 15, 'Name', 1, 0,);
$pdf->Cell(145, 15, $fullname, 1, 1,);//end of the line

$pdf->Cell(38, 10, 'Position', 1, 0,);
$pdf->Cell(145, 10, $position, 1, 1,1,0,0,'','',false,0,false,false, 'M', true);//end of the line

$pdf->Cell(38, 10, 'Division', 1, 0,);
$pdf->Cell(145, 10, $division, 1, 1,);//end of the line

$pdf->Cell(38, 10, 'Destination', 1, 0,);
$pdf->Cell(145, 10, $destination, 1, 1,);//end of the line

$pdf->Cell(25, 10, 'Travel Period', 1, 0,'L',3);
$pdf->Cell(33, 10, 'Departure Date', 1, 0,);
$pdf->Cell(40, 10, $dateDeparture, 1, 0,);
$pdf->Cell(45, 10, 'Expected Date of Arrival', 1, 0,);
$pdf->Cell(40, 10, $dateArrival, 1, 1,);//end of the line

$pdf->Cell(38, 10, 'Sponsoring Agency', 1, 0,);
$pdf->Cell(145, 10,  $sponsoring, 1, 1,);//end of the line

$pdf->Cell(38, 20, 'Purpose', 1, 0,);
$pdf->Cell(145, 20,  $purpose, 1, 1,);//end of the line

$pdf->Cell(46, 10, 'Mode Of Transportation', 1, 0,);
$pdf->Cell(45, 10,  $modetrans, 1, 0,);
$pdf->Cell(37, 10, 'Type of Vehicle', 1, 0,);
$pdf->Cell(55, 10,  $modetrans, 1, 1,);//end of the line

$pdf->Cell(46, 10, 'Nature of Travel', 1, 0,);
$pdf->Cell(45, 10, $natureTravel, 1, 0,);
$pdf->Cell(37, 10, 'Source of Fund', 1, 0,);
$pdf->Cell(55, 10, $source, 1, 1,);//end of the line

$pdf->Cell(91, 50, 'Recommending Approval:', 1, 'J',1,0,0,'',’’,false,0,false,false, 'T');
$pdf->Cell(92, 50, 'Approved on:', 1, 1,1,0,0,'',’’,false,0,false,false, 'T');//end of the line

$pdf->SetFont('times', 'B', 14);
$pdf->Cell(91, 5, 'CHRISTOPHER PAUL S. CARMONA', 1, 0, 'C',);
$pdf->Cell(92, 5,  'RENATO Y. GUSTILO', 1, 1, 'C');//end of the line

$pdf->SetFont('times', '', 12);
$pdf->Cell(91, 5, 'City Vice Mayor', 1, 0,'C',);
$pdf->Cell(92, 5,  'City Mayor', 1, 1,'C');//end of the line

$html .= '

         
        ';
        


        $html .= '

   

      ';

      }

    
    
    $html .= '</table>'; 
    
    

$pdf->writeHTML($html, true, false, true, false, '');

    



$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');




