<?php
include('../config/db_config.php');

$columns = array(

    0 => 'emp_id',


);





$requestData = $_REQUEST;



$requestData = $_REQUEST;


$get_employee_sql = "SELECT * FROM tbl_emp_salary where status='ACTIVE' ORDER BY id DESC LIMIT 10";

$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(id) as id from tbl_emp_salary";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_monthly_payslip.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT * FROM tbl_emp_salary where status='ACTIVE' AND";

if (!empty($requestData['search']['value'])) {
    $getAllIndividual .= " (id LIKE '%" . $requestData['search']['value'] . "%'";
    $getAllIndividual .= " OR salary_id LIKE '%" . $requestData['search']['value'] . "%' ";
    $getAllIndividual .= " OR emp_id_salary LIKE '%" . $requestData['search']['value'] . "%' ";
    $getAllIndividual .= " OR fullname_salary LIKE '%" . $requestData['search']['value'] . "%') ";

    $getAllIndividual .= " ORDER BY id DESC";
    $getIndividualData = $con->prepare($getAllIndividual);
    $getIndividualData->execute();



    $countfilter = "SELECT * FROM tbl_emp_salary where status='ACTIVE' AND";
    $countfilter .= " (id LIKE '%" . $requestData['search']['value'] . "%'";
    $countfilter .= " OR salary_id LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR emp_id_salary LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR fullname_salary LIKE '%" . $requestData['search']['value'] . "%') ";
    $countfilter .= "LIMIT 20";

    $getrecordstmt = $con->prepare($countfilter);
    $getrecordstmt->execute() or die("search_monthly_payslip.php");
    $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
    $totalData = $getrecord['id'];
    $totalFiltered = $totalData;
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();


    // $nestedData[] = $row["id"];

    $nestedData[] = ucwords(strtoupper($row["salary_id"]));
    $nestedData[] = ucwords(strtoupper($row["emp_id_salary"]));
    $nestedData[] = ucwords(strtoupper($row["date_create_salary"]));

    $nestedData[] = ucwords(strtoupper($row["date_from"] . ' to ' . $row["date_to"]));
   $nestedData[] = ucwords(strtoupper($row["fullname_salary"]));
    $nestedData[] = ucwords(strtoupper($row["emp_basic_salary"]));
    $nestedData[] = ucwords(strtoupper($row["emp_gross_pay"]));
    $nestedData[] = ucwords(strtoupper($row["emp_current_pay"]));

    $data[] = $nestedData;
}
$json_data = array(
    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format


// $getAllIndividual = "SELECT * FROM tbl_emp_salary where status='ACTIVE' ORDER BY id desc ";;

// $getIndividualData = $con->prepare($getAllIndividual);
// $getIndividualData->execute();

// $countNoFilter = "SELECT COUNT(id) AS id FROM tbl_emp_salary";
// $getrecordstmt = $con->prepare($countNoFilter);
// $getrecordstmt->execute() or die("search_payslip.php");
// $getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
// $totalData = $getrecord['id'];

// $totalFiltered = $totalData;




// $data = array();
// // while( $row=mysqli_fetch_array($query) ) {  // preparing an array
// while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
//     $nestedData = array();

//     $nestedData[] = $row["id"];

//     $nestedData[] = ucwords(strtoupper($row["salary_id"]));
//     $nestedData[] = ucwords(strtoupper($row["emp_id_salary"]));
//     $nestedData[] = ucwords(strtoupper($row["date_create_salary"]));

//     $nestedData[] = ucwords(strtoupper($row["date_from"] . ' to ' . $row["date_to"]));
   
//     $nestedData[] = ucwords(strtoupper($row["emp_basic_salary"]));
//     $nestedData[] = ucwords(strtoupper($row["emp_gross_pay"]));
//     $nestedData[] = ucwords(strtoupper($row["emp_current_pay"]));




//     $data[] = $nestedData;
// }
// $json_data = array(
//     "draw"            => intval($requestData['draw']),
//     "recordsTotal"    => intval($totalData),
//     "recordsFiltered" => intval($totalFiltered),
//     "data"            => $data
// );

// echo json_encode($json_data);
