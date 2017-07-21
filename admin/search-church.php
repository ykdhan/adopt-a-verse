<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$church = $_GET['church'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM church WHERE lower(name) RLIKE '[[:<:]]".strtolower($church)."' OR lower(state) RLIKE '[[:<:]]".strtolower($church)."' ORDER BY name, state";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output['church'][$row['name']]['state'] = $row['state'];
        $output['church'][$row['name']]['id'] = $row['id'];
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

