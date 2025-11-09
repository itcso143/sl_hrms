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
$pdf->SetFont('helvetica', 'B', 18);
$pdf->AddPage('P');
$pdf->Cell(192, 8,  'MEMBERSHIP REGISTRATION/REMITTANCE FORM', TRL, 1, C);//end of the line
$pdf->Cell(192, 5,  '', RL, 1, C);//end of the line

$pdf->Ln(0);

$pdf->SetFont('times', 'B', 20);
$pdf->Cell(172, 5,  '', L, 0,);//end of the line


$pdf->SetFont('times', 'B', 20);
$pdf->Cell(20, 0, 'M-1',R , 1, R);//end of the line

$pdf->SetFont('times', '', 12);
$pdf->Cell(192, 0,  'LOCAL GOVERNMENT UNIT - JOB ORDER LABORERS', LR, 1, C);//end of the line
$pdf->SetFont('times', '', 8);
$pdf->Cell(192, 1,  '', LR, 1, C);//end of the line


$pdf->SetFont('times', '', 7);
$pdf->Cell(125, 1,  '', RTL, 0,);//end of the line
$pdf->Cell(20, 1,  'MONTH', TL, 0, );
$pdf->Cell(18, 1,  '', T, 0, );
$pdf->Cell(18, 1,  '', T, 0, );
$pdf->Cell(11, 1,  'YEAR', RTL, 1, C);

$pdf->SetFont('times', 'I', 7);
$pdf->Cell(125, 1,  'ATRIUM OF MAKATI  BLDG., MAKATI AVE., MAKATI M.M.', RL, 0,);//end of the line
$pdf->Cell(20, 6.3,  '', LB, 0, );
$pdf->Cell(18, 1,  '', 0, 0, );
$pdf->Cell(18, 1,  '', 0, 0, );
$pdf->Cell(11, 1,  '', LR, 1, );

$pdf->SetFont('times', 'I', 7);
$pdf->Cell(125, 1,  'TEL. NOS. 810-27-16 TO 44 (Connecting all departments)', BRL, 0,);//end of the line
$pdf->Cell(20, 1,  '', 0, 0, );
$pdf->Cell(18, 1,  '', B, 0, );
$pdf->Cell(18, 1,  '', B, 0, );
$pdf->Cell(11, 1,  '', BLR, 1, );

$pdf->SetFont('times', '', 7);
$pdf->Cell(98, 4,  'NAME OF EMPLOYER', RL, 0,);//end of the line
$pdf->SetFont('times', '', 5);
$pdf->Cell(13, 5,  'FOR PRIVATE', 0, 0, );
$pdf->Cell(25, 1,  'EMPLOYEER SSS ID NO.', R, 0, R );
$pdf->Cell(11, 5,  'FOR GOVT', 0, 0, );
$pdf->Cell(15, 1,  'AGENCY CODE', 0, 0, );
$pdf->Cell(15, 1,  'BRANCH CODE', 0, 0, );
$pdf->Cell(15, 1,  'REGION CODE', R, 1, );

$pdf->SetFont('times', '', 7);
$pdf->Cell(98, 7,  '', RLB, 0,);//end of the line
$pdf->SetFont('times', '', 5);
$pdf->Cell(13, 7,  'EMPLOYEER', B, 0, );
$pdf->Cell(25, 7,  '', BR, 0, R );
$pdf->Cell(11, 7,  'EMPLOYER', B, 0, );
$pdf->Cell(15, 7,  '', RB, 0, );
$pdf->Cell(15, 7,  '', RB, 0, );
$pdf->Cell(15, 7,  '', RB, 1, );

$pdf->SetFont('times', '', 7);
$pdf->Cell(120, 4,  'ADDRESS OF EMPLOYER', LR, 0,);//end of the line
$pdf->Cell(16, 2,  'ZIP CODE', R, 0,C );
$pdf->Cell(56, 2,  'TELEPHONE NOS.', R, 1, );

$pdf->SetFont('times', '', 10);
$pdf->Cell(120, 5,  'San Carlos City, Negros Occidental', LBR, 0,);//end of the line
$pdf->Cell(16, 5,  '6127', RB, 0, );
$pdf->Cell(56, 5,  '312-6562', RB, 1, C );

$pdf->SetFont('times', '', 10);
$pdf->Cell(34, 4,  '', LR, 0,);//end of the line
$pdf->Cell(86, 2,  'NAMES OF EMPLOYEES', R, 0,C );
$pdf->Cell(72, 2,  'CONTRIBUTIONS', R, 1, C );

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  'Pag-IBIG ID No./DATE OF BIRTH', LR, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '(Family Name', 0, 0, );
$pdf->Cell(28, 5,  'First Name', 0, 0, C);
$pdf->Cell(28, 5,  'Middle Name)', R, 0, C);
$pdf->Cell(16, 5,  'EMPLOYEE', RT, 0, C);
$pdf->Cell(28, 5,  'EMPLOYER', RT, 0, C );
$pdf->Cell(28, 5,  'TOTAL', RT, 1, C );

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);


$jono = $_GET['JobOrderNo'];
$job_date=$_GET['DateJo'];

$date = date('F d, Y');

if ($jono=$jono) {

$job_id=$_GET['EmpCode'];
  $get_job_sql = "SELECT * FROM no WHERE EmpCode = :EmpCode";
    $get_job_data1 = $con->prepare($get_job_sql);
    $get_job_data1->execute([':EmpCode' => $job_id]);    
    while ($result = $get_job_data1->fetch(PDO::FETCH_ASSOC)) {
   
    $pag = $result['PagIbigNo'];   
  
    
}


        


        $html .= '

   

      ';

      

    
    
    $html .= '</table>'; 

}





$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';
$html .= '

 
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
    $jo_days = $result['NoDays'];
    $jo_pag = $result['pagIbig'];



  

$html .= '

                <tbody>

                    <tr>
                    <td width="18%" style="align:center;">'. "$jo_total".'</td>
                  <td width="15.7%" style="align:center;  border-spacing: 0px; border-bottom:1px solid black" >'. "$jo_lname".'</td>
                   <td width="14.8%" style="align:center;  border-left:1px white; border-bottom:1px solid black; border-spacing: 0px;">'. "$jo_fname".'</td>
                   <td width="14.7%" style="align:center; border-left:none; border-spacing: 0px; border-bottom:1px solid black">'. "$jo_mname".'</td>
                                     <td width="8.5%" style="align:center;">'."".'</td>
                   <td width="14.7%" style="align:center;">'."$jo_days" .'</td>
                    <td width="14.7%" align="">'."$jo_pag" .'</td>
                   </tr>
                 

                </tbody>
            ';
  


}
          $html .= '</table>';






$pdf->writeHTML($html, false, false, false, false,'');

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

$pdf->SetFont('times', '', 10);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 10);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', L, 0,C);//end of the line
$pdf->SetFont('times', '', 12);
$pdf->Cell(30, 5,  '', LTB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, );
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5,  '', 1, 0,C);//end of the line
$pdf->SetFont('times', '', 7);
$pdf->Cell(30, 5,  '', TB, 0, );
$pdf->Cell(28, 5,  '', TB ,0, C);
$pdf->Cell(28, 5,  '', TBR, 0, R);
$pdf->Cell(16, 5,  '', 1, 0, C);
$pdf->Cell(28, 5,  '', 1, 0, C );
$pdf->Cell(28, 5,  '', 1, 1, C );
$pdf->SetFont('times', '', 10);


$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 5, 'No. of Employee', LR, 0,);//end of the line
$pdf->Cell(20, 5,  'Total No. of', LR, 0, );
$pdf->Cell(20, 5,  '', TR ,0, C);
$pdf->Cell(20, 5,'', TR, 0, R);
$pdf->Cell(26, 5,  'TOTAL', TR, 0, );
$pdf->Cell(16, 10.4,  '', 1, 0, C );
$pdf->Cell(28,10.4,  '', 1, 0, C );
$pdf->SetFont('times', 'B', 10);
$pdf->Cell(5, 10.4, '=P=', TB, 0, L );
$pdf->Cell(23, 10.4,  '', TBR, 0, R );
$pdf->Cell(23, 5,  '', 0, 1, R );

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 0,  'on this page', LR, 0,);//end of the line
$pdf->Cell(20, 0,  'Employee if', LR, 0, );
$pdf->Cell(20, 0,  '', R ,0, C);
$pdf->Cell(20, 0,  '', R, 0, R);
$pdf->Cell(26, 0,  'FOR THIS ------->', R, 1, );

$pdf->SetFont('times', '', 6);
$pdf->Cell(34, 3,  '', BLR, 0,);//end of the line
$pdf->Cell(20, 3,  'last page', BLR, 0, );
$pdf->Cell(20, 3,  '', BR ,0, C);
$pdf->Cell(20, 3,  '', BR, 0, R);
$pdf->Cell(26, 3,  'PAGE', RB, 1, );

//Cell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)



$pdf->SetFont('times', '', 12);
$pdf->Cell(90, 5, 'Prepared by:', L, 0,);
$pdf->Cell(74, 5, '',R , 0,);
$pdf->SetFont('times', '', 12);
$pdf->Cell(28, 5, '',R, 1,);//end of the line

$pdf->Cell(164, 8,  '', LR, 0,);//end of the line
$pdf->Cell(28, 5, '',R, 1,);//end of the line

$pdf->Cell(164, 8,  '', LR, 0,);//end of the line
$pdf->Cell(28, 5, '',R, 1,);//end of the line



$pdf->SetFont('times', 'BU', 11);
$pdf->Cell(70, 10, 'CHARITY P. MADRID', L, 0, 'C');
$pdf->SetFont('times', 'BU', 11);
$pdf->Cell(94, 8, 'ATTY. ESTEFANIO S. LIBUTAN, JR.',R , 0, 'C');//end of the line
$pdf->Cell(28, 5, '',RB, 1,);//end of the line


$pdf->SetFont('times', '', 11);
$pdf->Cell(70, 8, 'Computer Operator I', L, 0, 'C');
$pdf->SetFont('times', '', 11);
$pdf->Cell(94, 8, 'City Administrator',R , 0, 'C');//end of the line
$pdf->Cell(28, 5, '',R, 1,);//end of the line

$pdf->Cell(164, 8,  '', LR, 0,);//end of the line
$pdf->SetFont('times', '', 6);
$pdf->Cell(14, 5,  'PAGE NO.', LR, 0,);
$pdf->Cell(14, 5,  'PAGE NO.', LR, 1,);//end of the line

$pdf->SetFont('times', '', 12);
$pdf->Cell(164, 6,  '', LBR, 0,);//end of the line
$pdf->SetFont('times', '', 12);
$pdf->Cell(14, 6,  'One', LRB, 0,C);
$pdf->Cell(14, 6,  'One', LRB, 1,C);//end of the line

$pdf->Cell(150, 8,  '', 0, 1,);//end of the line
$pdf->Cell(150, 8,  '', 0, 1,);//end of the line





$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');

  
    }



