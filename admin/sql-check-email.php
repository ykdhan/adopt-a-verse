<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$email = $_GET['email'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE email = '".$email."'";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
    }
} 

if ($answer) {
    echo "yes";
} else {
    echo "no";
}


$mysqli->close();


?>

