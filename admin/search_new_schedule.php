<?php
include('../config/db_config.php');
session_start();
$columns = array(
    // datatable column index  => database column name
    0 =>  'id',
    1 => 'schedule_code',
    2 => 'description',


);


$requestData = $_REQUEST;


$get_employee_sql = "SELECT * FROM tbl_schedule where status ='ACTIVE' ORDER BY id DESC";

$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();

$countNoFilter = "SELECT COUNT(id) as id from tbl_schedule";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_new_schedule.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT id,schedule_code,description FROM tbl_schedule where";

if (!empty($requestData['search']['value'])) {
    $getAllIndividual .= " (schedule_code LIKE '%" . $requestData['search']['value'] . "%'";
    $getAllIndividual .= " OR description LIKE '%" . $requestData['search']['value'] . "%') ";

    $getAllIndividual .= " ORDER BY id DESC";
    $getIndividualData = $con->prepare($getAllIndividual);
    $getIndividualData->execute();



    $countfilter = "SELECT id,schedule_code,description FROM tbl_schedule where ";
    $countfilter .= " (id LIKE '%" . $requestData['search']['value'] . "%'";
    $countfilter .= " OR schedule_code LIKE '%" . $requestData['search']['value'] . "%' ";
    $countfilter .= " OR description LIKE '%" . $requestData['search']['value'] . "%') ";
    $countfilter .= "LIMIT 20";

    $getrecordstmt = $con->prepare($countfilter);
    $getrecordstmt->execute() or die("search_new_schedule.php");
    $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
    $totalData = $getrecord['id'];
    $totalFiltered = $totalData;
}

$data = array();

while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)) {
    $nestedData = array();

    $nestedData[] = '<div style="text-align:center;">' . $row["schedule_code"] . '</div>';
    $nestedData[] = '<div style="text-align:center;">' . $row["description"] . '</div>';
     $nestedData[] = '<div style="text-align:center;">' . $row["sched_in"] . '</div>';
      $nestedData[] = '<div style="text-align:center;">' . $row["sched_out"] . '</div>';



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
