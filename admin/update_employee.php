<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');

session_start();

if (isset($_POST['update_employee'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    //insert to tbl_individual

    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $date_joining = date('Y-m-d', strtotime($_POST['date_joining']));
    $emp_id_new = $_POST['emp_id_new'];

    $fullname = $_POST['firstname'] . ' ' . $_POST['middlename'] . ' ' . $_POST['lastname'] . ' ' . $_POST['suffix'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $suffix = $_POST['suffix'];

    $birthdate = date('Y-m-d', strtotime($_POST['birthdate']));

    $gender = $_POST['gender'];
    $civilstatus = $_POST['civilstatus'];
    $address = $_POST['address'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $country = $_POST['country'];
    $nationality = $_POST['nationality'];
    $email_address = $_POST['email_address'];
    $mobile_no = $_POST['mobile_no'];
    $telephone_no = $_POST['telephone_no'];

    $identification = $_POST['identification'];
    $identification_no = $_POST['identification_no'];

    $employee_type = $_POST['employee_type'];
    $department = $_POST['department'];

    $designation = $_POST['designation'];
    $date_joining = $_POST['date_joining'];

    $blood_type = $_POST['blood_type'];

    $bank_name = $_POST['bank_name'];
    $bank_no = $_POST['bank_no'];
    $bank_account_type = $_POST['bank_account_type'];
    $bank_holder_name = $_POST['bank_holder_name'];

    $ifsc_code = $_POST['ifsc_code'];

    $tin_no = $_POST['tin_no'];
    $sss = $_POST['sss'];
    $philhealth = $_POST['philhealth'];
    $pag_ibig = $_POST['pag_ibig'];

    $emergency_name = $_POST['emergency_name'];
    $emergency_relationship = $_POST['emergency_relationship'];
    $emergency_contact_no = $_POST['emergency_contact_no'];
    $net_pay = $_POST['net_pay'];
    $weekly_salary = $_POST['weekly_salary'];





    // $statusreg = 'ACTIVE';
    $img = $_POST['image'];


    if (!empty($_POST['image'])) {

        // Get base64 image from POST
        $img = $_POST['image'];

        // Folder where photos are stored
        $folderPath = "C:/xampp/htdocs/sl_hrms/photo/";

        // 🔹 Get the current photo filename from DB
        $stmt = $con->prepare("SELECT photo FROM tbl_employee_info WHERE emp_id = :emp_id");
        $stmt->execute([':emp_id' => $emp_id_new]);
        $oldPhoto = $stmt->fetchColumn();

        // 🔹 If old photo exists and it's not the default image, delete it
        if ($oldPhoto && file_exists($folderPath . $oldPhoto) && $oldPhoto != 'default.jpg') {
            unlink($folderPath . $oldPhoto);
        }

        // 🔹 Process the new image upload
        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpg';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        // 🔹 Update database with new filename
        $update_photo_sql = "UPDATE tbl_employee_info 
                         SET photo = :photo 
                         WHERE emp_id = :emp_id";
        $photo_data = $con->prepare($update_photo_sql);
        $photo_data->execute([
            ':emp_id' => $emp_id_new,
            ':photo'  => $fileName
        ]);
    }


    $employee_sql = "UPDATE tbl_employee_info SET 
    datecreate               = :date_register,
    fullname                 = :fullname,
    firstname                = :firstname,
    middlename               = :middlename,
    lastname                 = :lastname,
    suffix                   = :suffix,
    gender                   = :gender,
    birthdate                = :birthdate,
    civilstatus              = :civilstatus,
    address                  = :address,
    barangay                 = :barangay,
    city                     = :city,
    province                 = :province,
    country                  = :country,
    nationality              = :nationality,
    email_address            = :email_address,
    mobile_no                = :mobile_no,
    telephone_no             = :telephone_no,
    identification           = :identification,
    identification_no        = :identification_no,
    employee_type            = :employee_type,
    department               = :department,
    designation              = :designation,
    date_joining             = :date_joining,
    blood_type               = :blood_type,
    bank_name                = :bank_name,
    bank_no                  = :bank_no,
    bank_account_type        = :bank_account_type,
    bank_holder_name                  = :bank_holder_name,
    ifsc_code                = :ifsc_code,
    tin_no                   = :tin_no,
    sss                      = :sss,
    philhealth               = :philhealth,
    pag_ibig                 = :pag_ibig,
    emergency_name           = :emergency_name,
    emergency_relationship   = :emergency_relationship,
    emergency_contact_no     = :emergency_contact_no,
    net_pay     = :net_pay,
    weekly_salary     = :weekly_salary
 
    WHERE emp_id = :emp_id";

    $employee_data = $con->prepare($employee_sql);
    $employee_data->execute([
        ':emp_id'                => $emp_id_new,
        ':date_register'         => $date_register,
        ':fullname'              => strtoupper($fullname),
        ':firstname'             => strtoupper($firstname),
        ':middlename'            => strtoupper($middlename),
        ':lastname'              => strtoupper($lastname),
        ':suffix'                => strtoupper($suffix),
        ':gender'                => $gender,
        ':birthdate'             => $birthdate,
        ':civilstatus'           => $civilstatus,
        ':address'               => strtoupper($address),
        ':barangay'              => strtoupper($barangay),
        ':city'                  => strtoupper($city),
        ':province'              => strtoupper($province),
        ':country'               => strtoupper($country),
        ':nationality'           => strtoupper($nationality),
        ':email_address'         => $email_address,
        ':mobile_no'             => $mobile_no,
        ':telephone_no'          => $telephone_no,
        ':identification'        => $identification,
        ':identification_no'     => $identification_no,
        ':employee_type'         => $employee_type,
        ':department'            => strtoupper($department),
        ':designation'           => strtoupper($designation),
        ':date_joining'          => $date_joining,
        ':blood_type'            => strtoupper($blood_type),
        ':bank_name'             => strtoupper($bank_name),
        ':bank_account_type'             => strtoupper($bank_account_type),
        ':bank_holder_name'             => strtoupper($bank_holder_name),
        ':bank_no'               => $bank_no,
        ':ifsc_code'             => $ifsc_code,
        ':tin_no'                => $tin_no,
        ':sss'                   => $sss,
        ':philhealth'            => $philhealth,
        ':pag_ibig'              => $pag_ibig,
        ':emergency_name'        => strtoupper($emergency_name),
        ':emergency_relationship' => strtoupper($emergency_relationship),
        ':emergency_contact_no'  => $emergency_contact_no,
        ':net_pay'  => $net_pay,
        ':weekly_salary'  => $weekly_salary

    ]);



    $user_type2 = $_POST['get_user_type'];
    $username = $_POST['username'];



    //UPDATE USERS TABLE
    $update_user = "UPDATE tbl_users SET 
    username       = :username,
    user_type      = :user_type

WHERE emp_id = :emp_id";

    $users_data = $con->prepare($update_user);
    $users_data->execute([
        ':emp_id'        => $emp_id_new,
        ':username'      => $username,
        ':user_type'     => $user_type2

    ]);


    $password  = $_POST['password'];
    if (!empty($_POST['password'])) {
        $password  = $_POST['password'];
        $hashed_password  = password_hash($password, PASSWORD_DEFAULT);
        $password_text  = $_POST['password'];

        $update_user = "UPDATE tbl_users SET 
  
    password       = :password,
    password_text  = :password_text
WHERE emp_id = :emp_id";

        $users_data = $con->prepare($update_user);
        $users_data->execute([
            ':emp_id'        => $emp_id_new,
            ':password'      => $hashed_password,
            ':password_text' => $password_text
        ]);
    }

    if ($employee_data && $users_data) {

        $_SESSION['status'] = "Update Succesfully!";
        $_SESSION['status_code'] = "success";

        header('location: view_profile.php?emp_id=' . $emp_id_new);
    } else {
        $_SESSION['status'] = "Update Not successfully!";
        $_SESSION['status_code'] = "error";

        header('location: view_profile.php?emp_id=' . $emp_id_new);
    }
}
