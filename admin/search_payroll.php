<?php
include('../config/db_config.php');
session_start();
$columns = array(
    // datatable column index  => database column name
    0 =>  'id',
    1 => 'fullname',
    2 => 'barangay',
    3 => 'photo'

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


$get_employee_sql = "SELECT * FROM tbl_weekly_payslip where status='ACTIVE' ORDER BY id DESC LIMIT 10";

$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(id) as id from tbl_weekly_payslip";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_payroll.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT * FROM tbl_weekly_payslip where status='ACTIVE' AND";

if (!empty($requestData['search']['value'])) {
    $getAllIndividual .= " (payroll_id LIKE '%" . $requestData['search']['value'] . "%'";
    $getAllIndividual .= " OR emp_id LIKE '%" . $requestData['search']['value'] . "%' ";
    $getAllIndividual .= " OR fullname_payroll LIKE '%" . $requestData['search']['value'] . "%' ";
   
    $getAllIndividual .= " OR datecreate_payroll LIKE '%" . $requestData['search']['value'] . "%') ";

    $getAllIndividual .= " ORDER BY id DESC";
    $getIndividualData = $con->prepare($getAllIndividual);
    $getIndividualData->execute();



    $countfilter = "SELECT * FROM tbl_weekly_payslip where status='ACTIVE' AND";
    $countfilter .= " (payroll_id LIKE '%" . $requestData['search']['value'] . "%'";
    $countfilter .= " OR emp_id LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR fullname_payroll LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR datecreate_payroll LIKE '%" . $requestData['search']['value'] . "%') ";
    $countfilter .= "LIMIT 20";

    $getrecordstmt = $con->prepare($countfilter);
    $getrecordstmt->execute() or die("search_payroll.php");
    $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
    $totalData = $getrecord['id'];
    $totalFiltered = $totalData;
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();

    $nestedData[] = '<div style="text-align:center;">' . $row["payroll_id"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["datecreate_payroll"] . '</div>';
     $nestedData[] = '<div style="text-align:center;">' . $row["date_from"] . '-' . $row["date_to"] .'</div>';
      $nestedData[] = '<div style="text-align:center;">' . $row["emp_id"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["fullname_payroll"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["daily_hours"] .'</div>';
     $nestedData[] = '<div style="text-align:center;">' . $row["total_emp_deduction"] .'</div>';
      $nestedData[] = '<div style="text-align:center;">' . $row["emp_total_netpay"] .'</div>';


    $data[] = $nestedData;
}
$json_data = array(
    "draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format








//     include('../config/db_config.php');
// session_start();
// $columns= array( 
//     // datatable column index  => database column name
//         0 =>  'id', 
//         1 => 'fullname',
//         2 => 'barangay',
//         3 => 'photo'

//     );

//     $user_id = $_SESSION['id'];
//     $get_user_sql = "SELECT * FROM tbl_users where id = :id ";
//     $user_data = $con->prepare($get_user_sql);
//     $user_data->execute([':id' => $user_id]);
//     while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


//       $db_fullname = $result['fullname'];
//       $accountType = $result['account_type'];
//       $department = $result['department'];
//     }

// // storing  request (ie, get/post) global array to a variable  
// $requestData= $_REQUEST;


// $getAllIndividual = "SELECT id,person_id,person_entityno,person_name,barangay,barangay_photo,person_address FROM view_clearance where punongbarangay_barangay = '".$department."'
//                      ORDER BY id DESC LIMIT ".$requestData['start']." ,".$requestData['length']."  ";

// $getIndividualData = $con->prepare($getAllIndividual);
// $getIndividualData->execute();                   

// $countNoFilter = "SELECT COUNT(id) as id from barangay_clearance";
// $getrecordstmt = $con->prepare($countNoFilter);
// $getrecordstmt->execute() or die("search_members.php");
// $getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
// $totalData = $getrecord['id'];

// $totalFiltered = $totalData;  
// // when there is no search parameter then total number rows = total number filtered rows.


// $getAllIndividual = "SELECT id,person_id,person_entityno,person_name,barangay,barangay_photo FROM view_clearance where punongbarangay_barangay = '".$department."' and";

//      if( !empty($requestData['search']['value']) ) {
//         $getAllIndividual.=" (id LIKE '%".$requestData['search']['value']."%'";
//         $getAllIndividual.=" OR person_id LIKE '%".$requestData['search']['value']."%' ";
//         $getAllIndividual.=" OR person_entityno LIKE '%".$requestData['search']['value']."%' ";
//         $getAllIndividual.=" OR person_name LIKE '%".$requestData['search']['value']."%' ";
//         $getAllIndividual.=" OR barangay LIKE '%".$requestData['search']['value']."%') ";

//         $getAllIndividual.=" ORDER BY id DESC LIMIT ".$requestData['start']." ,".$requestData['length']."  ";
//         $getIndividualData = $con->prepare($getAllIndividual);
//         $getIndividualData->execute(); 



//         $countfilter = "SELECT id,person_id,person_entityno,person_name,barangay,barangay_photo FROM view_clearance where punongbarangay_barangay = '".$department."' and";
//        $countfilter.=" (id LIKE '%".$requestData['search']['value']."%'";
//        $countfilter.=" OR person_id LIKE '%".$requestData['search']['value']."%' ";
//        $countfilter.=" OR person_entityno LIKE '%".$requestData['search']['value']."%' ";
//        $countfilter.=" OR person_name LIKE '%".$requestData['search']['value']."%' ";
//        $countfilter.=" OR barangay LIKE '%".$requestData['search']['value']."%') ";
//        $countfilter.="LIMIT ".$requestData['length']." " ;

//         $getrecordstmt = $con->prepare($countfilter);
//         $getrecordstmt->execute() or die("search_members.php");
//         $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
//         $totalData = $getrecord['id'];
//         $totalFiltered = $totalData;
//      }

//      $data = array();

// 	while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)){
// 	$nestedData=array(); 

// 	$nestedData[] = $row["id"];
//     $nestedData[] = $row["person_entityno"];
//     $nestedData[] = ucwords(strtoupper($row["person_name"]));
//     $nestedData[] = ucwords(strtoupper($row["person_address"]));
//     $nestedData[] = $row["barangay"];
//     $nestedData[] = $row["barangay_photo"];
// 	// $nestedData[] = ucwords(strtolower($row["fullname"]));
// 	$data[] = $nestedData;
// }
//         $json_data = array(
//     "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
//     "recordsTotal"    => intval( $totalData ),  // total number of records
//     "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
//     "data"            => $data   // total data array
//     );

//     echo json_encode($json_data);  // send data as json format
