<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$church_id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM purchase_history INNER JOIN campaign ON campaign.id = campaign_id WHERE church_id = '{$church_id}' AND status != 'denied'";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        
        $output[$row['campaign_id']]['book'][$row['chapter']][$row['verse']] = $row['status'];
        $output[$row['campaign_id']]['verse_price'] = $row['verse_price'];
        
    }
}

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}



$mysqli->close();


?>

