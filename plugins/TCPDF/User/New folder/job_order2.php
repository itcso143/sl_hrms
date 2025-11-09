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




if ($jono==$jono) {

$jo_no=$_GET['JobOrderNo'];
  $get_jo_sql ="SELECT * FROM createjo where JobOrderNo = :JobOrderNo";
    $get_jo_data1 = $con->prepare($get_jo_sql);
    $get_jo_data1->execute([':JobOrderNo' => $jo_no]);    
    while ($result = $get_jo_data1->fetch(PDO::FETCH_ASSOC)) {
    
   
    $project = $result['ProjectName'];
    $charges = $result['Charges'];
    $budget = $result['ProjectBudget'];
    $prev = $result['PreviousBalance'];
    $dtr_date = $result['DateJo']; 
    $department = $result['Department'];
    $uniq = $result['Uniq'];  
    $item_one = $result['Item1'];  
      
}
 
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->AddPage('P');
$pdf->Write(0, strtoupper($department), '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Ln(3);
$pdf->SetFont('times', '', 11);

$jono = $_GET['JobOrderNo'];
$date = date('F d, Y');






$html = '<h10>'.'</h10>'; 

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)


$pdf->SetFillColor(255, 250, 200);

$pdf->SetFont('times', 'B', 11);
$pdf->Cell(38, 8, 'JOB ORDER NO.:', 0, 0);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(60, 8, $uniq."-".$jono,0, 1,);

$pdf->SetTextColor('');
$pdf->SetFont('times', '', 11);
$pdf->Cell(38, 8, 'Date:', 0, 0,);
$pdf->Cell(60, 8, $dtr_date, 0, 0,);
$pdf->SetFont('times', '', 11);
$pdf->Cell(60, 8, 'Project Cost/Budget (Labor):   P',0 , 0,);
$pdf->SetFont('times', 'UB', 11);
$pdf->Cell(23, 8, number_format($budget, 2), 0, 1, 'R');//end of the line

$pdf->SetFont('times', '', 11);
$pdf->Cell(38, 8, 'Project:', 0, 0);
$pdf->Cell(60, 8, $project,0, 0,);
$pdf->Cell(60, 8, 'Previous Balance:',0, 0,);
$pdf->SetFont('times', 'U', 11);
$pdf->Cell(23, 8, number_format($prev, 2), 0, 1, 'R');//end of the line

$pdf->SetFont('times', '', 11);
$pdf->Cell(38, 8, 'Charges:', 0, 0);
$pdf->Cell(60, 8, $charges,0, 0,);



if ($jono==$jono) {

$job_id=$_GET['JobOrderNo'];
  $get_job_sql = "SELECT * FROM createjo WHERE JobOrderNo = :JobOrderNo";
    $get_job_data1 = $con->prepare($get_job_sql);
    $get_job_data1->execute([':JobOrderNo' => $job_id]);    
    while ($result = $get_job_data1->fetch(PDO::FETCH_ASSOC)) {
   
    $amount = $result['Amount'];
    $balances = $result['Balance'];
    $laborers = $result['Laborers'];
     $jo_schedule = $result['Schedules'];
      $item_one = $result['Item1'];
      $item_two = $result['Item2'];
      $item_three = $result['Item3'];
      $item_four = $result['Item4'];
      $item_five = $result['Item5'];
      $desc_one = $result['Description1'];
      $desc_two = $result['Description2'];
      $desc_three = $result['Description3'];
      $desc_four = $result['Description4'];
      $desc_five = $result['Description5'];
}

$user_id = $_SESSION['id'];

$user_name=$_GET['user_id'];
$get_user_sql ="SELECT * FROM tbl_users where user_id = :user_id";
$get_user_data1 = $con->prepare($get_user_sql);
$get_user_data1->execute([':user_id' => $user_id]);    
  while ($result = $get_user_data1->fetch(PDO::FETCH_ASSOC)) {
       
    $first_name = $result['first_name'];
    $middle_name = $result['middle_name'];
    $last_name = $result['last_name']; 
  


$pdf->Cell(60, 8, 'This period:',0 , 0, 'C');
$pdf->SetFont('times', 'U', 11);
$pdf->Cell(23, 8, number_format($amount,2), 0,1, 'R');//end of the line


$pdf->SetFont('times', '', 11);
$pdf->Cell(38, 8, '', 0, 0);
$pdf->Cell(60, 8,'',0, 0,);
$pdf->Cell(60, 8, 'Balance:',0 , 0, 'C');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetFont('times', 'UB', 11);
$pdf->Cell(23, 8, number_format($balances,2), 0,1, 'R');//end of the line

$pdf->SetTextColor('');
$pdf->SetFont('times', '', 11);
$pdf->Cell(150, 8,  '', 0, 1, 'R');//end of the line

if ($laborers=='1') {

$pdf->Cell(150, 6,  'This'. " ".$laborers. " ". 'laborer is directed to proceed to jobsite, namely:', 0, 1,);//end of the line

} else {
$pdf->Cell(150, 6,  'These'. " ".$laborers. " ". 'laborers are directed to proceed to jobsite, namely:', 0, 1,);//end of the line

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
$n = 1;
$schedule=$_GET['JobOrderNo'];
  $get_schedule_sql = "SELECT * FROM schedule WHERE JobOrderNo = :JobOrderNo ORDER BY LName ASC";
    $get_schedule_data1 = $con->prepare($get_schedule_sql);
    $get_schedule_data1->execute([':JobOrderNo' => $schedule]);    
    while ($result = $get_schedule_data1->fetch(PDO::FETCH_ASSOC)) {
    
   
    $jo_fname = ucwords(strtoupper($result['FName']));
    $jo_mname = ucwords(strtoupper($result['MName']));
    $jo_lname = ucwords(strtoupper($result['LName']));
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
     $jo_sched = $result['Schedule'];
   
   
if ($jo_period!="" && $jo_month1!="" && $jo_month2!="") { 

$html .= '

   
  <tbody>
                    <tr>
                    <td width="8%" style="text-align:center;font-size:12px;">'. $n.'</td>
                    <td width="18%" style="font-size:12px;">'. $jo_lname.'</td>
                      <td width="3%" style="text-align:center; font-size:12px">'.','.'</td>
                       <td width="17%" style="font-size:12px;">'. $jo_fname.'</td>
                       <td width="5%" style="text-align:center; font-size:12px">'. $jo_mname[0].'.'.'</td>
                    <td width="50%" style="text-align:center; font-size:11px">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.' '.'@'.' '.$jo_rate.''.'/day'.' '.$jo_time.'('.$jo_sched.')'.'
                       <br>
                      '.$jo_month1.' '.' '.$jo_days2.','.' '.$jo_year.' '.'@'.' '.$jo_rate1.''.'/day'.' '.$jo_time1.'('.$jo_sched1.')'.'
                      <br>
                      '.$jo_month2.' '.' '.$jo_days3.','.'  '.$jo_year.' '.'@'.' '.$jo_rate2.''.'/day'.' '.$jo_time2.'('.$jo_sched2.')'.'
                     </td>
                   </tr>

                </tbody>
            ';
          }
        
elseif ($jo_period!="" && $jo_month1!="" && $jo_month2=="") {
$html .= '

   

              
                   <tbody>
                    <tr>
                    <td width="8%" style="text-align:center; font-size:12px;">'. $n.'</td>
                    <td width="18%" style="font-size:12px;">'. $jo_lname.'</td>
                      <td width="3%" style="text-align:center; font-size:12px">'.','.'</td>
                       <td width="17%" style="font-size:12px;">'. $jo_fname.'</td>
                       <td width="5%" style="text-align:center; font-size:12px">'. $jo_mname[0].'.'.'</td>
                    <td width="50%" style="text-align:center; font-size:11px">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.' '.'@'.' '.$jo_rate.''.'/day'.' '.$jo_time.'('.$jo_sched.')'.'
                       <br>
                      '.$jo_month1.' '.' '.$jo_days2.','.' '.$jo_year.' '.'@'.' '.$jo_rate1.''.'/day'.' '.$jo_time1.'('.$jo_sched1.')'.'
                     </td>
                   </tr>                 

                </tbody>
            ';
          }

         elseif ($jo_period!="" && $jo_month1=="" && $jo_month2==""){
$html .= '

   

               
                <tbody>
                    <tr>
                    <td width="8%" style="text-align:center; font-size:12px;">'. $n.'</td>
                    <td width="18%" style="font-size:12px;">'. $jo_lname.'</td>
                      <td width="3%" style="text-align:center; font-size:11px">'.','.'</td>
                       <td width="17%" style="font-size:12px;">'. $jo_fname.'</td>
                       <td width="5%" style="text-align:center; font-size:12px">'. $jo_mname[0].'.'.'</td>
                    <td width="50%" style="text-align:center; font-size:11px">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.' '.'@'.' '.$jo_rate.''.'/day'.' '.'<br>'.$jo_time.'('.$jo_sched.')'.'
                   
                     </td>
                   </tr>                 

                </tbody>
            ';
          }

}
          $html .= '</table>';

}




$pdf->writeHTML($html, true, false, true, false, '');

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(60, 8, 'WORK TO BE DONE:',0 , 1, 'L');

if ($item_one!="" && $desc_one!="" && $item_two=="" && $desc_two=="") {
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_one, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_one, 0,1,);//end of the line
 }     
elseif ($item_two!="" && $desc_two!="" && $item_three=="" && $desc_three=="") {
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_one, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_one, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_two, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_two, 0,1,);//end of the line
 }     
elseif ($item_three!="" && $desc_three!="" && $item_four=="" && $desc_four=="") {
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_one, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_one, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_two, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_two, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_three, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_three, 0,1,);//end of the line
 }    
 elseif ($item_four!="" && $desc_four!="" && $item_five=="" && $desc_five=="") {
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_one, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_one, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_two, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_two, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_three, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_three, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_four, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_four, 0,1,);//end of the line
 }      
  elseif ($item_four!="" && $desc_four!="" && $item_five!="" && $desc_five!="") {
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_one, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_one, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_two, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_two, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_three, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_three, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_four, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_four, 0,1,);//end of the line
$pdf->SetFont('times', '', 9);
$pdf->Cell(25, 1, 'Item:'.' '.$item_five, 0,0,);
$pdf->Cell(5, 1, '-', 0,0,);
$pdf->Cell(80, 1, $desc_five, 0,1,);//end of the line
 }      

$pdf->SetFillColor(255, 250, 200);

$pdf->SetFont('times', 'B', 11);
$pdf->Cell(38, 8, '***********************************************************************************', 0, 0);
$pdf->Cell(60, 8, '',0, 1,);

  
$pdf->SetFont('times', '', 10);
$pdf->Cell(90, 10, 'Prepared by:', 0, 0,);
$pdf->SetFont('times', '', 10);
$pdf->Cell(80, 8, 'Recommended for Approval:',0 , 1,);//end of the line

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line


$pdf->SetFont('times', 'B', 10);
$pdf->Cell(70, 1, strtoupper($first_name." ".$middle_name[0]."."." ".$last_name), 0, 0, 'C');
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(130, 1, 'ATTY. ESTEFANIO S. LIBUTAN, JR.',0 , 1, 'C');//end of the line

$pdf->SetFont('times', '', 10);
$pdf->Cell(70, 1, 'Computer Operator I', 0, 0, 'C');
$pdf->SetFont('times', '', 10);
$pdf->Cell(130, 1, 'City Administrator',0 , 1, 'C');//end of the line

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line

$pdf->SetFont('times', '', 10);
$pdf->Cell(90, 10, 'Noted by:', 0, 0,);
$pdf->SetFont('times', '', 10);
$pdf->Cell(80, 8, 'Approved by:',0 , 1,);//end of the line

$pdf->Cell(150, 4,  '', 0, 1,);//end of the line
$pdf->Cell(150, 4,  '', 0, 1,);//end of the line

$pdf->SetFont('times', 'B', 10);
$pdf->Cell(70, 5, 'AIRENE ROSE N. GUSTILO', 0, 0, 'C');
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(130, 5, 'HON. RENATO Y. GUSTILO',0 , 1, 'C');//end of the line

$pdf->SetFont('times', '', 10);
$pdf->Cell(70, 1, 'Executive Assistant IV/CMO', 0, 0, 'C');
$pdf->SetFont('times', '', 10);
$pdf->Cell(75, 1, 'City Mayor',0 , 1, 'R');//end of the line
 
$html .= '</table>';     
}


$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');

  
    }



