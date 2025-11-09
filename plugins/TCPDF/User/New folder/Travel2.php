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
$pdf->SetFont('dejavusans', '',8, '', true);
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4,
 
);

$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$html = <<<EOD
<h1>Authority to Travel <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black; aling;center;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;

$pdf->AddPage('P');


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

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

$html .= '

          <thead>
         
           <tr>
              <th><b>Travel Order No.:</b> </th>
              <th><b>Name</b></th>
              <th><b>Position</b></th>
              <th><b>Division</b></th>
              <th><b>Division</b></th>
              <th><b>Destination</b></th>
            
            </tr>
          </thead>
        ';
        

 
        $html .= '

   

        <tbody> 
            <tr>
           <th><b>Travel Order No.:</b> </th>  <td>'. $travelno .'</td> 
            <td>'. $fullname .'</td>
            <td> '. $position.'</td>
            <td> '. $division.'</td>
            <td> '. $destination.'</td>
            <td> '. $dateDeparture.'</td>
            <td> '. $dateArrival.'</td>
            <td> '. $sponsoring.'</td>
            <td>'.$purpose.'</td>
            <td>'.$modetrans.'</td>
             <td> '. $typevehicle.'</td>
            <td> '. $natureTravel.'</td>
            <td>'.$source.'</td>
            <td>'.$datefiled.'</td>
            </tr>               
        </tbody>

        
    ';

      }

    
    
    $html .= '</table>'; 
    
    

$pdf->writeHTML($html, true, false, true, false, '');

    
$pdf->Cell(100, 10, "Charity", 1, 1, 'C');


$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');




