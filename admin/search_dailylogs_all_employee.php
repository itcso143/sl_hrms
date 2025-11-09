<?php
include('../config/db_config.php');
session_start();
$columns = array(
    // datatable column index  => database column name
    0 =>  'date_logs',
    1 => 'emp_id',
    2 => 'fullname',
    3 => 'time_in',
    4 => 'time_out',
    5 => 'ot_time_in',
    6 => 'ot_time_out'

);

// $user_id = $_SESSION['id'];
// $get_user_sql = "SELECT * FROM tbl_users where id = :id ";
// $user_data = $con->prepare($get_user_sql);
// $user_data->execute([':id' => $user_id]);
// while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


//   $db_fullname = $result['fullname'];
//   $accountType = $result['account_type'];
//   $department = $result['department'];
// }

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$get_employee_sql = "SELECT t.date_logs,t.schedule_code,t.emp_id,t.punch_in,t.punch_out,t.late,t.work_hours,t.overtime_in,t.overtime_out,r.fullname FROM tbl_employee_timelogs t LEFT JOIN tbl_employee_info r on r.emp_id=t.emp_id order by t.id DESC";

$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(id) as id from tbl_employee_info";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_dailylogs_employee.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT emp_id,date_logs FROM tbl_employee_timelogs where";

if (!empty($requestData['search']['value'])) {
    $getAllIndividual .= " (emp_id LIKE '%" . $requestData['search']['value'] . "%'";
    $getAllIndividual .= " OR date_logs LIKE '%" . $requestData['search']['value'] . "%') ";

    $getAllIndividual .= " ORDER BY t.id DESC";
    $getIndividualData = $con->prepare($getAllIndividual);
    $getIndividualData->execute();



    $countfilter = "SELECT emp_id,date_logs FROM tbl_employee_timelogs where ";
    $countfilter .= " (emp_id LIKE '%" . $requestData['search']['value'] . "%'";
    $countfilter .= " OR date_logs LIKE '%" . $requestData['search']['value'] . "%') ";
    $countfilter .= "LIMIT 20";

    $getrecordstmt = $con->prepare($countfilter);
    $getrecordstmt->execute() or die("search_dailylogs_employee.php");
    $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
    $totalData = $getrecord['id'];
    $totalFiltered = $totalData;
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData[] = '<div style="text-align:center;">' . $row["emp_id"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . strtoupper($row["fullname"]) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . strtoupper($row["schedule_code"]) . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["date_logs"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["punch_in"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["punch_out"] . '</div>';
    $nestedData[] = '<div style="text-align:center; color:red;">' . $row["late"] . '</div>';
    // $nestedData[] = '<div style="text-align:center; color:blue;">' . $row["work_hours"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["overtime_in"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["overtime_out"] . '</div>';




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
