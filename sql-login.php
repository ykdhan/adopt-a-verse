<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$email = $_GET['email'];
$password = $_GET['password'];

$id = "";
$admin = "";

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE email = '".$email."' AND password = '".$password."'";


if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $church = $row['church_id'];
        if ($row['campaign_admin'] == 1) {
            $role = 1;
            $admin = 1;
        } else if ($row['wycliffe_admin'] == 1) {
            $role = 1;
            $admin = 2;
        } else {
            $role = 2;
        }
    }
} 

if ($role == 1) {
    session_start();
    if ($admin == 1) {
        $_SESSION['aav-admin'] = $id;
        $_SESSION['aav-church'] = $church;
    } else if ($admin == 2) {
        $_SESSION['aav-super-admin'] = $id;
    }
    echo 1;
} else if ($role == 2) {
    session_start();
    $_SESSION['aav-user'] = $id;
    echo 2;
} else {
    session_destroy();
    echo "no";
}
$mysqli->close();
?>

