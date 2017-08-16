<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$church = $_GET['church'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT *, campaign.id AS camp_id FROM campaign INNER JOIN language ON language_id = language.id INNER JOIN church ON church_id = church.id WHERE lower(name) RLIKE '[[:<:]]".strtolower($church)."' OR lower(state) RLIKE '[[:<:]]".strtolower($church)."' OR lower(people_group) RLIKE '[[:<:]]".strtolower($church)."' OR lower(book) RLIKE '[[:<:]]".strtolower($church)."' ORDER BY start_date DESC, end_date DESC, name";

$answer = false;
$today = date('Y-m-d');

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    while ($row = $result->fetch_assoc()) {
        
        if ($row['verified'] == 1 && $row['start_date'] <= $today && $row['end_date'] >= $today) {
            $answer = true;
            $output[$num]['state'] = $row['state'];
            $output[$num]['church'] = $row['name'];
            $output[$num]['id'] = $row['camp_id'];
            $output[$num]['langauge'] = $row['people_group'];
            $output[$num]['book'] = $row['book'];
            $num ++;
        }
        
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

