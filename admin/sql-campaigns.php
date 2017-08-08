<?php
session_start();
error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$today = date("Y-m-d");
$today = date('Y-m-d', strtotime($today));


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT *, campaign.id AS camp_id, church.id AS church_id FROM campaign INNER JOIN language ON language_id = language.id INNER JOIN church ON church_id = church.id WHERE lower(name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(people_group) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(book) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY book, people_group, name";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output[$row['camp_id']]['book'] = $row['book'];
        $output[$row['camp_id']]['language'] = $row['people_group'];
        $output[$row['camp_id']]['goal_description'] = $row['goal_description'];
        $output[$row['camp_id']]['goal_amount'] = $row['goal_amount'];
        $output[$row['camp_id']]['verse_price'] = $row['verse_price'];
        $output[$row['camp_id']]['start_date'] = date('n/j/y', strtotime($row['start_date']));
        $output[$row['camp_id']]['end_date'] = date('n/j/y', strtotime($row['end_date']));
        $output[$row['camp_id']]['url'] = $row['url'];

        $date_start = date('Y-m-d', strtotime($row['start_date']));
        $date_end = date('Y-m-d', strtotime($row['end_date']));
        
        if (($today >= $date_start) && ($today <= $date_end)) {
            $output[$row['camp_id']]['status'] = "inprogress";
        } else if (($today > $date_start) && ($today > $date_end)) {
            $output[$row['camp_id']]['status'] = "complete";
        } else if (($today < $date_start)) {
            $output[$row['camp_id']]['status'] = "coming";
        }
        
        $output[$row['camp_id']]['church'] = $row['name'];
        $output[$row['camp_id']]['church_id'] = $row['church_id'];
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

