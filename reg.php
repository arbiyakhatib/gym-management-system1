<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('DBCONNECT.php');
include('common_setting.php');

// Sanitize input
$name      = trim($_POST['name']);
$email     = trim($_POST['email']);
$password  = trim($_POST['password']);
$phone     = trim($_POST['phone']);
$package   = trim($_POST['package']);
$startdate = trim($_POST['startdate']);
$time      = trim($_POST['time']);

$obj = new DBCONNECT();

// Check if email already exists
$existingUser = $obj->fetch_userpage($email);

if (!empty($existingUser)) {
    echo "<script>
        alert('Sign Up failed. Email ID already exists.');
        window.location.href = '{$url}signup.php';
    </script>";
    exit();
}

// Insert user (no hashing)
$res = $obj->insert_signup($name, $email, $password, $phone, $package, $startdate, $time);

if ($res > 0) {
    echo "<script>
        alert('Profile created successfully.');
        window.location.href = '{$url}login.php';
    </script>";
} else {
    echo "<script>
        alert('Sign Up failed. Please try again.');
        window.location.href = '{$url}signup.php';
    </script>";
}
?>