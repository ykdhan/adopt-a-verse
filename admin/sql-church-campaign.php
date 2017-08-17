<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


$sql = "SELECT *, campaign.id AS camp_id FROM campaign INNER JOIN language ON language_id = language.id INNER JOIN church ON church_id = church.id WHERE campaign.id = '{$id}'";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        
        $answer = true;
        $output['id'] = $row['camp_id'];
        $output['book'] = $row['book'];
        $output['church'] = $row['name'];
        $output['language'] = $row['people_group'];
        $output['goal_description'] = $row['goal_description'];
        $output['goal_amount'] = $row['goal_amount'];
        $output['verse_price'] = $row['verse_price'];
        $output['start_date'] = $row['start_date'];
        $output['end_date'] = $row['end_date'];
        $output['url'] = $row['url'];
        $output['verified'] = $row['verified'];

    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}

$mysqli->close();
?>

