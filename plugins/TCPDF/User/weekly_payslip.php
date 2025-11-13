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
$pdf->SetTitle('WEEKLY PAYSLIP');
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

$payroll_id = $_GET['payroll_id'];

if ($payroll_id == $payroll_id) {

  $payroll_id = $_GET['payroll_id'];
  $get_payroll_sql = "SELECT * FROM tbl_weekly_payslip where payroll_id = :payroll_id";
  $get_payroll_data = $con->prepare($get_payroll_sql);
  $get_payroll_data->execute([':payroll_id' => $payroll_id]);
  while ($result = $get_payroll_data->fetch(PDO::FETCH_ASSOC)) {

    $serial_no = $result['serial_no'];
    $payroll_id = $result['payroll_id'];
    $fullname = $result['fullname_payroll'];
    $emp_id2 = $result['emp_id'];
    $datecreate_payroll = $result['datecreate_payroll'];
    $date_from = $result['date_from']; // e.g., "2025-02-01"
    $formatted_date_from = date("F d", strtotime($date_from));
    $date_to = $result['date_to'];
    $formatted_date_to = date("F d", strtotime($date_to));

    $daily_hours = $result['daily_hours'];
    $payroll_gross = $result['payroll_gross'];
    $total_emp_deduction = $result['total_emp_deduction'];
    $emp_total_netpay = $result['emp_total_netpay'];

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

    $emp_ot_additional = $result['emp_ot_additional'];
    $emp_ot_quantity = $result['emp_ot_quantity'];
    $emp_ot_rate = $result['emp_ot_rate'];
    $emp_ot_total = $result['emp_ot_total'];

    $emp_bonus_additional = $result['emp_bonus_additional'];
    $emp_bonus_quantity = $result['emp_bonus_quantity'];
    $emp_bonus_rate = $result['emp_bonus_rate'];
    $emp_bonus_total = $result['emp_bonus_total'];



    $get_emp_info_sql = "SELECT * FROM tbl_employee_info where emp_id = :emp_id";
    $get_emp_info_data = $con->prepare($get_emp_info_sql);
    $get_emp_info_data->execute([':emp_id' => $emp_id2]);
    while ($result = $get_emp_info_data->fetch(PDO::FETCH_ASSOC)) {




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
$pdf->Cell(0, 6,  'PAYSLIP', '', 1, C);





$pdf->SetFont('helvetica',  8);
$pdf->SetFont('helvetica', '', 9);
// $pdf->Cell(150, 4,  'Date: '.$datecreate_payroll, 0, 1,); //end of the line

$pdf->Ln(0);
// Title section
$html = '<table cellspacing="0" cellpadding="1" border="0">
<tr>
  <td width="100%">
    <strong>Serial:</strong> ' . $serial_no . '<br>
    <strong>Pay Date:</strong> ' . $datecreate_payroll . '<br>
    <strong>Pay Period:</strong> ' . $formatted_date_from . ' - ' . $formatted_date_to . '<br>
  </td>
</tr>
</table>
<br>

<table border="1" cellpadding="4" cellspacing="0" style="font-size:8px;">
<tr style="background-color:#f2f2f2;">
  <td width="50%"><strong>Employee</strong></td>
  <td width="50%"><strong>Company</strong></td>
</tr>
<tr>
  <td>
   <strong>' . $fullname . '</strong><br>
    Hired Date: ' . $formatted_date_joining . '<br>
    Birthday: ' . $formatted_date_birthdate . '<br>
    Phone: ' . $mobile_no . '<br>
    <br>
    SSS: ' . $sss . '<br>
    PhilHealth: ' . $philhealth . '<br>
    TIN: ' . $tin_no . '<br>
    PAG-IBIG: ' . $pag_ibig . '
  </td>
  <td>Searchlight of the Philippines Incorporated<br>' . $get_company . '
  </td>
</tr>
</table>
<br><br>

<table border="1" cellpadding="5" cellspacing="0">
<tr style="background-color:#f2f2f2;">
  <td><strong>Payment Details</strong></td>
</tr>
<tr>
  <td>
    Name Of Bank: ' . $bank_name . '<br>
    Account Holder Name: ' . $bank_holder_name . '<br>
    Account Type: ' . $bank_account_type . '<br>
    Account Number: ' . $bank_no . '
  </td>
</tr>
</table>
<br><br>


<table border="1" cellpadding="6" cellspacing="0" width="100%" >
    <tr style="background-color:#1F4E79;color:white;">
        <th width="25%">Week of</th>
        <th width="20%">Hours Worked</th>
        <th width="20%">Gross Pay</th>
        <th width="20%">Deduction</th>
        <th width="15%">Net Pay</th>
    </tr>
    <tr>
        <td>' . $formatted_date_from . '- ' . $formatted_date_to . '</td>
        <td>' . $daily_hours . '</td>
        <td>' . '$' . $payroll_gross . '</td>
        <td>' . '$' . $total_emp_deduction . '</td>
        <td>' . '$' . $emp_total_netpay . '</td>
    </tr>

     <tr style="background-color:#f2f2f2;font-weight:bold;">
        <td align="right"></td>
        <td></td>
        <td></td>
       <td style="text-align: left !important;">TOTAL</td>
        <td>' . '$' . $emp_total_netpay . '</td>
    </tr>
  
</table>

<br>
<br>

<table border="1" cellpadding="4" cellspacing="0" style="font-size:8px;">
  <tr style="background-color:#1F4E79;color:white;">
  <th width="50%"><strong>Additional</strong></th>
  <th width="15%"><strong>Quantity</strong></th>
  <th width="15%"><strong>Rate</strong></th>
  <th width="20%"><strong>Total</strong></th>
</tr>

<tr>
  <td>OVER TIME</td>
  <td align="center">' . $emp_ot_quantity . '</td>
  <td align="right">' . '$ '  . $emp_ot_rate . '</td>
  <td align="right">' . '$ ' . $emp_ot_total . '</td>
</tr>
<tr>
  <td>BONUS</td>
  <td align="center">' . $emp_bonus_quantity . '</td>
  <td align="right">' . '$ '  . $emp_bonus_rate . '</td>
  <td align="right">' . '$ '  . $emp_bonus_total . '</td>
</tr>

</table>

<br>
<br>
<table border="1" cellpadding="4" cellspacing="0" style="font-size:8px;">
<tr style="background-color:#f2f2f2;">
  <th width="50%"><strong>Deduction</strong></th>
  <th width="15%"><strong>Quantity</strong></th>
  <th width="15%"><strong>Rate</strong></th>
  <th width="20%"><strong>Total</strong></th>
</tr>
<tr>
  <td>SSS</td>
  <td align="center">N/A</td>
  <td align="right">N/A</td>
  <td align="right">N/A</td>
</tr>
<tr>
  <td>PAG-IBIG</td>
  <td align="center">N/A</td>
  <td align="right">N/A</td>
  <td align="right">N/A</td>
</tr>
<tr>
  <td>PHILHEALTH</td>
  <td align="center">N/A</td>
  <td align="right">N/A</td>
  <td align="right">N/A</td>
</tr>
<tr>
  <td>TAX</td>
  <td align="center">N/A</td>
  <td align="right">N/A</td>
  <td align="right">N/A</td>
</tr>
<tr>
  <td>HMO</td>
  <td align="center">' . $emp_hrmo_quantity . '</td>
  <td align="right">' . '$ '  . $emp_hrmo_rate . '</td>
  <td align="right">' . '$ ' . $emp_hrmo_total . '</td>
</tr>
<tr>
  <td>LATE</td>
  <td align="center">' . $emp_quantity_late . '</td>
  <td align="right">' . '$ '  . $emp_rate_late . '</td>
  <td align="right">' . '$ '  . $emp_total_late . '</td>
</tr>
<tr>
  <td>ABSENCES</td>
  <td align="center">' . $emp_quantity_absences . '</td>
  <td align="right">' . '$ '  . $emp_rate_absences . '</td>
  <td align="right">' . '$ '  . $emp_total_absences . '</td>
</tr>
</table>
<br>

<table cellpadding="2">
<tr><td><strong>Current Gross Pay:</strong></td><td align="right" style="font-size: 10px;">$ ' . $payroll_gross . '</td></tr>
<tr><td><strong>Current Net Pay:</strong></td><td align="right" style="font-size: 12px;"><strong>$ ' . $emp_total_netpay . '</strong></td></tr>
';

$pdf->Ln(0);



$pdf->writeHTML($html, true, false, true, false, '');

// $pdf->Cell(150, 2,  '', 0, 1,); //end of the line


$pdf->SetFont('times', 'UB', 11);
$pdf->Cell(90, 5, ucwords(strtoupper($fullname)), 0, 0, 'C');
$pdf->SetFont('times', 'UB', 11);
$pdf->Cell(90, 5, 'ROGER FERNANDEZ RUPUESTO ', 0, 1, 'C'); //end of the line

$pdf->SetFont('', '', 9);
$pdf->Cell(90, 1, 'Employee', 0, 0, 'C');
$pdf->SetFont('', '', 9);
$pdf->Cell(90, 1, 'Employer', 0, 1, 'C'); //end of the line

$pdf->Cell(150, 4, '', 0, 1); // blank line
$pdf->Cell(150, 4, '', 0, 1); // blank line
$pdf->SetFont('times', 'UB', 11);
$pdf->Cell(0, 5, 'ISMIRALDA ANN GAGANI RUPUESTO', 0, 1, 'C'); // 0 width = full page width

$pdf->SetFont('', '', 9);
$pdf->Cell(0, 5, 'Human Resources', 0, 1, 'C'); // center under the name


$pdf->Cell(150, 5,  '', 0, 1,); //end of the line
$pdf->SetFont('times', '', 9);
$pdf->MultiCell(0, 5, 'If you need further assistance, please feel free to contact the HR at support8@fnrecovery.com', 0, 'C', 0, 1);

$pdf->lastPage();


ob_end_clean();

$pdf->Output('Plain.pdf', 'I');
