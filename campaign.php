<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$campaign = $_GET['campaign'];

$output = array('status');
$output = array('info');


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM campaign INNER JOIN church ON church_id = church.id INNER JOIN language ON language_id = language.id WHERE campaign.id = '".$campaign."' LIMIT 0, 50000";

if ($result = $mysqli->query($sql)) {
    
    $output['status'] = 1;
    while ($row = $result->fetch_assoc()) {
        $output['info']['church'] = $row['name'];
        $output['info']['language'] = $row['people_group'];
        $output['info']['project_description'] = $row['project_description'];
        $output['info']['book'] = $row['book'];
        $output['info']['goal_description'] = $row['goal_description'];
        $output['info']['goal_amount'] = $row['goal_amount'];
        $output['info']['verse_price'] = $row['verse_price'];
        $output['info']['first_name'] = $row['first_name'];
        $output['info']['last_name'] = $row['last_name'];
        $output['info']['email'] = $row['email'];
        $output['info']['phone'] = $row['phone'];
        $output['info']['start_date'] = $row['start_date'];
        $output['info']['end_date'] = $row['end_date'];
        $output['info']['region'] = $row['region'];
        $output['info']['number_of_speakers'] = $row['number_of_speakers'];
        if ($row['scripture_published'] == null) {
            $output['info']['scripture_published'] = "None";
        } else {
            $output['info']['scripture_published'] = $row['scripture_published'];
        }
        $output['info']['pdf_url'] = $row['pdf_url'];
    }
     
} else {
     $output['status'] = 0;
}


echo JSON_encode($output);

$mysqli->close();


?>

