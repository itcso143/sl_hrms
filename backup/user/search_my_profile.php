<?php
include('../config/db_config.php');
session_start();


    $user_id = $_SESSION['id'];
    $get_user_sql = "SELECT * FROM tbl_users where id = :id ";
    $user_data = $con->prepare($get_user_sql);
    $user_data->execute([':id' => $user_id]);
    while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
    
    
     
      $emp_id = $result['emp_id'];

    }
    
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$get_employee_sql = "SELECT emp_id,datecreate,firstname,middlename,lastname,suffix,address FROM tbl_employee_info where emp_id='$emp_id' ";

$getIndividualData = $con->prepare($get_employee_sql);
$getIndividualData->execute();                   

$countNoFilter = "SELECT COUNT(id) as id from tbl_employee_info";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_employee.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;  
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT emp_id,firstname,middlename,lastname,suffix FROM tbl_employee_info where";
             
     if( !empty($requestData['search']['value']) ) {
        $getAllIndividual.=" (id LIKE '%".$requestData['search']['value']."%'";
        $getAllIndividual.=" OR emp_id LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR lastname LIKE '%".$requestData['search']['value']."%') ";

        $getAllIndividual.=" ORDER BY id DESC";
        $getIndividualData = $con->prepare($getAllIndividual);
        $getIndividualData->execute(); 



        $countfilter = "SELECT emp_id,firstname,middlename,lastname,suffix FROM tbl_employee_info where ";
       $countfilter.=" (id LIKE '%".$requestData['search']['value']."%'";
       $countfilter.=" OR emp_id LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR lastname LIKE '%".$requestData['search']['value']."%') ";
       $countfilter.="LIMIT 20" ;

        $getrecordstmt = $con->prepare($countfilter);
        $getrecordstmt->execute() or die("search_employee.php");
        $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
        $totalData = $getrecord['id'];
        $totalFiltered = $totalData;
     }

     $data = array();

	while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["emp_id"];
    $nestedData[] = $row["datecreate"];
    $nestedData[] = $row["firstname"]. ' '.$row["middlename"].' '.$row["lastname"].' '.$row["suffix"];
    $nestedData[] = ucwords(strtoupper($row["address"]));


	// $nestedData[] = ucwords(strtolower($row["fullname"]));
	$data[] = $nestedData;
}
        $json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
    );

    echo json_encode($json_data);  // send data as json format





