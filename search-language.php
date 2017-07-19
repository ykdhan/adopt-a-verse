<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$language = $_GET['language'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM language WHERE lower(people_group) like '%".strtolower($language)."%' ORDER BY people_group, region";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output['language'][$row['people_group']]['region'] = $row['region'];
        $output['language'][$row['people_group']]['id'] = $row['id'];
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

