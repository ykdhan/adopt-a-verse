<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM language WHERE lower(id) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(people_group) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(region) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY id, people_group, region";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        
        $output[$num]['id'] = $row['id'];
        $output[$num]['people_group'] = $row['people_group'];
        $output[$num]['region'] = $row['region'];
        $output[$num]['continent'] = $row['continent'];
        $output[$num]['number_of_speakers'] = $row['number_of_speakers'];
        $output[$num]['publish_date'] = $row['scripture_published'];
        $output[$num]['project_description'] = $row['project_description'];
        $output[$num]['pdf_url'] = $row['pdf_url'];
        
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

