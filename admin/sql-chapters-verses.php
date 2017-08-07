<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM bible_contents";

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $output[$row['book']]['chapters'] = $row['chapters'];
        $output[$row['book']]['verses'] = $row['verses'];
    }
} 

echo JSON_encode($output);

$mysqli->close();


?>

