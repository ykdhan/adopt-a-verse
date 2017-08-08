<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM church WHERE lower(name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(state) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY name, state";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        
        $output[$num]['id'] = $row['id'];
        $output[$num]['state'] = $row['state'];
        $output[$num]['name'] = $row['name'];
        $output[$num]['profile_picture'] = $row['profile_picture'];
        
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

