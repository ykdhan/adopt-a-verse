<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$fund_id = $_GET['fund_id'];
$campaign_id = $_GET['campaign_id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "UPDATE campaign SET id = '{$fund_id}', verified = 1 WHERE id = '{$campaign_id}'";

if ($result = $mysqli->query($sql)) {
    $output['id'] = $id;
    echo JSON_encode($output);
} else {
    echo "no";
}

$mysqli->close();
?>



