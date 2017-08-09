<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];
$project_description = $_GET['project_description'];
$pdf_url = $_GET['pdf_url'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "UPDATE language SET project_description = '{$project_description}', pdf_url = '{$pdf_url}' WHERE id = '{$id}'";

if ($result = $mysqli->query($sql)) {
    $output['id'] = $id;
    echo JSON_encode($output);
} else {
    echo "no";
}

$mysqli->close();


?>



