<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM campaign INNER JOIN church ON church_id = church.id INNER JOIN language ON language_id = language.id WHERE campaign.id = '".$id."'";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        
        $output['church'] = $row['name'];
        $output['profile_picture'] = $row['profile_picture'];
        $output['language'] = $row['people_group'];
        $output['project_description'] = $row['project_description'];
        $output['book'] = $row['book'];
        $output['goal_description'] = $row['goal_description'];
        $output['goal_amount'] = $row['goal_amount'];
        $output['verse_price'] = $row['verse_price'];
        $output['start_date'] = $row['start_date'];
        $output['end_date'] = $row['end_date'];
        $output['region'] = $row['region'];
        $output['number_of_speakers'] = $row['number_of_speakers'];
        if ($row['scripture_published'] == null) {
            $output['scripture_published'] = "None";
        } else {
            $output['scripture_published'] = $row['scripture_published'];
        }
        $output['pdf_url'] = $row['pdf_url'];
    }
     
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}

$mysqli->close();
?>

