<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$phone = $_GET['phone'];


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


$sql = "UPDATE user SET first_name = '{$first_name}', last_name = '{$last_name}', phone = '{$phone}' WHERE id = '{$id}'";

if ($result = $mysqli->query($sql)) {
    $output['id'] = $id;
    echo JSON_encode($output);
} else {
    echo "no";
}

$mysqli->close();


?>



