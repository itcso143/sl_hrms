<?php
include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['create_employee_salary'])) {

    // Validate input
    if (!empty($_POST['emp_id_salary'])) {
        $salary_id = 'SAL-' . uniqid();
        $serial_no = 'PS-' . uniqid();
        $date_create_salary = $_POST['date_create_salary'];
        $emp_id_salary = $_POST['emp_id_salary'];
        $fullname_salary = $_POST['fullname_salary'];

        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];

        $get_company = $_POST['get_company'];


        $emp_basic_salary = $_POST['emp_basic_salary'];
        $emp_quantity = $_POST['emp_quantity'];
        $emp_rate = $_POST['emp_rate'];
        $emp_total = $_POST['emp_total'];
        $emp_gross_pay = $_POST['emp_gross_pay'];
        $emp_current_pay = $_POST['emp_current_pay'];

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


        // Update only the schedule_code for the employee
        $employee_sql = "INSERT INTO tbl_emp_salary 
    (salary_id,date_create_salary, fullname_salary, date_from, date_to,company,
     emp_basic_salary, emp_quantity,
      emp_rate, emp_total, emp_gross_pay, emp_current_pay, emp_id_salary, serial_no,
      emp_late_deduction, emp_quantity_late, emp_rate_late, emp_total_late,
      emp_absences_deduction, emp_quantity_absences, emp_rate_absences, emp_total_absences,
       emp_hrmo_deduction, emp_hrmo_quantity, emp_hrmo_rate, emp_hrmo_total, emp_ot_additional,
       emp_ot_quantity,emp_ot_rate,emp_ot_total,emp_bonus_additional,emp_bonus_quantity,emp_bonus_rate,
       emp_bonus_total)
    VALUES 
    (:salary_id,:date_create_salary, :fullname_salary, :date_from,
     :date_to, :company,  :emp_basic_salary, :emp_quantity, :emp_rate,
      :emp_total, :emp_gross_pay, :emp_current_pay, :emp_id_salary, :serial_no
      , :emp_late_deduction, :emp_quantity_late, :emp_rate_late, :emp_total_late,
      :emp_absences_deduction, :emp_quantity_absences, :emp_rate_absences, :emp_total_absences,
       :emp_hrmo_deduction, :emp_hrmo_quantity, :emp_hrmo_rate, :emp_hrmo_total,
        :emp_ot_additional,
       :emp_ot_quantity, :emp_ot_rate, :emp_ot_total, :emp_bonus_additional, :emp_bonus_quantity,
       :emp_bonus_rate, :emp_bonus_total)";

        $employee_data = $con->prepare($employee_sql);
        $employee_data->execute([
            ':salary_id' => $salary_id,
            ':date_create_salary' => $date_create_salary,
            ':fullname_salary'   => $fullname_salary,
            ':date_from'         => $date_from,
            ':date_to'           => $date_to,
            ':company'           => $get_company,

            ':emp_basic_salary'  => $emp_basic_salary,
            ':emp_quantity'      => $emp_quantity,

            ':emp_rate' => number_format($emp_rate, 2),
            ':emp_total' => number_format($emp_total, 2),

            ':emp_gross_pay' => number_format($emp_gross_pay, 2),

            ':emp_current_pay' => number_format($emp_current_pay, 2),

            ':emp_id_salary'     => $emp_id_salary,
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


        // Check if any rows were affected
        if ($employee_data->rowCount() > 0) {
            $_SESSION['status'] = "Created Successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "No changes made or employee not found.";
            $_SESSION['status_code'] = "info";
        }
    } else {
        $_SESSION['status'] = "Missing employee ID or schedule code.";
        $_SESSION['status_code'] = "error";
    }
    header('Location: list_employee.php');
    // header('Location: ../plugins/TCPDF/User/pay_slip.php?' . 'salary_id=' . $salary_id);
    exit();
}
