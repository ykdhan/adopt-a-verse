<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE lower(first_name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(last_name) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY first_name, last_name";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output[$row['id']]['first_name'] = $row['first_name'];
        $output[$row['id']]['last_name'] = $row['last_name'];
        if ($row['campaign_admin'] == 1) {
            $output[$row['id']]['role'] = "campaign_admin";
        } else if ($row['wycliffe_admin'] == 1) {
            $output[$row['id']]['role'] = "wycliffe_admin";
        } else {
            $output[$row['id']]['role'] = "user";
        }
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

