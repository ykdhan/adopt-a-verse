<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$email = $_GET['email'];
$password = $_GET['password'];

$id = "";

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM campaign WHERE email = '".$email."' AND password = '".$password."'";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $id = $row['id'];
    }
} 

if ($answer) {
    session_start();
    $_SESSION['aav-admin'] = $id;
    echo "yes";
} else {
    $_SESSION['aav-admin'] = "";
    session_destroy();
    echo "no";
}


$mysqli->close();


?>

