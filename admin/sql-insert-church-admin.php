<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

if ($_GET['mode'] == "new") {
    
    $church = $_GET['church'];
    $first_name = $_GET['first_name'];
    $last_name = $_GET['last_name'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
    $date = date('Y-m-d');

    $sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
    $last_id = 0;

    if ($result = $mysqli->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            $last_id = $row['id'];
        }


    } 

    if ($last_id != 0) {

        $last_id ++;

        $sql = "INSERT INTO user (id, church_id, first_name, last_name, email, phone, campaign_admin, register_date) VALUES ( {$last_id}, '{$church}', '{$first_name}', '{$last_name}', '{$email}', '{$phone}', 1, '{$date}')";

        if ($mysqli->query($sql)) {
            echo "yes";
        } else {
            echo "error";
        }
    } else {
        echo "no";
    }
    
} else if ($_GET['mode'] == "existing") {
    
    $church = $_GET['church'];
    $email = $_GET['email'];
    
    $sql = "UPDATE user SET church_id = {$church}, campaign_admin = 1 WHERE email = '{$email}'";

    if ($mysqli->query($sql)) {
        echo "yes";
    } else {
        echo "error";
    }
}

$mysqli->close();
?>



