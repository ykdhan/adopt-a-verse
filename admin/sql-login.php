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

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $id = $row['id'];
        $church = $row['church_id'];
        if ($row['campaign_admin'] == 1) {
            $admin = 1;
        } else if ($row['wycliffe_admin'] == 1) {
            $admin = 2;
        }
    }
} 

if ($answer) {
    session_start();
    if ($admin == 1) {
        $_SESSION['aav-admin'] = $id;
        $_SESSION['aav-church'] = $church;
    } else if ($admin == 2) {
        $_SESSION['aav-super-admin'] = $id;
    }
    echo "yes";
} else {
    session_destroy();
    echo "no";    
    
}


$mysqli->close();


?>

