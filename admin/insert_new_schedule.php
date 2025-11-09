<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';

if (isset($_POST['insert_new_schedule'])) {

    $alert_msg = '';

    $schedule_code = $_POST['schedule_code'];
    $description   = $_POST['description'];

    // Convert HTML5 <input type="time"> to proper 24-hour time format
    $time_from = DateTime::createFromFormat('H:i', $_POST['time_from']);
    $time_to   = DateTime::createFromFormat('H:i', $_POST['time_to']);

    $time_from_str = $time_from->format('H:i:s'); // 24-hour format string
    $time_to_str   = $time_to->format('H:i:s');

    // ✅ Fixed SQL syntax
    $new_schedule_sql = "INSERT INTO tbl_schedule 
        SET schedule_code = :schedule_code,
            description   = :description,
            sched_in      = :sched_in,
            sched_out     = :sched_out";

    $new_schedule_data = $con->prepare($new_schedule_sql);
    $new_schedule_data->execute([
        ':schedule_code' => $schedule_code,
        ':description'   => $description,
        ':sched_in'      => $time_from_str,
        ':sched_out'     => $time_to_str
    ]);

    $alert_msg .= '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-check"></i>
            <strong> Success! </strong> Data Inserted.
        </div>';
}

 header('location: list_schedule.php?');
?>
