<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$email = $_GET['email'];
$church = $_GET['church'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM user WHERE email = '".$email."'";

$answer = "no";

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        if ($row['campaign_admin'] == 0) {
            if ($row['verified'] == 0) {
                $answer = "verify";
            } else {
                $answer = "yes";
            }
        } else if ($row['church_id'] == $church) {
            $answer = "already";
        }
    }
} 

echo $answer;

$mysqli->close();


?>

