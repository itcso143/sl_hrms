<?php

session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {
}

$user_type = $_SESSION['user_type'] ?? null;

if ($user_type !== 'ADMIN') {
    header('Location: ../index.php');
    exit();
}
?>