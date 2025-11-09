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
$jono = $_GET['ID'];
$job_date=$_GET['DateJo'];

$date = date('F d, Y');

if ($jono=$jono) {

    $id_emp = $_GET['ID'];
    $get_emp_data_sql = "SELECT * FROM employeedetail where ID = :ID";
    $get_emp_data_data = $con->prepare($get_emp_data_sql);
    $get_emp_data_data->execute([':ID' => $id_emp]);
    while ($result = $get_emp_data_data->fetch(PDO::FETCH_ASSOC)) {

    $get_emp_fname = $result['EmpFname'];
    $get_emp_mname = $result['EmpMname'];
    $get_emp_lname = $result['EmpLname'];
    $get_emp_ename = $result['EmpExt'];
     $get_emp_contact_number = $result['EmpContactNo'];
    $get_emp_designation = $result['EmpDesignation'];
    $get_emp_email= $result['EmpEmail'];
    $get_emp_gender = $result['EmpGender'];
    $get_emp_photo = $result['EmpPhoto'];
    $get_emp_department = $result['EmpDept'];
    $get_emp_dept_charge = $result['DeptCharge'];
    $get_emp_code = $result['EmpCode'];
    $get_emp_control = $result['ControlNo'];
    $get_emp_joingdate = $result['EmpJoingdate'];
    $get_emp_address = $result['EmpAddress'];
    $get_emp_brgy = $result['EmpBrgy'];
    $get_emp_city = $result['EmpCity'];
    $get_emp_province = $result['EmpProvince'];
    $get_emp_skills = $result['EmpSkills'];
    $get_emp_status = $result['EmpStatus'];
    $get_status = $result['E_Status'];
    $get_emp_birth =$result['EmpBirth'];
    $get_emp_category =$result['Category'];
    $get_emp_others =$result['Others'];
    $get_emp_charges =$result['Charges'];
    $get_emp_remarks =$result['Remarks'];
    $get_emp_citizen =$result['EmpCitizen'];
    $get_place_birth =$result['PlaceBirth'];
    $get_emp_blood = $result['EmpBlood'];
    $get_emp_service = $result['EmpNoService'];
    $get_emp_eligibility = $result['EmpEligible'];
    $get_emp_now = $result['PostingDate'];
    $get_now=date('Y-m-d');
    $diff =  date_diff(date_create($get_emp_birth), date_create($get_now));
    $get_age = $diff->format('%y');
    $diff1 =  date_diff(date_create($get_emp_joingdate), date_create($get_now));
    $get_start = $diff1->format('%y');
    $get_user= $result['user'];
    $get_report= $result['Report'];
    $get_spouse_ln= $result['SpouseLn'];
    $get_spouse_fn= $result['SpouseFn'];
    $get_spouse_mn= $result['SpouseMn'];
    $get_spouse_en= $result['SpouseEn'];
     $get_spouse_occ= $result['SpouseOcc'];
    $get_child1= $result['EmpChild1'];
    $get_child1_yr= $result['EmpChildB1'];
    $get_child2= $result['EmpChild2'];
    $get_child2_yr= $result['EmpChildB2'];
    $get_child3= $result['EmpChild3'];
    $get_child3_yr= $result['EmpChildB3'];
    $get_child4= $result['EmpChild4'];
    $get_child4_yr= $result['EmpChildB4'];
    $get_child5= $result['EmpChild5'];
    $get_child5_yr= $result['EmpChildB5'];
    $get_child6= $result['EmpChild6'];
    $get_child6_yr= $result['EmpChildB6'];
    $get_child7= $result['EmpChild7'];
    $get_child7_yr= $result['EmpChildB7'];
    $get_child8= $result['EmpChild8'];
    $get_child8_yr= $result['EmpChildB8'];
    $get_child9= $result['EmpChild9'];
    $get_child9_yr= $result['EmpChildB9'];
    $get_child10= $result['EmpChild10'];
    $get_child10_yr= $result['EmpChildB10'];
    $get_end= $result['EndDate'];


 } 

 $id_no = $_GET['ID'];
    $get_id_no_data_sql = "SELECT * FROM no where ID = :ID";
    $get_id_no_data_data = $con->prepare($get_id_no_data_sql);
    $get_id_no_data_data->execute([':ID' => $id_no]);
    while ($result = $get_id_no_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_id_no = $result['ID'];
    $get_id_sss = $result['SssNo'];
    $get_id_pagibig = $result['PagIbigNo'];
    $get_id_ctc = $result['CtcNo'];
    $get_id_date= $result['CtcDate'];
    $get_id_place = $result['CtcAt'];
    $get_id_atm = $result['AtmNo'];
    $get_id_tin = $result['TinNo'];
    $get_id_phil = $result['PhilNo'];
       
    }

   $id_edu = $_GET['ID'];
    $get_edu_data_sql = "SELECT * FROM empeducation where ID = :ID";
    $get_edu_data_data = $con->prepare($get_edu_data_sql);
    $get_edu_data_data->execute([':ID' => $id_edu]);
    while ($result = $get_edu_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_edu_id1 = $result['ID'];
    $get_edu_elem_sch = $result['ElementarySchool'];
    $get_edu_elem_yr = $result['ElementaryYear'];
    $get_edu_elem_award = $result['ElementaryAward'];
    $get_edu_sec_sch = $result['SecondarySchool'];
    $get_edu_sec_award = $result['SecondaryAward'];
    $get_edu_sec_yr = $result['SecondaryYear'];
    $get_edu_col_sch = $result['SchoolCollegeGra'];
    $get_edu_col_yr = $result['YearPassingGra'];
    $get_edu_col_award = $result['CollegeAward'];
    $get_edu_voc_sch = $result['Vocational'];
    $get_edu_voc_award = $result['VocationalAward'];
    $get_edu_voc_yr= $result['VocationalYear'];
    $get_edu_gra_yr = $result['GraduateYear'];
    $get_edu_gra_award = $result['GraduateAward'];
    $get_edu_gra_sch = $result['Graduate'];
  }

   $exp_id = $_GET['ID'];
    $get_exp_data_sql = "SELECT * FROM empexperience where ID = :ID";
    $get_exp_data_data = $con->prepare($get_exp_data_sql);
    $get_exp_data_data->execute([':ID' => $exp_id]);
    while ($result = $get_exp_data_data->fetch(PDO::FETCH_ASSOC)) {
    $get_exp_id = $result['ID'];
    $get_exp_emp1_name = $result['Employer1Name'];
    $get_exp_emp1_designation = $result['Employer1Designation'];
    $get_exp_emp1_salary = $result['Employer1CTC'];  
    $get_exp_emp1_duration = $result['Employer1WorkDuration'];
    $get_exp_emp2_name = $result['Employer2Name'];
    $get_exp_emp2_designation = $result['Employer2Designation'];
    $get_exp_emp2_salary = $result['Employer2CTC'];  
    $get_exp_emp2_duration = $result['Employer2WorkDuration'];
    $get_exp_emp3_name = $result['Employer3Name'];
    $get_exp_emp3_designation = $result['Employer3Designation'];
    $get_exp_emp3_salary = $result['Employer3CTC'];  
    $get_exp_emp3_duration = $result['Employer3WorkDuration'];
    }

  
  

        
$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';



$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 15);
$pdf->AddPage('P');
$pdf->Image('../../../dist/img/scclogo.png', 15, 11, 25, 20, 'PNG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 10, 38.3, 35, 34.5, 'JPG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 10, 38.3, 35, 34.5, 'JPEG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 10, 38.3, 35, 34.5, 'PNG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 10, 38.3, 35, 34.5, 'GIF');


$pdf->Cell(192, 8,  'JOb ORDER INFORMATION ', TRL, 1, C);//end of the line
$pdf->SetFont('times', 'I', 14);
$pdf->Cell(192, 8,  '(Job Order Management Information System)', RL, 1, C);
$pdf->SetFont('times', 'B', 14);
$pdf->Cell(192, 8,  'WORK RECORD', RL, 1, C);
$pdf->SetFont('times', '', 8);
$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'I. PERSONAL INFORMATION',LTRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

if ($get_emp_ename=="") {
$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', BRL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Name:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(142, 5,  ucwords(strtoupper($get_emp_fname." ".$get_emp_mname[0]."."." ". $get_emp_lname)), BR, 1, L);}
elseif($get_emp_ename!="") {
$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', RL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Name:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(142, 5,  ucwords(strtoupper($get_emp_fname." ".$get_emp_mname[0]."."." ". $get_emp_lname.","." ".$get_emp_ename )), BR, 1, L); 
}


$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', RL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Address:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(142, 5,  ucwords(strtoupper($get_emp_address.","." ".'BARANGAY'." ".$get_emp_brgy.","." ". $get_emp_city.","." ".$get_emp_province)), BR, 1, L); 

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', RL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Birthday:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(65, 5,  ucwords(strtoupper($get_emp_birth)), BR, 0, L); 
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Age:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(62, 5,  ucwords(strtoupper($get_age)), BR, 1, L); 

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', RL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Citizenship:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(65, 5,  ucwords(strtoupper($get_emp_citizen)), BR, 0, L); 
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Civil Status:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(62, 5,  ucwords(strtoupper($get_emp_status)), BR, 1, L); 

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', RL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Sex:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(142, 5,  ucwords(strtoupper($get_emp_gender)), BR, 1, L); 

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', RL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Office:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(142, 5,  ucwords(strtoupper($get_emp_department)), BR, 1, L); 

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(35, 5,  '', RL, 0, R);
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Work Status:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(65, 5,  ucwords(strtoupper($get_emp_category)), BR, 0, L); 
$pdf->SetFont('times', 'I', 8);
$pdf->Cell(15, 5,  'Control No:', BL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(62, 5,  ucwords(strtoupper($get_emp_control)), BR, 1, L); 


$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'II. RECORD OF SERVICE', TLRB, 'L', 1, 1, '', '', true, 0, false, true, 0);





$html .= '<table border="0.5" width="100%" cellspacing="0" cellpadding="0">';
$html .= '

  <thead>
         
            <tr bgcolor="lightblue">
              <th  width="19%" style="text-align:center;"><b>PERIOD COVERED</b></th>
              <th width="37%" style="text-align:center;"><b>DAYS</b></th>
              <th width="30%" style="text-align:center;"><b>TIME</b></th> 
              <th width="7%" style="text-align:center;"><b>RATE</b></th> 
               <th width="8%" style="text-align:center;"><b>OFFICE</b></th> 
              

            </tr>
          </thead>
        '; 
$pdf->SetFont('times', '', 9);

 if ($id_emp==$id_emp) {   

$schedule=$_GET['ID'];
  $get_schedule_sql = "SELECT * FROM schedule WHERE ID_sched = :ID ORDER BY id ASC";
    $get_schedule_data1 = $con->prepare($get_schedule_sql);
    $get_schedule_data1->execute([':ID' => $schedule]);    
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
     $jo_sched = $result['Schedule'];
      $jo_sched1 = $result['Schedule1'];
       $jo_sched2 = $result['Schedule2'];
       $jo_abbre = $result['abbre'];
   


   
if ($jo_period!="" && $jo_month1!="" && $jo_month2!="" && $jo_sched!="CUT OFF") { 

$html .= '

   

                <tbody>
                  <tr>
                     <td width="19%" style="text-align:left; font-size:8px;">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.'</td>
                    <td width="37%" style="font-size:9px;">'.$jo_sched.'</td>
                      <td width="30%" style="text-align:center; font-size:8px">'.$jo_time.'</td>
                       <td width="7%" style="font-size:8px; text-align:right">'.$jo_rate.'</td>
                       <td width="8%" style="text-align:center; font-size:8px">'.$jo_abbre.'</td>
                   
                   </tr>   

                    <tr>
                     <td width="19%" style="text-align:left; font-size:8px;">'.$jo_month1.' '.' '.$jo_days2.','.'  '.$jo_year.'</td>
                    <td width="37%" style="font-size:9px;">'.$jo_sched1.'</td>
                      <td width="30%" style="text-align:center; font-size:8px">'.$jo_time1.'</td>
                       <td width="7%" style="font-size:8px; text-align:right">'.$jo_rate1.'</td>
                       <td width="8%" style="text-align:center; font-size:8px">'.$jo_abbre.'</td>
                   
                   </tr>   

                    <tr>
                     <td width="19%" style="text-align:left; font-size:8px;">'.$jo_month2.' '.' '.$jo_days3.','.'  '.$jo_year.'</td>
                    <td width="37%" style="font-size:9px;">'.$jo_sched2.'</td>
                      <td width="30%" style="text-align:center; font-size:8px">'.$jo_time2.'</td>
                       <td width="7%" style="font-size:8px; text-align:right">'.$jo_rate2.'</td>
                       <td width="8%" style="text-align:center; font-size:8px">'.$jo_abbre.'</td>
                   
                   </tr>   
                </tbody>
            ';
          }
        
elseif ($jo_period!="" && $jo_month1!="" && $jo_month2=="" && $jo_sched!="CUT OFF") {
$html .= '

   

                <tbody>
                    <tr>
                     <td width="19%" style="text-align:left; font-size:8px;">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.'</td>
                    <td width="37%" style="font-size:9px;">'.$jo_sched.'</td>
                      <td width="30%" style="text-align:center; font-size:8px">'.$jo_time.'</td>
                       <td width="7%" style="font-size:8px; text-align:right">'.$jo_rate.'</td>
                       <td width="8%" style="text-align:center; font-size:8px">'.$jo_abbre.'</td>
                   
                   </tr>   
                     <tr>
                     <td width="19%" style="text-align:left; font-size:8px;">'.$jo_month1.' '.' '.$jo_days2.','.'  '.$jo_year.'</td>
                    <td width="37%" style="font-size:9px;">'.$jo_sched1.'</td>
                      <td width="30%" style="text-align:center; font-size:8px">'.$jo_time1.'</td>
                       <td width="7%" style="font-size:8px; text-align:right">'.$jo_rate1.'</td>
                       <td width="8%" style="text-align:center; font-size:8px">'.$jo_abbre.'</td>
                   
                   </tr> 

                </tbody>
            ';
          }

         elseif ($jo_period!="" && $jo_month1=="" && $jo_month2=="" && $jo_sched!="CUT OFF"){
$html .= '

   

                <tbody>
                    <tr>
                    <td width="19%" style="text-align:left; font-size:8px;">'.$jo_period.' '.' '.$jo_days1.','.'  '.$jo_year.'</td>
                    <td width="37%" style="font-size:9px;">'.$jo_sched.'</td>
                      <td width="30%" style="text-align:center; font-size:8px">'.$jo_time.'</td>
                       <td width="7%" style="font-size:8px; text-align:right">'.$jo_rate.'</td>
                       <td width="8%" style="text-align:center; font-size:8px">'.$jo_abbre.'</td>
                   
                   </tr>    
                </tbody>
            ';
          }

  elseif ($jo_sched=="CUT OFF"){
$html .= '

   

                <tbody>
                    <tr>
                    <td width="19%" style="text-align:left; font-size:6px; color:red">'.$jo_period.'</td>
                    <td width="37%" style="font-size:9px; color:red">'.$jo_sched.'</td>
                      <td width="30%" style="text-align:center; font-size:8px; color:red">'.$jo_time.'</td>
                       <td width="7%" style="font-size:8px; text-align:right; color:red">'.$jo_rate.'</td>
                       <td width="8%" style="text-align:center; font-size:8px; color:red">'.$jo_abbre.'</td>
                   
                   </tr>    
                </tbody>
            ';
          }

}
          $html .= '</table>';

}
}




$pdf->writeHTML($html, true, false, true, false, '');
$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';





$pdf->Ln(0);






  $html .= '</table>'; 




$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');

  
    



