<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM church WHERE id = {$id}";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output['state'] = $row['state'];
        $output['name'] = $row['name'];
<<<<<<< HEAD
        $output['profile_picture'] = $row['profile_picture'];
=======
        $output['church'] = $row['profile_picture'];
>>>>>>> 330947e15412e45c91c28dc2680d90223c10a9d1
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

