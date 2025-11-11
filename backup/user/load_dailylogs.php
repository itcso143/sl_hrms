<?php
include('../config/db_config.php');
if (isset($_POST['emp_id'])) {
    $emp_id =   $_POST['emp_id'];
    // $date_from =  date('Y-m-d', strtotime($_POST['date_from']));
    // $date_to =    date('Y-m-d', strtotime($_POST['date_to']));


    $get_all_employeelogs_sql = "SELECT emp_id,date_logs,punch_in,punch_out FROM tbl_employee_timelogs WHERE emp_id = '" . $emp_id . "' order by id DESC";


    $get_all_employeelogs_data = $con->prepare($get_all_employeelogs_sql);
    $get_all_employeelogs_data->execute();
 

    while ($list_history = $get_all_employeelogs_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo $list_history['emp_id'];
        echo "</td>";
        echo "<td>";
        echo $list_history['date_logs'];
        echo "</td>";
        echo "<td>";
        echo $list_history['punch_in'];
        echo "</td>";
        echo "<td>";
        echo $list_history['punch_out'];
        echo "</td>";
        echo "<td>";
     
        echo "</tr>";
    }




}




?>
