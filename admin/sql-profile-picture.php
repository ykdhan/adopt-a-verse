<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM church WHERE id = '".$id."'";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output['profile'] = $row['profile_picture'];
        $num ++;
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

