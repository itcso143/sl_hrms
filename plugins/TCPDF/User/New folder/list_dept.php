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
$pdf->SetTitle('List of Job Order');
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
$pdf->SetFont('dejavusans', '', 8);
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
    'orientation'=> 'landscape'
);

$pdf->AddPage('L');

$resolutionno = $_GET['ID'];
$print = 1;
$id_em = $_GET['DeptCharge'];

$get_nojo_sql= "SELECT COUNT(ID) as total FROM employeedetail Where E_Status='Active'";
$get_nojo_data = $con->prepare($get_nojo_sql);
$get_nojo_data->execute();
$get_nojo_data->setFetchMode(PDO::FETCH_ASSOC);
while ($result1 = $get_nojo_data->fetch(PDO::FETCH_ASSOC)) {
  $countjo =  $result1['total']; 



$pdf->SetFont('times', 'I', 14);
$pdf->Cell(318, 2,  '(Job Order Management Information System)', RTL, 1, C);
$pdf->SetFont('times', '', 10);
$pdf->Cell(318, 5,  'Local Government Unit of San Carlos City, Negros Occidental', RL, 1, C);
$pdf->SetFont('times', 'B', 8);
$pdf->Cell(318, 5,  'TOTAL NO. OF CASUAL EMPLOYEE:'.' '.$countjo, BRL, 1, L);
$pdf->SetFont('times', 'BI', 9);
$pdf->SetFillColor(200, 200, 220);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('times', '',8 );

$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="1">';

$html .= '



          <thead>
         
           <tr bgcolor="lightblue" >
              <th  width="3%" style="text-align:center;"><b>No.</b></th>
              <th  width="20%" style="text-align:center;"><b>NAME</b></th>
              <th  width="5%" style="text-align:center;"><b>SEX</b></th>
              <th  width="3%" style="text-align:center;"><b>AGE</b></th>
              <th  width="6%" style="text-align:center;"><b>BIRTHDAY</b></th>
                <th  width="20%" style="text-align:center;"><b>ADDRESS</b></th>
              <th  width="5%" style="text-align:center;"><b>BRGY.</b></th>
              <th  width="25%" style="text-align:center;"><b>DEPARTMENT/ASSIGNED OFFICE</b></th>
              <th  width="13%" style="text-align:center;"><b>FUNCTION/POSITION</b></th>
            
            
              
            </tr>
          </thead>
        ';


if( $id_em==$id_em){
  $n = 1;
    $id_emp = $_GET['DeptCharge'];  
    $get_emp_data_sql = "SELECT * FROM employeedetail WHERE E_Status='Active' ORDER BY EmpLname  ASC";
    $get_emp_data_data = $con->prepare($get_emp_data_sql);
    $get_emp_data_data->execute([':DeptCharge' => $id_emp]);    
    while ($result = $get_emp_data_data->fetch(PDO::FETCH_ASSOC)) {

  
      
    $id_no1 = $result['ID'];
    $id_no = $id_no1 - 1;
    $get_emp_fname = ucwords(strtoupper($result['EmpFname']));
    $get_emp_mname = ucwords(strtoupper($result['EmpMname']));
    $get_emp_lname = ucwords(strtoupper($result['EmpLname']));
    $get_emp_ename = ucwords(strtoupper($result['EmpExt']));
     $get_emp_contact_number = $result['EmpContactNo'];
    $get_emp_designation = ucwords(strtoupper($result['EmpDesignation']));
    $get_emp_email= $result['EmpEmail'];
    $get_emp_gender = $result['EmpGender'];
    $get_emp_photo = $result['EmpPhoto'];
    $get_emp_department = $result['EmpDept'];
    $get_emp_dept_charge = $result['DeptCharge'];
     $get_emp_code = $result['EmpCode'];
    $get_emp_control = $result['ControlNo'];
    $get_emp_joingdate = $result['EmpJoingdate'];
    $get_emp_address = ucwords(strtoupper($result['EmpAddress']));
    $get_emp_brgy = ucwords(strtolower($result['EmpBrgy']));
    $get_emp_city = ucwords(strtoupper($result['EmpCity']));
    $get_emp_province = ucwords(strtoupper($result['EmpProvince']));
     $get_emp_skills = $result['EmpSkills'];
    $get_emp_status = $result['EmpStatus'];
    $get_status = $result['E_Status'];
    $get_emp_birth =$result['EmpBirth'];
    $get_emp_category =ucwords(strtolower($result['Category']));
   $get_now=date('Y-m-d');
    $diff =  date_diff(date_create($get_emp_birth), date_create($get_now));
    $get_age = $diff->format('%y');
 



if ($get_emp_fname!="" AND $get_emp_lname!="" AND $get_emp_mname!="" AND $get_emp_ename!="" AND $id_no1!=1 AND $get_status=="Active") { 
        $html .= '

   

        <tbody>
            <tr>
             <td width="3%" style="text-align:center">'.$n++.'</td>
            <td width="20%">'.$get_emp_lname.','.' '.$get_emp_fname.' '.$get_emp_mname[0].'.'.','.' '.$get_emp_ename.'</td>
            <td width="5%" style="text-align:center">'.$get_emp_gender.'</td>
            <td width="3%" style="text-align:center">'.$get_age.'</td>
             <td width="6%" style="text-align:center">'.$get_emp_birth.'</td>
            <td width="20%"> '. $get_emp_address.'</td>
            <td width="5%" style="text-align:center">'.$get_emp_brgy.'</td>
            <td width="25%" style="text-align:center">'.$get_emp_department.'</td>
            <td width="13%" style="text-align:center">'.$get_emp_designation.'</td>
    
            </tr>

            
           
          

        </tbody>
    ';

        }
elseif ($get_emp_fname!="" AND $get_emp_lname!="" AND $get_emp_mname!="" AND $get_emp_ename=="" AND $id_no1!=1 AND $get_status=="Active") {
$html .= '
        
         <tbody>
            <tr>
            <td width="3%" style="text-align:center">'.$n++.'</td>
            <td width="20%">'.$get_emp_lname.','.' '.$get_emp_fname.' '.$get_emp_mname[0].'.</td>
            <td width="5%" style="text-align:center">'.$get_emp_gender.'</td>
            <td width="3%" style="text-align:center">'.$get_age.'</td>
             <td width="6%" style="text-align:center">'.$get_emp_birth.'</td>
            <td width="20%"> '. $get_emp_address.'</td>
            <td width="5%" style="text-align:center">'.$get_emp_brgy.'</td>
            <td width="25%" style="text-align:center">'.$get_emp_department.'</td>
            <td width="13%" style="text-align:center">'.$get_emp_designation.'</td>
    
    
          
            </tr>

            
           
          

        </tbody>
    ';

 
}
elseif ($get_emp_ename!="" AND $get_emp_mname=="" AND $get_emp_fname!="" AND $get_emp_lname!="" AND $id_no1!=1 AND $get_status=="Active") {
$html .= '
        
         <tbody>
            <tr>
            <td width="3%" style="text-align:center">'.$n++.'</td>
            <td width="20%">'.$get_emp_lname.','.' '.$get_emp_fname.','.' '.$get_emp_ename.'</td>
            <td width="5%" style="text-align:center">'.$get_emp_gender.'</td>
            <td width="3%" style="text-align:center">'.$get_age.'</td>
             <td width="6%" style="text-align:center">'.$get_emp_birth.'</td>
            <td width="20%"> '. $get_emp_address.'</td>
            <td width="5%" style="text-align:center">'.$get_emp_brgy.'</td>
            <td width="25%" style="text-align:center">'.$get_emp_department.'</td>
            <td width="13%" style="text-align:center">'.$get_emp_designation.'</td>
    
    
          
            </tr>

            
           
          

        </tbody>
    ';

 
  }

  elseif ($get_emp_ename=="" AND $get_emp_mname=="" AND $get_emp_fname!="" AND $get_emp_lname!="" AND $id_no1!=1 AND $get_status=="Active") {
$html .= '
        
         <tbody>
            <tr>
            <td width="3%" style="text-align:center">'.$n++.'</td>
            <td width="21%">'.$get_emp_lname.','.' '.$get_emp_fname.'</td>
            <td width="5%" style="text-align:center">'.$get_emp_gender.'</td>
            <td width="3%" style="text-align:center">'.$get_age.'</td>
             <td width="6%" style="text-align:center">'.$get_emp_birth.'</td>
            <td width="20%"> '. $get_emp_address.'</td>
            <td width="5%" style="text-align:center">'.$get_emp_brgy.'</td>
            <td width="25%" style="text-align:center">'.$get_emp_department.'</td>
            <td width="13%" style="text-align:center">'.$get_emp_designation.'</td>
    
    
          
            </tr>

            
           
          

        </tbody>
    ';

 
  }
    }
    
    $html .= '</table>'; 
  }

}



$pdf->writeHTML($html, true, false, true, false, '');
    


$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');

