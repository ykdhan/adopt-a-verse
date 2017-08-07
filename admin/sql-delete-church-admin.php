<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "DELETE FROM user WHERE id = {$id} AND campaign_admin = 1";

if ($result = $mysqli->query($sql)) {
    echo "yes";
}

$mysqli->close();


?>

