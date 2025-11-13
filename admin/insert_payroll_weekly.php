<?php
include('../config/db_config.php');
session_start();

date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

if (isset($_POST['insert_payroll_weekly'])) {

    // Collect form data safely
    $serial_no = 'PS-' . uniqid();
    $emp_id5       = $_POST['emp_id5'] ?? '';
    $emp_fullname  = $_POST['emp_fullname'] ?? '';
    $payroll_id    = uniqid('PAYWEEKLY-');
    $datecreate_payroll = $date;
    $date_from  = $_POST['date_from'] ?? '';
    $date_to  = $_POST['date_to'] ?? '';
    $daily_hours  = $_POST['daily_hours'] ?? '';
    $payroll_gross  = $_POST['payroll_gross'] ?? '';
    $total_emp_deduction  = $_POST['total_emp_deduction'] ?? '';
    $emp_total_netpay  = $_POST['emp_total_netpay'] ?? '';

    $emp_late_deduction = $_POST['emp_late_deduction'];
    $emp_quantity_late = $_POST['emp_quantity_late'];
    $emp_rate_late = $_POST['emp_rate_late'];
    $emp_total_late = $_POST['emp_total_late'];

    $emp_absences_deduction = $_POST['emp_absences_deduction'];
    $emp_quantity_absences = $_POST['emp_quantity_absences'];
    $emp_rate_absences = $_POST['emp_rate_absences'];
    $emp_total_absences = $_POST['emp_total_absences'];

    $emp_hrmo_deduction = $_POST['emp_hrmo_deduction'];
    $emp_hrmo_quantity = $_POST['emp_hrmo_quantity'];
    $emp_hrmo_rate = $_POST['emp_hrmo_rate'];
    $emp_hrmo_total = $_POST['emp_hrmo_total'];


    $emp_ot_additional = $_POST['emp_ot_additional'];
    $emp_ot_quantity = $_POST['emp_ot_quantity'];
    $emp_ot_rate = $_POST['emp_ot_rate'];
    $emp_ot_total = $_POST['emp_ot_total'];

    $emp_bonus_additional = $_POST['emp_bonus_additional'];
    $emp_bonus_quantity = $_POST['emp_bonus_quantity'];
    $emp_bonus_rate = $_POST['emp_bonus_rate'];
    $emp_bonus_total = $_POST['emp_bonus_total'];


    $company  = $_POST['get_company'] ?? '';


    // ✅ Use proper INSERT INTO syntax
    $insert_payroll_weekly_sql = "
        INSERT INTO tbl_weekly_payslip (
            emp_id,
            datecreate_payroll,
            payroll_id,
            fullname_payroll,
            company,
            date_from,
            date_to,
            daily_hours,
            payroll_gross,
            total_emp_deduction,
            emp_total_netpay,
            serial_no,
      emp_late_deduction, emp_quantity_late, emp_rate_late, emp_total_late,
      emp_absences_deduction, emp_quantity_absences, emp_rate_absences, emp_total_absences,
       emp_hrmo_deduction, emp_hrmo_quantity, emp_hrmo_rate, emp_hrmo_total, emp_ot_additional,
       emp_ot_quantity,emp_ot_rate,emp_ot_total,emp_bonus_additional,emp_bonus_quantity,emp_bonus_rate,
       emp_bonus_total

           
        ) VALUES (
            :emp_id,
            :datecreate_payroll,
            :payroll_id,
            :fullname_payroll,
             :company,
            :date_from,
            :date_to,
            :daily_hours,
            :payroll_gross,
            :total_emp_deduction,
            :emp_total_netpay, :serial_no
      , :emp_late_deduction, :emp_quantity_late, :emp_rate_late, :emp_total_late,
      :emp_absences_deduction, :emp_quantity_absences, :emp_rate_absences, :emp_total_absences,
       :emp_hrmo_deduction, :emp_hrmo_quantity, :emp_hrmo_rate, :emp_hrmo_total, :emp_ot_additional,
       :emp_ot_quantity, :emp_ot_rate, :emp_ot_total, :emp_bonus_additional, :emp_bonus_quantity,
       :emp_bonus_rate, :emp_bonus_total)";

    $stmt = $con->prepare($insert_payroll_weekly_sql);

    // ✅ Bind parameters correctly (same as placeholders)
    $execute_success = $stmt->execute([
        ':emp_id'             => $emp_id5,
        ':datecreate_payroll' => $datecreate_payroll,
        ':payroll_id'         => $payroll_id,
        ':fullname_payroll'   => $emp_fullname,
        ':company'   => $company,
        ':date_from'          => $_POST['date_from'] ?? '',
        ':date_to'            => $_POST['date_to'] ?? '',
        ':daily_hours'        => $_POST['daily_hours'] ?? '',
        ':payroll_gross'      => number_format($payroll_gross, 2),
        ':total_emp_deduction' => number_format($total_emp_deduction, 2),
        ':emp_total_netpay'   => number_format($emp_total_netpay, 2),

        ':serial_no'     => $serial_no,
        ':emp_late_deduction'     => $emp_late_deduction,
        ':emp_quantity_late'     => $emp_quantity_late,
        ':emp_rate_late' => number_format($emp_rate_late, 2),

        ':emp_total_late' => number_format($emp_total_late, 2),

        ':emp_absences_deduction'     => $emp_absences_deduction,
        ':emp_quantity_absences'     => $emp_quantity_absences,
        ':emp_rate_absences' => number_format($emp_rate_absences, 2),

        ':emp_total_absences' => number_format($emp_total_absences, 2),


        ':emp_hrmo_deduction'     => $emp_hrmo_deduction,
        ':emp_hrmo_quantity'     => $emp_hrmo_quantity,
        ':emp_hrmo_rate' => number_format($emp_hrmo_rate, 2),
        ':emp_hrmo_total' => number_format($emp_hrmo_total, 2),

        ':emp_ot_additional'     => $emp_ot_additional,
        ':emp_ot_quantity'     => $emp_ot_quantity,
        ':emp_ot_rate' => number_format($emp_ot_rate, 2),
        ':emp_ot_total' => number_format($emp_ot_total, 2),

        ':emp_bonus_additional'     => $emp_bonus_additional,
        ':emp_bonus_quantity'     => $emp_bonus_quantity,
        ':emp_bonus_rate' => number_format($emp_bonus_rate, 2),
        ':emp_bonus_total' => number_format($emp_bonus_total, 2)



    ]);

    // ✅ Check if execution was successful
    if ($execute_success) {
        $_SESSION['status'] = "Added Successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Insert Failed!";
        $_SESSION['status_code'] = "error";
    }

    header('Location: list_weekly_payslip.php');
    exit;
}
