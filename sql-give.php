<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');


$campaign = $_GET['campaign'];
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$email = $_GET['email'];
$display = $_GET['display_name'];
$honor = $_GET['honor_name'];
$amount = $_GET['amount'];
$date = date('Y-m-d');

$book = $_GET['book'];
$item = $_GET['items'];
$items = explode(".", $item);


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}



// GET LAST ID FROM USER TABLE and ADD 1

$last_id_sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
$last_id = 0;

if ($result = $mysqli->query($last_id_sql)) {
    while ($row = $result->fetch_assoc()) {
        $last_id = $row['id'];
        $last_id ++;
    }
} 


// IF GOT THE LAST ID

if ($last_id != 0) {
    
    $sql = "INSERT INTO user (id, first_name, last_name, email, register_date) VALUES ( {$last_id}, '{$first_name}', '{$last_name}', '{$email}', '{$date}')";

    if ($mysqli->query($sql)) {
        echo "yes";
    } else {
        echo "error";
    }
} else {
    echo "no";
}

$mysqli->close();
?>



