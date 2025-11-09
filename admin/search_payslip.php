<?php
include('../config/db_config.php');

$columns = array(

    0 => 'emp_id',


);



$emp_id = $_POST['emp_id'];

$requestData = $_REQUEST;



$getAllIndividual = "SELECT * FROM tbl_emp_salary where emp_id_salary = '$emp_id' AND status='ACTIVE' ORDER BY id desc ";;

$getIndividualData = $con->prepare($getAllIndividual);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(id) AS id FROM tbl_emp_salary";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_payslip.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;




$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();

    $nestedData[] = $row["id"];

    $nestedData[] = ucwords(strtoupper($row["salary_id"]));
    $nestedData[] = ucwords(strtoupper($row["emp_id_salary"]));
    $nestedData[] = ucwords(strtoupper($row["date_create_salary"]));

    $nestedData[] = ucwords(strtoupper($row["date_from"] . ' to ' . $row["date_to"]));
   
    $nestedData[] = ucwords(strtoupper($row["emp_total"]));
    $nestedData[] = ucwords(strtoupper($row["emp_gross_pay"]));
    $nestedData[] = ucwords(strtoupper($row["emp_current_pay"]));




    $data[] = $nestedData;
}
$json_data = array(
    "draw"            => intval($requestData['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
);

echo json_encode($json_data);
