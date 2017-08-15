<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$date = date('Y-m-d');

$sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
$last_id = 0;

if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $last_id = $row['id'];
        $last_id ++;
    }
} 

if ($last_id != 0) {

    $sql = "INSERT INTO user (id, first_name, last_name, email, phone, wycliffe_admin, register_date) VALUES ( {$last_id}, '{$first_name}', '{$last_name}', '{$email}', '{$phone}', 1, '{$date}')";

    if ($mysqli->query($sql)) {
        echo "yes";
    } else {
        echo "error";
    }
} else {
    echo "no";
}

$mysqli->close();
?>



