<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM purchase_history WHERE campaign_id = '{$id}'";



if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        
        if ($row['honoree_name'] != "") {
            $output[$row['chapter']][$row['verse']] = "This verse has been sponsored in honor of ".$row['honoree_name']." by ".$row['display_name'].".";
        } else {
            if ($row['display_name'] == "") {
                $output[$row['chapter']][$row['verse']] = "This verse has been sponsored by Anonymous.";
            } else {
                $output[$row['chapter']][$row['verse']] = "This verse has been sponsored by ".$row['display_name'].".";
            }
        }
        
    }
}

echo JSON_encode($output);

$mysqli->close();


?>

