<?php
include('../config/db_config.php');
if (isset($_POST['objid'])) {
    $objid =   $_POST['objid'];
    $date_from =  date('Y-m-d', strtotime($_POST['date_from']));
    $date_to =    date('Y-m-d', strtotime($_POST['date_to']));


    $get_all_history_sql = "SELECT t.objidmas,t.id,t.datepayment,t.ornomas,t.amountmas from masdailypayment t inner join registration r on r.objid = t.id WHERE t.id = '" . $objid . "' AND t.status = 'ACTIVE' AND t.datepayment between '" . $date_from . "' and '" . $date_to . "'";


    $get_all_history_data = $con->prepare($get_all_history_sql);
    $get_all_history_data->execute();
 

    while ($list_history = $get_all_history_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo $list_history['objidmas'];
        echo "</td>";
        echo "<td>";
        echo $list_history['datepayment'];
        echo "</td>";
        echo "<td>";
        echo $list_history['ornomas'];
        echo "</td>";
        echo "<td>";
        echo $list_history['amountmas'];
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-danger delete_dailypayment btn-sm' data-placement='top' id='delete_payment' name='delete_payment' title='Delete Record'><i class='fa fa-trash-o'></i></button>";
        
        echo "</td>";
        echo "</tr>";
    }




}




?>
