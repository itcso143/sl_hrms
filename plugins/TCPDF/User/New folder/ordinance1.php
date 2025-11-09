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
    'stretchtext' => 4
);

$pdf->AddPage('P');

$category = $get['Category'];
$get_orTitle = $get['OrdinanceTitle'];
$print = 1;


$html = '<h2>Date Range.:' . $_GET['date_from'] .' - '. $_GET['date_to'] .'</h2>';  





$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">';

$html .= '



          <thead>
         
            <tr>
              <th>Ordinance Number</th>
              <th>Ordinance Title</th>
              
            </tr>
          </thead>
        ';



//select all users

if ($update_orno !="Please select..."){
    if ($get_orTitle !="Please select..."){


        $get_ordinances_sql = "SELECT * FROM ordinances WHERE d.category = :category and d.get_orTitle = :origin and d.print = 0 order by d.OrdinanceNumber";
        $get_ordinances_data = $con->prepare($get_ordinances_sql);
        $get_ordinances_data->execute(array(':category'=>$category,':origin'=>$get_orTitle));

        while ($result = $get_ordinances_data->fetch(PDO::FETCH_ASSOC)) {

    // $fullname = ucfirst($result['first_name']) . ' ' . ucwords($result['middle_name']) . ' ' . ucfirst($result['last_name']);
    // $email = $result['email'];
    // $contact_number = $result['contact_number'];
        $ordinanceno = $result['OrdinanceNumber'];
        $ordinanceTitle = $result['OrdinanceTitle'];
        





    $html .= '

   

                <tbody>
                    <tr>
                    <td>'. $ordinanceno .'</td>
                    <td>'.  $ordinanceTitle .'</td>
                    <td></td>
                    <td></td>
                    </tr>

                    
                   
                  

                </tbody>
            ';
}
$update_document_sql = "UPDATE ordinances set d.print = :print WHERE d.category = :category and d.get_orTitle = :origin";
        
                
$update_data = $con->prepare($update_document_sql);
$update_data->execute([
    ':print'            => $print,
    ':category'             => $category,
    ':origin'           => $get_orTitle
    
   
    ]);

    } if ($category =="Please select..."){


        $get_ordinances_sql = "SELECT DISTINCT * FROM tbl_documents d inner join tbl_ledger l on l.docno = d.docno WHERE d.creator = :origin and l.txndate between '$date_from' and '$date_to' and l.status in ('FORWARDED','CREATED') and l.origin = '$department' and d.print = 0 order by d.docno";
        $get_ordinances_data = $con->prepare($get_document_sql);
        $get_ordinances_data->execute([':origin'=>$origin]);

        while ($result = $get_document_data->fetch(PDO::FETCH_ASSOC)) {

    // $fullname = ucfirst($result['first_name']) . ' ' . ucwords($result['middle_name']) . ' ' . ucfirst($result['last_name']);
    // $email = $result['email'];
    // $contact_number = $result['contact_number'];
        $docno = $result['docno'];
        $creator = $result['creator'];
        $destination = $result['destination'];
        $receiver = $result['receiver'];
        $particulars = $result['particulars'];
        $date = $result['txndate'];
        $time = $result['time'];
        $action = $result['status'];
        $remarks = $result['remarks'];





    $html .= '

   

                <tbody>
                    <tr>
                    <td>'. $docno .'</td>
                    <td>'. $creator .'</td>
                    <td>'. $destination .'</td>
                    <td>'. $particulars .'</td>
                    <td></td>
                    <td></td>
                    </tr>

                    
                   
                  

                </tbody>
            ';
}
$update_document_sql = "UPDATE tbl_documents d inner join tbl_ledger l on l.docno = d.docno set d.print = :print WHERE creator = :origin and l.txndate between '$date_from' and '$date_to' and l.status in ('FORWARDED','CREATED') and l.origin = '$department'";
            
                    
$update_data = $con->prepare($update_document_sql);
$update_data->execute([
    ':print'            => $print,
    ':origin'           => $origin
    
   
    ]);
    }





}elseif ($origin =="Please select..."){
    if ($type !="Please select..."){


        $get_document_sql = "SELECT DISTINCT * FROM tbl_documents d inner join tbl_ledger l on l.docno = d.docno WHERE d.type = :type and l.txndate between '$date_from' and '$date_to' and l.status in ('FORWARDED','CREATED') and l.origin = '$department' and d.print = 0 order by d.docno";
        $get_document_data = $con->prepare($get_document_sql);
        $get_document_data->execute([':type'=>$type]);

        while ($result = $get_document_data->fetch(PDO::FETCH_ASSOC)) {

    // $fullname = ucfirst($result['first_name']) . ' ' . ucwords($result['middle_name']) . ' ' . ucfirst($result['last_name']);
    // $email = $result['email'];
    // $contact_number = $result['contact_number'];
        $docno = $result['docno'];
        $creator = $result['creator'];
        $destination = $result['destination'];
        $receiver = $result['receiver'];
        $particulars = $result['particulars'];
        $date = $result['txndate'];
        $time = $result['time'];
        $action = $result['status'];
        $remarks = $result['remarks'];





    $html .= '

   

                <tbody>
                    <tr>
                    <td>'. $docno .'</td>
                    <td>'. $creator .'</td>
                    <td>'. $destination .'</td>
                    <td>'. $particulars .'</td>
                    <td></td>
                    <td></td>
                    </tr>

                    
                   
                  

                </tbody>
            ';
}
$update_document_sql = "UPDATE tbl_documents d inner join tbl_ledger l on l.docno = d.docno set d.print = :print WHERE d.type = :type and l.txndate between '$date_from' and '$date_to' and l.status in ('FORWARDED','CREATED') and l.origin = '$department'";
          
$update_data = $con->prepare($update_document_sql);
$update_data->execute([
    ':print'            => $print,
    ':type'             => $type,
    
    
   
    ]);

    } if ($type =="Please select..."){


        $get_document_sql = "SELECT DISTINCT * FROM tbl_documents d inner join tbl_ledger l on l.docno = d.docno  WHERE l.txndate between '$date_from' and '$date_to' and l.status in ('FORWARDED','CREATED') and l.origin = '$department' and d.print = 0 order by d.docno";
        $get_document_data = $con->prepare($get_document_sql);
        $get_document_data->execute();

        while ($result = $get_document_data->fetch(PDO::FETCH_ASSOC)) {

    // $fullname = ucfirst($result['first_name']) . ' ' . ucwords($result['middle_name']) . ' ' . ucfirst($result['last_name']);
    // $email = $result['email'];
    // $contact_number = $result['contact_number'];
        $docno = $result['docno'];
        $creator = $result['creator'];
        $destination = $result['destination'];
        $receiver = $result['receiver'];
        $particulars = $result['particulars'];
        $date = $result['txndate'];
        $time = $result['time'];
        $action = $result['status'];
        $remarks = $result['remarks'];





    $html .= '

   

                <tbody>
                    <tr>
                    <td>'. $docno .'</td>
                    <td>'. $creator .'</td>
                    <td>'. $destination .'</td>
                    <td>'. $particulars .'</td>
                    <td></td>
                    <td></td>
                    </tr>

                    
                   
                  

                </tbody>
            ';
}
$update_document_sql = "UPDATE tbl_documents d inner join tbl_ledger l on l.docno = d.docno set d.print = :print WHERE l.txndate between '$date_from' and '$date_to' and l.status in ('FORWARDED','CREATED') and l.origin = '$department'";
$update_data = $con->prepare($update_document_sql);
$update_data->execute([
    ':print'            => $print,
 
    
   
    ]);
    }
 
}


$html .= '</table>';

$html .=  '<h4>Prepared by: </h4>';
  
$html .=  '<h3>'. $username.'</h3';  


$pdf->writeHTML($html, true, false, true, false, '');
    


$pdf->lastPage();

ob_end_clean();

$pdf->Output('Plain.pdf', 'I');




