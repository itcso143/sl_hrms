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
$pdf->SetFont('helvetica', 'B', 12);
$pdf->AddPage('L');
$pdf->Write(0, 'DAILY WAGE PAYROLL' , '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0, 'Maintenance of Government Facilities And Fixed Assets Project' , '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(3);
$pdf->SetFont('times', '', 11);

$html = '<h10>'.'</h10>'; 

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)


$pdf->SetFillColor(255, 250, 200);

$pdf->SetFont('times', 'B', 11);
$pdf->Cell(200, 8, 'LGU: OFFICE OF CITY ADMINISTRATOR', 1, 0);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(18, 8, 'Period:',1, 0,);
$pdf->Cell(60, 8, '$date', 1, 1,);



if ($jono==$jono) {

$jo_no=$_GET['JobOrderNo'];
  $get_jo_sql = "SELECT * FROM createjo WHERE JobOrderNo = :JobOrderNo";
    $get_jo_data1 = $con->prepare($get_jo_sql);
    $get_jo_data1->execute([':JobOrderNo' => $jo_no]);    
    while ($result = $get_jo_data1->fetch(PDO::FETCH_ASSOC)) {
    
   
    $project = $result['ProjectName'];
    $charges = $result['Charges'];
    $budget = $result['ProjectBudget'];
    $prev = $result['PreviousBalance'];
    
}



}



if ($jono==$jono) {

$job_id=$_GET['JobOrderNo'];
  $get_job_sql = "SELECT * FROM jo_details WHERE JobOrderNo = :JobOrderNo";
    $get_job_data1 = $con->prepare($get_job_sql);
    $get_job_data1->execute([':JobOrderNo' => $job_id]);    
    while ($result = $get_job_data1->fetch(PDO::FETCH_ASSOC)) {
   
    $amount = $result['Amount'];
    $balances = $result['Balance'];
    $laborers = $result['Laborers'];
     $jo_schedule = $result['Schedules'];
}




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
              <th  width="8%" style="text-align:center;"><b>No.</b></th>
              <th width="43%" style="text-align:center;"><b>NAMES</b></th>
              <th width="50%" style="text-align:center;"><b>PERIOD COVERED</b></th>  
              

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
    $jo_rate = $result['Rate'];
    $jo_period = $result['Period'];
    $jo_days1 = $result['RegDays'];
    $jo_time = $result['Time1'];
    $jo_total = $result['no'];
     $jo_month1 = $result['Month1'];
    $jo_month2 = $result['Month2'];
     $jo_days2 = $result['Days1'];
    $jo_days3 = $result['Days2'];
    $jo_year = $result['Years'];
    $jo_rate1 = $result['Rate1'];
     $jo_rate2 = $result['Rate2'];
    $jo_time1 = $result['Time2'];
    $jo_time2 = $result['Time3'];
   
   
if ($jo_period!="" && $jo_month1!="" && $jo_month2!="") { 

$html .= '

   

                <tbody>
                    <tr>
                    <td width="8%" style="text-align:center;">'. $jo_total.'</td>
                    <td width="18%" style="font-size:14px;">'. $jo_lname.'</td>
                      <td width="3%" style="text-align:center; font-size:14px">'.','.'</td>
                       <td width="17%" style="font-size:14px;">'. $jo_fname.'</td>
                       <td width="5%" style="text-align:center; font-size:14px">'. $jo_mname[0].'.'.'</td>
                    <td width="50%" style="text-align:center; font-size:13px">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.' '.'@'.' '.$jo_rate.''.'/day'.' '.'('.$jo_time.')'.'
                       <br>
                      '.$jo_month1.' '.' '.$jo_days2.','.' '.$jo_year.' '.'@'.' '.$jo_rate1.''.'/day'.' '.'('.$jo_time1.')'.'
                      <br>
                      '.$jo_month2.' '.' '.$jo_days3.','.'  '.$jo_year.' '.'@'.' '.$jo_rate2.''.'/day'.' '.'('.$jo_time2.')'.' 
                     </td>
                   </tr>
               
                   
                  

                </tbody>
            ';
          }
        
elseif ($jo_period!="" && $jo_month1!="" && $jo_month2=="") {
$html .= '

   

                <tbody>
                    <tr>
                    <td width="8%" style="text-align:center;">'. $jo_total.'</td>
                    <td width="18%" style="font-size:14px;">'. $jo_lname.'</td>
                      <td width="3%" style="text-align:center; font-size:14px">'.','.'</td>
                       <td width="17%" style="font-size:14px;">'. $jo_fname.'</td>
                       <td width="5%" style="text-align:center; font-size:14px">'. $jo_mname[0].'.'.'</td>
                    <td width="50%" style="text-align:center; font-size:13px">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.' '.'@'.' '.$jo_rate.''.'/day'.' '.'('.$jo_time.')'.'
                       <br>
                      '.$jo_month1.' '.' '.$jo_days2.','.','.'  '.$jo_year.' '.'@'.' '.$jo_rate1.''.'/day'.' '.'<br>('.$jo_time1.')'.'
                     </td>
                   </tr>                 

                </tbody>
            ';
          }

         elseif ($jo_period!="" && $jo_month1=="" && $jo_month2==""){
$html .= '

   

                <tbody>
                    <tr>
                    <td width="8%" style="text-align:center;">'. $jo_total.'</td>
                    <td width="18%" style="font-size:14px;">'. $jo_lname.'</td>
                      <td width="3%" style="text-align:center; font-size:14px">'.','.'</td>
                       <td width="17%" style="font-size:14px;">'. $jo_fname.'</td>
                       <td width="5%" style="text-align:center; font-size:14px">'. $jo_mname[0].'.'.'</td>
                    <td width="50%" style="text-align:center; font-size:13px">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.' '.'@'.' '.$jo_rate.''.'/day'.' '.'<br>('.$jo_time.')'.'
                   
                     </td>
                   </tr>                 

                </tbody>
            ';
          }

}
          $html .= '</table>';



$pdf->writeHTML($html, true, false, true, false, '');

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(60, 8, 'WORK TO BE DONE:',0 , 1, 'L');
$pdf->SetFont('times', '', 11);
$pdf->Cell(80, 6, 'Presentation and do some errand works at the Information Technology and Computer Services Office.', 0,1,);//end of the line
$pdf->Cell(80, 6, 'With'.' '.$jo_schedule, 0,1,);//end of the line


$pdf->SetFillColor(255, 250, 200);

$pdf->SetFont('times', 'B', 12);
$pdf->Cell(38, 8, '***********************************************************************************', 0, 0);
$pdf->Cell(60, 8, '',0, 1,);


$pdf->SetFont('times', '', 12);
$pdf->Cell(90, 10, 'Prepared by:', 0, 0,);
$pdf->SetFont('times', '', 12);
$pdf->Cell(80, 8, 'Recommended for Approval:',0 , 1,);//end of the line

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

$pdf->SetFont('times', '', 11);
$pdf->Cell(90, 10, 'Noted by:', 0, 0,);
$pdf->SetFont('times', '', 11);
$pdf->Cell(80, 8, 'Approved by:',0 , 1,);//end of the line

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line

$pdf->SetFont('times', 'B', 11);
$pdf->Cell(70, 5, 'JONIE S. UY', 0, 0, 'C');
$pdf->SetFont('times', 'B', 11);
$pdf->Cell(130, 5, 'HON. RENATO Y. GUSTILO',0 , 1, 'C');//end of the line

$pdf->SetFont('times', '', 11);
$pdf->Cell(70, 5, 'Executive Assistant III', 0, 0, 'C');
$pdf->SetFont('times', '', 11);
$pdf->Cell(75, 5, 'City Mayor',0 , 1, 'R');//end of the line
 
$pdf->SetFont('times', '', 11);
$pdf->Cell(70, 5, 'Office of the City Mayor', 0, 0, 'C');
$html .= '</table>';     



$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');

  
    }



