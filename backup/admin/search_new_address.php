<?php
include('../config/db_config.php');
session_start();
$columns = array(
    // datatable column index  => database column name
    0 =>  'id',
    1 => 'company_name',
    2 => 'company_description',


);


$requestData = $_REQUEST;


$get_employee_sql = "SELECT * FROM tbl_company where status ='ACTIVE' ORDER BY id DESC";

$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(id) as id from tbl_company";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_new_address.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT * FROM tbl_company where";

if (!empty($requestData['search']['value'])) {
    $getAllIndividual .= " (company_name LIKE '%" . $requestData['search']['value'] . "%'";
    $getAllIndividual .= " OR company_description LIKE '%" . $requestData['search']['value'] . "%') ";

    $getAllIndividual .= " ORDER BY id DESC";
    $getIndividualData = $con->prepare($getAllIndividual);
    $getIndividualData->execute();



    $countfilter = "SELECT * FROM tbl_company where ";
    $countfilter .= " (id LIKE '%" . $requestData['search']['value'] . "%'";
    $countfilter .= " OR company_name LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR company_description LIKE '%" . $requestData['search']['value'] . "%') ";
    $countfilter .= "LIMIT 20";

    $getrecordstmt = $con->prepare($countfilter);
    $getrecordstmt->execute() or die("search_new_address.php");
    $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
    $totalData = $getrecord['id'];
    $totalFiltered = $totalData;
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();

    $nestedData[] = '<div style="text-align:center;">' . $row["id"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["company_name"] . '</div>';
     $nestedData[] = '<div style="text-align:center;">' . $row["company_description"] . '</div>';
  



    $data[] = $nestedData;
}
$json_data = array(
    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

