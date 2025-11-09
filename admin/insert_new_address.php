<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';

if (isset($_POST['insert_new_address'])) {

    $alert_msg = '';

    $company_name = $_POST['company_name'];
    $company_description   = $_POST['company_description'];



    // ✅ Fixed SQL syntax
    $new_schedule_sql = "INSERT INTO tbl_company 
        SET company_name = :company_name,
            company_description   = :company_description";

    $new_schedule_data = $con->prepare($new_schedule_sql);
    $new_schedule_data->execute([
        ':company_name' => $company_name,
        ':company_description'   => $company_description
    
    ]);

    $alert_msg .= '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-check"></i>
            <strong> Success! </strong> Data Inserted.
        </div>';
}

header('location: list_address.php?');
