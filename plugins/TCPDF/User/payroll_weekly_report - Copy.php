<?php
ob_start();
session_start();

require_once('tcpdf_include2.php');
include('../../../config/db_config.php');
//include ('update_print.php');

date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$year = date('Y');
$month = date_create()->format('F');
// $month = date_create()->format('M');

$day = date_create()->format('jS');


$time = date('H:i:s');
$now = new DateTime();

$width = 10;
$height = 10;
$pageLayout = array($width, $height);

// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('PayRoll Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

if (@file_exists(dirname(_FILE_) . '/lang/eng.php')) {
  require_once(dirname(_FILE_) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

//$pdf->SetFont('dejavusans', '', 8);

$salary_id = $_GET['salary_id'];

if ($salary_id == $salary_id) {

  $salary_id = $_GET['salary_id'];
  $get_salary_sql = "SELECT * FROM tbl_emp_salary where salary_id = :salary_id";
  $get_salary_data = $con->prepare($get_salary_sql);
  $get_salary_data->execute([':salary_id' => $salary_id]);
  while ($result = $get_salary_data->fetch(PDO::FETCH_ASSOC)) {

    $salary_id = $result['salary_id'];
    $serial_no = $result['serial_no'];
    $emp_id = $result['emp_id_salary'];
    $date_create_salary = $result['date_create_salary'];
    $date_from = $result['date_from']; // e.g., "2025-02-01"
    $formatted_date_from = date("F d, Y", strtotime($date_from));
    $date_to = $result['date_to'];
    $formatted_date_to = date("F d, Y", strtotime($date_to));

    $emp_basic_salary = $result['emp_basic_salary'];
    $emp_quantity = $result['emp_quantity'];
    $emp_rate = $result['emp_rate'];
    $emp_total = $result['emp_total'];

    $emp_gross_pay = $result['emp_gross_pay'];
    $emp_current_pay = $result['emp_current_pay'];

    $get_company = $result['company'];

    $emp_late_deduction = $result['emp_late_deduction'];
    $emp_quantity_late = $result['emp_quantity_late'];
    $emp_rate_late = $result['emp_rate_late'];
    $emp_total_late = $result['emp_total_late'];

    $emp_absences_deduction = $result['emp_absences_deduction'];
    $emp_quantity_absences = $result['emp_quantity_absences'];
    $emp_rate_absences = $result['emp_rate_absences'];
    $emp_total_absences = $result['emp_total_absences'];

    $emp_hrmo_deduction = $result['emp_hrmo_deduction'];
    $emp_hrmo_quantity = $result['emp_hrmo_quantity'];
    $emp_hrmo_rate = $result['emp_hrmo_rate'];
    $emp_hrmo_total = $result['emp_hrmo_total'];




    $get_emp_info_sql = "SELECT * FROM tbl_employee_info where emp_id = :emp_id";
    $get_emp_info_data = $con->prepare($get_emp_info_sql);
    $get_emp_info_data->execute([':emp_id' => $emp_id]);
    while ($result = $get_emp_info_data->fetch(PDO::FETCH_ASSOC)) {

      $emp_id = $result['emp_id'];
      $fullname = $result['fullname'];

      $date_joining = $result['date_joining'];
      $formatted_date_joining = date("F d, Y", strtotime($date_joining));

      $birthdate = $result['birthdate'];
      $formatted_date_birthdate = date("F d, Y", strtotime($birthdate));

      $mobile_no = $result['mobile_no'];
      $sss = $result['sss'];
      $philhealth = $result['philhealth'];
      $tin_no = $result['tin_no'];
      $pag_ibig = $result['pag_ibig'];

      $bank_name = $result['bank_name'];
      $bank_no = $result['bank_no'];
      $bank_account_type = $result['bank_account_type'];
      $bank_holder_name = $result['bank_holder_name'];
    }
  }




  $pdf->SetPrintHeader(false);
  $pdf->SetPrintFooter(false); {
    // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
    $pdf->Ln(10);

    $pdf->AddPage('P');



    // $pdf->Image('../../../photo/lgu.jpg', 47, 11, 20, 18, 'JPG');
    $pdf->Image('../../../logo/logo.png', 170, 8, 25, 25, 'PNG');
    // $pdf->Image('../../../photo/'.$punongbarangay_barangay.'.png', 35, 70, 140, 140, 'PNG');

    // $pdf->Image('../../../../sccdrrmo/flutter/images/'.$barangay_photo, 157, 72, 32, 30, 'JPG');



    // $pdf->Image('../../../photo/'.$barangay_photo, 170, 40.5, 20, 50, 'JPEG');
    // $pdf->Image('../../../photo/'.$barangay_photo, 170, 40.5, 20, 50, 'PNG');
    // $pdf->Image('../../../photo/'.$barangay_photo, 170, 40.5, 20, 50, 'GIF');

    $style = array(
      'border' => 2,
      'vpadding' => 'auto',
      'hpadding' => 'auto',
      'fgcolor' => array(0, 0, 0),
      'bgcolor' => false, //array(255,255,255)
      'module_width' => 1, // width of a single module in points
      'module_height' => 1 // height of a single module in points
    );
    // $pdf->Cell(192, 5,  '', '', 5, L);
    // $pdf->Cell(192, 5,  '', '', 5, L);

  }
}

$pdf->SetFont('helvetica', 'B', 25);
$pdf->Cell(0, 15,  'PAYROLL REPORT', '', 1, C);
// $pdf->SetFont('times', 'B', 9);
// $pdf->Cell(192, 5,  '', '', 5, L);
// $pdf->Cell(192, 5,  '', '', 5, L);
// $pdf->Cell(192, 5,  '', '', 5, L);
// $pdf->Cell(192, 5,  '', '', 5, L);
// $pdf->Cell(0, 5, 'To Whom It May Concern:', '', 'L');



// $pdf->Cell(192, 5,  '', '', 5, L);
$pdf->SetFont('helvetica',  8);
$pdf->SetFont('helvetica', '', 9);
// $pdf->Cell(150, 4,  '', 0, 1,); //end of the line

$pdf->Ln(0);
// Title section
$html = '
<br>
<br>
<br>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr style="background-color:#f2f2f2;">
        <td width="33%"><strong>Name of Employee</strong></td>
        <td width="67%">'.$fullname.'</td>
    </tr>
</table>
<br>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <td width="33%">
            <strong>Avg. Daily Hours</strong><br>4h 5m
        </td>
        <td width="33%">
            <strong>Total Regular Hours Worked</strong><br>1820h
        </td>
        <td width="34%">
            <strong>Total Overtime Hours Worked</strong><br>387h
        </td>
    </tr>
</table>

<br>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr>
        <td width="33%">
            <strong>Pay Type</strong><br>Hourly
        </td>
        <td width="33%">
            <strong>Rate</strong><br>$6.00/hr
        </td>
        <td width="34%">
            <strong>Total Wage</strong><br><strong>$13,242.00</strong>
        </td>
    </tr>
</table>

<br><br>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr style="background-color:#1F4E79;color:white;">
        <th width="25%">MONTHS</th>
        <th width="20%">REGULAR HOURS</th>
        <th width="20%">OVERTIME HOURS</th>
        <th width="20%">TOTAL HOURS</th>
        <th width="15%">TOTAL WAGE</th>
    </tr>
    <tr>
        <td>January – March</td>
        <td>480h</td>
        <td>90h</td>
        <td>570h</td>
        <td>$3,420.00</td>
    </tr>
    <tr>
        <td>April – June</td>
        <td>420h</td>
        <td>102h</td>
        <td>522h</td>
        <td>$3,132.00</td>
    </tr>
    <tr>
        <td>July – September</td>
        <td>440h</td>
        <td>110h</td>
        <td>550h</td>
        <td>$3,300.00</td>
    </tr>
    <tr>
        <td>October – December</td>
        <td>480h</td>
        <td>85h</td>
        <td>565h</td>
        <td>$3,390.00</td>
    </tr>
    <tr style="background-color:#f2f2f2;font-weight:bold;">
        <td align="right">TOTAL</td>
        <td>1820h</td>
        <td>387h</td>
        <td>2207h</td>
        <td>$13,242.00</td>
    </tr>
</table>
';

$pdf->Ln(0);



$pdf->writeHTML($html, true, false, true, false, '');

$pdf->lastPage();


ob_end_clean();

$pdf->Output('Plain.pdf', 'I');