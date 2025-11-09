<?php
ob_start();
session_start();

require_once('tcpdf_include2.php');
include('../../../config/db_config.php');
//include ('update_print.php');


$width = 10;
$height = 10;
$pageLayout = array($width, $height);

// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Job Order');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');




if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

//$pdf->SetFont('dejavusans', '', 8);


$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->AddPage('P');
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Write(0, 'DAILY TIME RECORD' , '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(3);
$pdf->SetFont('times', '', 11);


$jono = $_GET['JobOrderNo'];
$job_date=$_GET['DateJo'];

$date = date('F d, Y');

if ($jono=$jono) {

$job_id=$_GET['JobOrderNo'];
  $get_job_sql = "SELECT * FROM createjo WHERE JobOrderNo = :JobOrderNo";
    $get_job_data1 = $con->prepare($get_job_sql);
    $get_job_data1->execute([':JobOrderNo' => $job_id]);    
    while ($result = $get_job_data1->fetch(PDO::FETCH_ASSOC)) {
   
    $dtr_date = $result['PeriodCovered'];   
  
    
}




$html = '<h10>'.'</h10>'; 

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)


$pdf->SetFillColor(255, 250, 200);
$pdf->Cell(45, 8, '', 0, 1);
$pdf->SetFont('times', 'B', 12);
$pdf->Cell(45, 8, 'COVERED PERIOD:', 0, 0);
$pdf->SetFont('times', '', 11);
$pdf->Cell(200, 8, $dtr_date, 0, 1);


$pdf->SetFont('times', 'B', 12);
$pdf->Cell(45, 8, 'NAME OF PROJECT:',0, 0,);
$pdf->SetFont('times', '', 11);
$pdf->Cell(60, 8, 'Maintenance  of Government  Facilities  &  Fixed  Assets.', 0, 1,);

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line





$html .= '

         
        ';
        


        $html .= '

   

      ';

      

    
    
    $html .= '</table>'; 

}





$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';
$html .= '

  <thead>
         
            <tr bgcolor="lightblue">
              <th  width="5%" style="text-align:center;"><b>No.</b></th>
              <th width="24%" style="text-align:center;"><b>NAMES</b></th>
              <th width="6%" style="text-align:center;"><b></b></th> 
              <th width="4%" style="text-align:center;"><b>1</b></th>
              <th width="4%" style="text-align:center;"><b>2</b></th>  
              <th width="4%" style="text-align:center;"><b>3</b></th>
              <th width="4%" style="text-align:center;"><b>4</b></th>
              <th width="4%" style="text-align:center;"><b>5</b></th>
              <th width="4%" style="text-align:center;"><b>6</b></th>
              <th width="4%" style="text-align:center;"><b>7</b></th>
              <th width="4%" style="text-align:center;"><b>8</b></th>  
              <th width="4%" style="text-align:center;"><b>9</b></th>
              <th width="4%" style="text-align:center;"><b>10</b></th>
              <th width="4%" style="text-align:center;"><b>11</b></th>
              <th width="4%" style="text-align:center;"><b>12</b></th>  
              <th width="4%" style="text-align:center;"><b>13</b></th>
              <th width="4%" style="text-align:center;"><b>14</b></th>
              <th width="4%" style="text-align:center;"><b>15</b></th>
              <th width="6%" style="text-align:center;"><b></b></th>

            </tr>
          </thead>
        '; 
if ($jono==$jono) {

$schedule=$_GET['JobOrderNo'];
  $get_schedule_sql = "SELECT * FROM schedule WHERE JobOrderNo = :JobOrderNo";
    $get_schedule_data1 = $con->prepare($get_schedule_sql);
    $get_schedule_data1->execute([':JobOrderNo' => $schedule]);    
    while ($result = $get_schedule_data1->fetch(PDO::FETCH_ASSOC)) {
    
    $jo_fname = $result['FName'];
    $jo_mname = $result['MName'];
    $jo_lname = $result['LName'];
    $jo_total = $result['no'];
    $jo_code = $result['EmpCode'];
    $jo_one = $result['One1'];
    $jo_two = $result['Two2'];
    $jo_three = $result['Three3'];
    $jo_four = $result['Four4'];
    $jo_five = $result['Five5'];

    $o_one = $result['O1'];
    $o_two = $result['O2'];
    $o_three = $result['O3'];
    $o_four = $result['O4'];
    $o_five = $result['O5'];

$html .= '

                <tbody>

                    <tr>
                    <td rowspan="2"  width="5%" style="align:center;">'. $jo_total.'</td>
                   
                    <td rowspan="2" style="align:center;" width="24%" style="font-size:12px;">'. $jo_lname.', '.' '.$jo_fname.' '.' '.$jo_mname[0].'.'.'</td>

                    <td  rowspan="2" width="6%" style="text-align:center; font-size:11px;">'.$jo_code.' 
                     </td>
                        
                    
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_one.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_two.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_three.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_four.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td  rowspan="2" width="6%" style="text-align:center; font-size:11px"> 
                     </td>
                   </tr>
               
                   <tr>
                 
                     <td width="4%" style="text-align:center; font-size:9px">'.$o_one.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$o_two.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$o_three.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$o_four.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$o_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                     <td width="4%" style="text-align:center; font-size:9px">'.$jo_five.' 
                     </td>
                    
                   </tr>
                  

                </tbody>
            ';
  
}
          $html .= '</table>';



$pdf->writeHTML($html, true, false, true, false, '');

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line


$pdf->SetFont('times', '', 12);
$pdf->Cell(90, 10, 'Prepared by:', 0, 0,);
$pdf->SetFont('times', '', 12);
$pdf->Cell(80, 8, 'Certified Correct:',0 , 1,);//end of the line

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line


$pdf->SetFont('times', 'B', 11);
$pdf->Cell(70, 10, 'CHARITY P. MADRID', 0, 0, 'C');
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(130, 8, 'ATTY. ESTEFANIO S. LIBUTAN, JR.',0 , 1, 'C');//end of the line

$pdf->SetFont('times', '', 11);
$pdf->Cell(70, 5, 'Computer Operator I', 0, 0, 'C');
$pdf->SetFont('times', '', 11);
$pdf->Cell(130, 5, 'City Administrator',0 , 1, 'C');//end of the line

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line

$pdf->SetFont('times', 'B', 11);
$pdf->Cell(190, 12, 'CERTIFICATION',0 , 1, 'C');
$pdf->SetFont('times', '', 11);
$pdf->Cell(190, 11, 'This is to certify that workdone during  Saturdays, Sundays & Holidays were very necessary due to', 0,1,'C');//end of the line
$pdf->Cell(190, 11, 'the exigency of  the services and for the good of the public service.', 0,1,'C');

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line

$pdf->SetFont('times', 'B', 11);
$pdf->Cell(190, 8, 'ATTY. ESTEFANIO S. LIBUTAN, JR.',0 , 1, 'C');//end of the line

$pdf->SetFont('times', '', 11);
$pdf->Cell(190, 5, 'City Administrator',0 , 1, 'C');//end of the line




$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');

  
    }



