<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$output = [];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE lower(first_name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(last_name) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY first_name, last_name";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        
        $output[$num]['id'] = $row['id'];
        $output[$num]['first_name'] = $row['first_name'];
        $output[$num]['last_name'] = $row['last_name'];
        $output[$num]['phone'] = $row['phone'];
        $output[$num]['email'] = $row['email'];
        $output[$num]['register_date'] = $row['register_date'];
        if ($row['campaign_admin'] == 1) {
            $output[$num]['role'] = "campaign_admin";
        } else if ($row['wycliffe_admin'] == 1) {
            $output[$num]['role'] = "wycliffe_admin";
        } else {
            $output[$num]['role'] = "user";
        }
        
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

