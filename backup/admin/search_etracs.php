<?php
include('../config/db_etracs.php');

$columns = array(
  
    0 => 'entity_no',


);



$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$birthdate = $_POST['birthdate'];
$requestData = $_REQUEST;



$getAllIndividual = "SELECT t.objid,t.firstname,t.middlename,t.lastname,t.gender,t.birthdate,r.payer_objid,r.txndate,r.receiptno from entityindividual t
                    inner join cashreceipt r on r.payer_objid = t.objid  where t.lastname = '".$lastname."' and t.firstname = '".$firstname."' order by r.txndate desc limit 1  " ;

$getIndividualData = $con5->prepare($getAllIndividual);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(objid) AS id FROM entityindividual";
$getrecordstmt = $con5->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_etracs.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;




$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();

    $nestedData[] = $row["objid"];


    $nestedData[] = ucwords(strtoupper($row["firstname"]));
    $nestedData[] = ucwords(strtoupper($row["middlename"]));

    $nestedData[] = ucwords(strtoupper($row["lastname"]));
    $nestedData[] = ucwords(strtoupper($row["gender"]));
    $nestedData[] = ucwords(strtoupper($row["birthdate"]));
    $nestedData[] = ucwords(strtoupper($row["txndate"]) .' : CtcNo.'. ($row["receiptno"]));
   
    

    $data[] = $nestedData;
}
$json_data = array(
    "draw"            => intval($requestData['draw']),   
    "recordsTotal"    => intval($totalData),  
    "recordsFiltered" => intval($totalFiltered), 
    "data"            => $data  
);

echo json_encode($json_data);  
