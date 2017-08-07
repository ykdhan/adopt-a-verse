<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE church_id = {$id} AND campaign_admin = 1 AND verified = 1 ORDER BY first_name, last_name, email, register_date";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output[$row['id']]['first_name'] = $row['first_name'];
        $output[$row['id']]['last_name'] = $row['last_name'];
        $output[$row['id']]['email'] = $row['email'];
        $output[$row['id']]['verified'] = $row['verified'];
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

