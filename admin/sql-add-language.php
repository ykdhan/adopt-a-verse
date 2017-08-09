<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


$id = $_GET['id'];
$project_description = $_GET['project_description'];
$pdf_url = $_GET['pdf_url'];

$region = "";
$people_group = "";
$num_speakers = "";
$publish_date = "";
    
$sql = "SELECT * FROM sf_language WHERE id = '{$id}'";

$answer = false;

if ($result = $mysqli->query($sql)) {

    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $region = $row['region'];
        $people_group = $row['people_group'];
        $num_speakers = $row['number_of_speakers'];
        $publish_date = $row['scripture_published'];
    }
}

if ($answer) {
        
    $insert = "INSERT INTO language (id, people_group, region, number_of_speakers, scripture_published, project_description, pdf_url) VALUES ( '{$id}', '{$people_group}', '{$region}', '{$num_speakers}', '{$publish_date}', '{$project_description}', '{$pdf_url}')";

    if ($mysqli->query($insert)) {
        echo "yes";
    } else {
        echo "insert_error";
    }

} else {
    echo "select_error";
}

$mysqli->close();
?>