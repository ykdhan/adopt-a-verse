<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$url = $_GET['url'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM campaign WHERE url = '".$url."'";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
    }
} 

if ($answer) {
    echo "exist";       // url exists. may not create.
} else {
    echo "not-exist";   // url does not exist. may create.
}


$mysqli->close();


?>

