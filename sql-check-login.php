<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
include('config.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


session_start();

if (isset($_SESSION['aav-user'])) {
    $id = $_SESSION['aav-user'];
    
    $sql = "SELECT * FROM user WHERE id = '{$id}' AND verified = 1";
    
    $answer = false;

    if ($result = $mysqli->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            $answer = true;
            $output['id'] = $row['id'];
            $output['first_name'] = $row['first_name'];
            $output['last_name'] = $row['last_name'];
            $output['email'] = $row['email'];
        }
    }
    
    if ($answer) {
        echo JSON_encode($output);
    } else {
        echo 0;
    }
    
} else if (isset($_SESSION['aav-admin'])) {
    $id = $_SESSION['aav-admin'];
    
    $sql = "SELECT * FROM user WHERE id = '{$id}' AND verified = 1";

    $answer = false;
    
    if ($result = $mysqli->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            $answer = true;
            $output['id'] = $row['id'];
            $output['first_name'] = $row['first_name'];
            $output['last_name'] = $row['last_name'];
            $output['email'] = $row['email'];
        }
    }
    
    if ($answer) {
        echo JSON_encode($output);
    } else {
        echo 0;
    }
    
} else {
    echo 0;
}
?>