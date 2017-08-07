<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];
$goal_description = $_GET['goal_description'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


$sql = "UPDATE campaign SET start_date = '{$start_date}', end_date = '{$end_date}', goal_description = '{$goal_description}' WHERE id = '{$id}'";

if ($result = $mysqli->query($sql)) {
    $output['id'] = $id;
    echo JSON_encode($output);
} else {
    echo "no";
}

$mysqli->close();


?>



