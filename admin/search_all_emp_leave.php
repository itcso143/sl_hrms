<?php
include('../config/db_config.php');
session_start();


// $user_id = $_SESSION['id'];
// $get_user_sql = "SELECT * FROM tbl_users where id = :id ";
// $user_data = $con->prepare($get_user_sql);
// $user_data->execute([':id' => $user_id]);
// while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {



//     $emp_id = $result['emp_id'];
// }

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$get_employee_sql = "SELECT id,emp_id,date_create,fullname,leave_code,date_from,date_to,status_leave,leave_reason,attached_file,leave_credits FROM tbl_employee_leave_profile ORDER BY id DESC";

$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(id) as id from tbl_employee_leave_profile";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_emp_leave.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT emp_id,date_create,fullname FROM tbl_employee_leave_profile where";

if (!empty($requestData['search']['value'])) {
    $getAllIndividual .= " (emp_id LIKE '%" . $requestData['search']['value'] . "%'";
    $getAllIndividual .= " OR date_create LIKE '%" . $requestData['search']['value'] . "%' ";
    $getAllIndividual .= " OR fullname LIKE '%" . $requestData['search']['value'] . "%') ";

    $getAllIndividual .= " ORDER BY id DESC";
    $getIndividualData = $con->prepare($getAllIndividual);
    $getIndividualData->execute();



    $countfilter = "SELECT emp_id,date_create,fullname FROM tbl_employee_leave_profile where ";
    $countfilter .= " (emp_id LIKE '%" . $requestData['search']['value'] . "%'";
    $countfilter .= " OR date_create LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR fullname LIKE '%" . $requestData['search']['value'] . "%') ";
    $countfilter .= "LIMIT 20";

    $getrecordstmt = $con->prepare($countfilter);
    $getrecordstmt->execute() or die("search_emp_leave.php");
    $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
    $totalData = $getrecord['id'];
    $totalFiltered = $totalData;
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();
    $nestedData[] = $row["id"];
    $nestedData[] = $row["emp_id"];
    $nestedData[] = $row["date_create"];
    $nestedData[] = $row["fullname"];
    $nestedData[] = $row["leave_code"];
    $nestedData[] = $row["date_from"];
    $nestedData[] =  $row["date_to"];
    $nestedData[] =  $row["leave_reason"];
    $file = $row["attached_file"];

    if (!empty($file)) {
        $downloadLink = '<a href="../attached_file_leave/' . $file . '" download>Download</a>';
    } else {
        $downloadLink = 'No File';
    }
    $nestedData[] = $downloadLink;
    $nestedData[] =  $row["leave_credits"];
    $status = $row["status_leave"];

    if ($status == "PENDING") {
        $status_display = '<span style="color: blue;">' . $status . '</span>';
    } elseif ($status == "APPROVED") {
        $status_display = '<span style="color: green;">' . $status . '</span>';
    } elseif ($status == "DISAPPROVED") {
        $status_display = '<span style="color: red;">' . $status . '</span>';
    } else {
        $status_display = $status; // default color
    }

    $nestedData[] = $status_display;



    // $nestedData[] = ucwords(strtolower($row["fullname"]));
    $data[] = $nestedData;
}
$json_data = array(
    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
