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

$sql = "SELECT *, campaign.id AS camp_id, church.id AS church_id FROM campaign INNER JOIN language ON language_id = language.id INNER JOIN church ON church_id = church.id WHERE lower(name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(people_group) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(book) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY start_date DESC, end_date DESC, book, people_group, name";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $output[$num]['id'] = $row['camp_id'];
        $output[$num]['book'] = $row['book'];
        $output[$num]['language'] = $row['people_group'];
        $output[$num]['goal_description'] = $row['goal_description'];
        $output[$num]['goal_amount'] = $row['goal_amount'];
        $output[$num]['verse_price'] = $row['verse_price'];
        $output[$num]['start_date'] = date('n/j/y', strtotime($row['start_date']));
        $output[$num]['end_date'] = date('n/j/y', strtotime($row['end_date']));
        $output[$num]['url'] = $row['url'];

        $date_start = date('Y-m-d', strtotime($row['start_date']));
        $date_end = date('Y-m-d', strtotime($row['end_date']));
        
        if (($today >= $date_start) && ($today <= $date_end)) {
            $output[$num]['status'] = "inprogress";
        } else if (($today > $date_start) && ($today > $date_end)) {
            $output[$num]['status'] = "complete";
        } else if (($today < $date_start)) {
            $output[$num]['status'] = "coming";
        }
        
        if ($row['verified'] == 0) {
            $output[$num]['status'] = "pending";
        }
        
        $output[$num]['church'] = $row['name'];
        $output[$num]['church_id'] = $row['church_id'];
        
        
        
        $history_sql = "SELECT * FROM purchase_history WHERE campaign_id = '{$row['camp_id']}'";

        $history = false;
        $raised = 0.0;

        if ($res = $mysqli->query($history_sql)) {

            while ($r = $res->fetch_assoc()) {
                $history = true;
                $raised = $raised + floatval($row['verse_price']);
            }
        }

        if ($history) {
            $output[$num]['raised'] = $raised;
            $output[$num]['percentage'] = intval($raised / $row['goal_amount'] * 100);
        } else {
            $output[$num]['raised'] = 0;
            $output[$num]['percentage'] = 0;
        }
        
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

