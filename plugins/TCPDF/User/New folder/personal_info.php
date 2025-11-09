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
$pdf->Image('../../../dist/img/scclogo.png', 13, 11, 20, 15, 'PNG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 170, 35.5, 32, 30, 'JPG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 170, 35.5, 32, 30, 'JPEG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 170, 35.5, 32, 30, 'PNG');
$pdf->Image('../../../dist/photo/'.$get_emp_photo, 170, 35.5, 32, 30, 'GIF');


$pdf->Cell(192, 8,  'JOB ORDER/CONTRACT OF SERVICE/MOA INFORMATION', TRL, 1, C);//end of the line
$pdf->SetFont('times', 'I', 14);
$pdf->Cell(192, 8,  '(Job Order Management Information System)', RL, 1, C);
$pdf->SetFont('times', '', 8);
$pdf->Cell(192, 5,  'Print legibly. Tick appropriate boxes (     ) and use separate sheet if necessary. Indicate N/A if not applicable.  DO NOT ABBREVIATE.', BRL, 1, L);
$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'I. PERSONAL INFORMATION', LRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '1.', BL, 0, R);
$pdf->Cell(20, 5,  'Surname', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(135, 5,  ucwords(strtoupper($get_emp_lname)), BRL, 0, L);
$pdf->Cell(32, 5,  '', RL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(25, 5,  'First Name', BRL, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(90, 5,  ucwords(strtoupper($get_emp_fname)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(23, 5,  'Name Extension', BRL, 0, L);
$pdf->Cell(22, 5,  ucwords(strtoupper($get_emp_ename)), RLB, 0, L);
$pdf->Cell(32, 5,  '', RL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(25, 5,  'Middle Name', BRL, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(135, 5,  ucwords(strtoupper($get_emp_mname)), BRL, 0, L);
$pdf->Cell(32, 5,  '', RL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '2.', L, 0, R);
$pdf->Cell(20, 5,  'Address', R, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(135, 5,  ucwords(strtoupper($get_emp_address)), BRL, 0, C);
$pdf->Cell(32, 5,  '', RL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 0,  '', L, 0, R);
$pdf->Cell(20, 0,  '',R, 0, R);
$pdf->SetFont('times', 'I', 6);
$pdf->Cell(135, 0,  'House/Block/Lot No., Street, Subdivision/Village', BRL, 0, C);
$pdf->Cell(32, 0,  '', RL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '', L, 0, R);
$pdf->Cell(20, 5,  '', R, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(70, 5,  ucwords(strtoupper($get_emp_city)), BL, 0, C);
$pdf->Cell(65, 5,  ucwords(strtoupper($get_emp_province)), B, 0, C);
$pdf->Cell(32, 5,  '', RL, 1, L);

$pdf->SetFont('times', '', 5);
$pdf->Cell(5, 0,  '', BL, 0, R);
$pdf->Cell(20, 0,  '', BR, 0, R);
$pdf->SetFont('times', 'I', 6);
$pdf->Cell(70, 0,  'City/Municipallity', BRL, 0, C);
$pdf->Cell(65, 0,  'Province', BRL, 0, C);
$pdf->Cell(32, 0,  '', RBL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '3.', BL, 0, R);
$pdf->Cell(20, 5,  'Date of Birth', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(70, 5,  ucwords(strtoupper($get_emp_birth)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '9.', BL, 0, R);
$pdf->Cell(20, 5,  'Pag-Ibig No.', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(72, 5,  ucwords(strtoupper($get_id_pagibig)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '4.', BL, 0, R);
$pdf->Cell(20, 5,  'Place of Birth', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(70, 5,  ucwords(strtoupper($get_place_birth)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '10.', BL, 0, R);
$pdf->Cell(20, 5,  'Philhealth No.', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(72, 5,  ucwords(strtoupper($get_id_phil)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '5.', BL, 0, R);
$pdf->Cell(20, 5,  'Citizenship', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(70, 5,  ucwords(strtoupper($get_emp_citizen)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '11.', BL, 0, R);
$pdf->Cell(20, 5,  'SSS No.', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(72, 5,  ucwords(strtoupper($get_id_sss)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '6.', BL, 0, R);
$pdf->Cell(20, 5,  'Sex', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(70, 5,  ucwords(strtoupper($get_emp_gender)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '12.', BL, 0, R);
$pdf->Cell(20, 5,  'TIN No.', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(72, 5,  ucwords(strtoupper($get_id_tin)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '7.', BL, 0, R);
$pdf->Cell(20, 5,  'Civil Status', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(70, 5,  ucwords(strtoupper($get_emp_status)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '13.', BL, 0, R);
$pdf->Cell(20, 5,  'ATM No.', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(72, 5,  ucwords(strtoupper($get_id_atm)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '8.', BL, 0, R);
$pdf->Cell(20, 5,  'Mobile No.', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(70, 5,  ucwords(strtoupper($get_emp_contact_number)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '14.', BL, 0, R);
$pdf->Cell(20, 5,  'Email Address', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(72, 5,  $get_emp_email, BRL, 1, L);

$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'II. FAMILY BACKGROUND', LRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '15.', BL, 0, R);
$pdf->Cell(20, 5,  'Spouse Surname', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,  ucwords(strtoupper($get_spouse_ln)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(25, 5,  'First Name', BRL, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(90, 5,   ucwords(strtoupper($get_spouse_fn)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(23, 5,  'Name Extension', BRL, 0, L);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(54, 5,   ucwords(strtoupper($get_spouse_en)), RLB, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(25, 5,  'Middle Name', BRL, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,   ucwords(strtoupper($get_spouse_mn)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(25, 5,  'Occupation', BRL, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,   ucwords(strtoupper($get_spouse_occ)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '16.', L, 0, R);
$pdf->Cell(91, 5,  'Name of Children (Full Name)', R, 0, C);
$pdf->Cell(96, 5,  'Date of Birth (mm/dd/yyyy)', R, 1, C);

$pdf->Cell(96, 5,  '', BRL, 0, C);
$pdf->Cell(96, 5,  '', BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,   ucwords(strtoupper($get_child1)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child1_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,  ucwords(strtoupper($get_child2)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child2_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,  ucwords(strtoupper($get_child3)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child3_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,  ucwords(strtoupper($get_child4)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child4_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,  ucwords(strtoupper($get_child5)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child5_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5, ucwords(strtoupper($get_child6)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child6_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,  ucwords(strtoupper($get_child7)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child7_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,  ucwords(strtoupper($get_child8)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child8_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5, ucwords(strtoupper($get_child9)), BR, 0, L);
$pdf->Cell(96, 5,   ucwords(strtoupper($get_child9_yr)), BR, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(5, 5,  '', BL, 0, L);
$pdf->Cell(91, 5,  ucwords(strtoupper($get_child10)), BR, 0, L);
$pdf->Cell(96, 5,  ucwords(strtoupper($get_child10_yr)), BR, 1, C);


$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'III. EDUCATIONAL BACKGROUND', LRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '17.', L, 0, R);
$pdf->Cell(20, 5,  'Level', R, 0, C);
$pdf->Cell(88, 5,  'Name of School (Full name)', R, 0, C);
$pdf->Cell(40, 5,  'Period of Attendance', BR, 0, C);
$pdf->Cell(39, 5,  'Honors Received', R, 1, C);

$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  '', LBR, 0, R);
$pdf->Cell(88, 5,  '', BR, 0, C);
$pdf->Cell(20, 5,  'From', BR, 0, C);
$pdf->Cell(20, 5,  'To', BR, 0, C);
$pdf->Cell(39, 5,  '', BR, 1, C);

$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  'Elementary', LBR, 0, R);
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(88, 5,  ucwords(strtoupper($get_edu_elem_sch)), BR, 0, C);
$pdf->Cell(40, 5,  ucwords(strtoupper($get_edu_elem_yr)), BR, 0, C);
$pdf->Cell(39, 5,  ucwords(strtoupper($get_edu_elem_award)), BR, 1, C);

$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  'Secondary', LBR, 0, R);
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(88, 5,  ucwords(strtoupper($get_edu_sec_sch)), BR, 0, C);
$pdf->Cell(40, 5,  ucwords(strtoupper($get_edu_sec_yr)), BR, 0, C);
$pdf->Cell(39, 5,   ucwords(strtoupper($get_edu_sec_award)), BR, 1, C);

$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  'Vocational', LBR, 0, R);
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(88, 5,  ucwords(strtoupper($get_edu_voc_sch)), BR, 0, C);
$pdf->Cell(40, 5,  ucwords(strtoupper($get_edu_voc_yr)), BR, 0, C);
$pdf->Cell(39, 5,   ucwords(strtoupper($get_edu_voc_award)), BR, 1, C);

$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  'College', LBR, 0, R);
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(88, 5,  ucwords(strtoupper($get_edu_col_sch)), BR, 0, C);
$pdf->Cell(40, 5,  ucwords(strtoupper($get_edu_col_yr)), BR, 0, C);
$pdf->Cell(39, 5,   ucwords(strtoupper($get_edu_col_award)), BR, 1, C);

$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  'Graduates Studies', LBR, 0, R);
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(88, 5,   ucwords(strtoupper($get_edu_gra_sch)), BR, 0, C);
$pdf->Cell(40, 5, ucwords(strtoupper( $get_edu_gra_yr)), BR, 0, C);
$pdf->Cell(39, 5,  ucwords(strtoupper($get_edu_gra_award)), BR, 1, C);

$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'IV. CIVIL SERVICE ELIGIBILITY', LRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '18.', L, 0, R);
$pdf->Cell(20, 5,  'Career Service', R, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,  ucwords(strtoupper($get_emp_eligibility)), RL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '', BL, 0, R);
$pdf->Cell(20, 5,  '', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,  '', BRL, 1, L);


$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'V. WORK EXPERIENCE', LRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', '', 8);
$pdf->Cell(5, 5,  '19.', BL, 0, R);
$pdf->Cell(40, 5,  'Inclusive Dates', BR, 0, C);
$pdf->Cell(47, 5,  'Position Title', R, 0, C);
$pdf->Cell(65, 5,  'Department/Agency/Office/Company', R, 0, C);
$pdf->Cell(35, 5,  'Monthly Salary', R, 1, C);

$pdf->SetFont('times', '', 7);
$pdf->Cell(22, 5,  'From', LBR, 0, C);
$pdf->Cell(23, 5,  'To', BR, 0, C);
$pdf->Cell(47, 5,  '', BR, 0, C);
$pdf->Cell(65, 5,  '', BR, 0, C);
$pdf->Cell(35, 5,  '', BR, 1, C);

$pdf->SetFont('times', 'B', 7);
$pdf->Cell(45, 5, ucwords(strtoupper($get_exp_emp1_duration)), LBR, 0, C);
$pdf->Cell(47, 5,  ucwords(strtoupper($get_exp_emp1_designation)), BR, 0, C);
$pdf->Cell(65, 5,  ucwords(strtoupper($get_exp_emp1_name)), BR, 0, C);
$pdf->Cell(35, 5, ucwords(strtoupper($get_exp_emp1_salary)), BR, 1, R);

$pdf->SetFont('times', 'B', 7);
$pdf->Cell(45, 5,  ucwords(strtoupper($get_exp_emp2_duration)), LBR, 0, C);
$pdf->Cell(47, 5,  ucwords(strtoupper($get_exp_emp2_designation)), BR, 0, C);
$pdf->Cell(65, 5,  ucwords(strtoupper($get_exp_emp2_name)), BR, 0, C);
$pdf->Cell(35, 5,  ucwords(strtoupper($get_exp_emp2_salary)), BR, 1, R);

$pdf->SetFont('times', 'B', 7);
$pdf->Cell(45, 5,  ucwords(strtoupper($get_exp_emp3_duration)), LBR, 0, C);
$pdf->Cell(47, 5,  ucwords(strtoupper($get_exp_emp3_designation)), BR, 0, C);
$pdf->Cell(65, 5,   ucwords(strtoupper($get_exp_emp3_name)), BR, 0, C);
$pdf->Cell(35, 5,  ucwords(strtoupper($get_exp_emp3_salary)), BR, 1, R);

$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'VI. CURRENT WORK DETAILS', LRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '20.', BL, 0, R);
$pdf->Cell(20, 5,  'Department', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,  ucwords(strtoupper($get_emp_department)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '21.', BL, 0, R);
$pdf->Cell(20, 5,  'Designation', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,  ucwords(strtoupper($get_emp_designation)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '22.', BL, 0, R);
$pdf->Cell(20, 5,  'Charges', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,  ucwords(strtoupper($get_emp_dept_charge)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '23.', BL, 0, R);
$pdf->Cell(20, 5,  'Work Status', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(167, 5,  ucwords(strtoupper($get_emp_category)), BRL, 1, L);

$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  'Date Started', BRL, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(71, 5,  ucwords(strtoupper($get_emp_joingdate)), BRL, 0, L);
$pdf->SetFont('times', '', 8);
$pdf->Cell(25, 5,  'Date End', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(71, 5,  ucwords(strtoupper($get_end)), BRL, 1, L);

$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'VII. OTHER INFORMATION', LRB, 'L', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', '', 8);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(5, 5,  '23.', BL, 0, R);
$pdf->Cell(35, 5,  'Special Skills and Hobbies', BR, 0, R);
$pdf->SetFont('times', 'B', 9);
$pdf->Cell(152, 5,  ucwords(strtoupper($get_emp_skills)), BRL, 1, L);


$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192, 2,'CERTIFY', LRB, 'C', 1, 1, '', '', true, 0, false, true, 0);

$pdf->SetFont('times', 'B', 9);
$pdf->Cell(20, 5,  'SIGNATURE',LR, 0, C);
$pdf->Cell(82, 5,  '', R, 0, C);
$pdf->Cell(20, 5,  'DATE', R, 0, C);
$pdf->Cell(70, 5,  $get_now, R, 1, C);

$pdf->SetFont('times', 'B', 8);
$pdf->Cell(20, 5,  '', BLR, 0, C);
$pdf->Cell(82, 5,  '', BR, 0, C);
$pdf->Cell(20, 5,  '', BR, 0, C);
$pdf->Cell(70, 5,  '', BR, 1, C);

$pdf->SetFont('times', 'I', 8);
$pdf->Cell(192, 5,  'Page 1 of 1', BRL, 1, C);


$pdf->Ln(0);



}


  $html .= '</table>'; 







$pdf->writeHTML($html, false, false, false, false,'');

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';





$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');

  
    



