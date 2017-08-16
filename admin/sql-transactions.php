<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT *, purchase_history.id AS tid FROM purchase_history INNER JOIN user ON user.id = user_id WHERE purchase_history.id LIKE '%".$keyword."%' OR campaign_id LIKE '%".$keyword."%' OR lower(first_name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(last_name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(email) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY num DESC";

$answer = false;
$id = "";
$num = 0;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        
        if ($id != $row['tid']) {
            $num ++;
            $id = $row['tid'];
        }
        $output[$num][$id]['campaign'] = $row['campaign_id'];
        $output[$num][$id]['name'] = $row['first_name']." ".$row['last_name'];
        $output[$num][$id]['amount'] = $row['amount'];
        $output[$num][$id]['date'] = $row['purchase_date'];
        $output[$num][$id]['status'] = $row['status'];
        if ($output[$num][$id]['verses'] == null) {
            $output[$num][$id]['verses'] = 1;
        } else {
            $output[$num][$id]['verses'] = $output[$num][$id]['verses'] + 1;
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

