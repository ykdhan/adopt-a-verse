<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT *, campaign.id AS camp_id FROM campaign INNER JOIN language ON language_id = language.id INNER JOIN church ON church_id = church.id WHERE lower(name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(people_group) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(book) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY book, people_group, name";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output[$row['camp_id']]['book'] = $row['book'];
        $output[$row['camp_id']]['people_group'] = $row['people_group'];
        $output[$row['camp_id']]['name'] = $row['name'];
        $output[$row['camp_id']]['state'] = $row['state'];
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

