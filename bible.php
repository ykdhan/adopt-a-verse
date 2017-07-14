<?php

error_reporting(E_ALL ^ E_DEPRECATED);



$book = $_GET['book'];

$output = array('size');
$output = array('bible');


DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'root');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_DATABASE', 'bible');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM nlt WHERE book = '".$book."' LIMIT 0, 50000";


if ($result = $mysqli->query($sql)) {
     
    while ($row = $result->fetch_assoc()) {
        $output['bible'][$row['chapter']][$row['verse']] = $row['text'];
    }
    
    $output['size'] = sizeof($output['bible']);
    
     
} else {
     $output['size'] = 0;
}


echo JSON_encode($output);

$mysqli->close();


?>
