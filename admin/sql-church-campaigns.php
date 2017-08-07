<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$id = $_GET['id'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$today = date("Y-m-d");
$today = date('Y-m-d', strtotime($today));

$sql = "SELECT *, campaign.id AS camp_id FROM campaign INNER JOIN language ON language_id = language.id WHERE church_id = {$id} ORDER BY start_date, end_date, book, people_group";

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
        
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

