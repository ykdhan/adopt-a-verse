<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


$id = $_GET['id'];

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
shuffle($seed);
$random = '';
foreach (array_rand($seed, 6) as $k) $random .= $seed[$k];  // 6-char random id


$temporary = explode(".", $_FILES["input_profile_picture"]["name"]);
$file_extension = end($temporary);
$attach = "church-".$random.".".$file_extension;
$uploaddir = '../img/profile/';
$uploadfile = $uploaddir.$attach;
    
$sql = "SELECT * FROM sf_church WHERE id = {$id}";

$answer = false;
$name = "";
$state = "";
$contact = "";

if ($result = $mysqli->query($sql)) {

    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $name = $row['name'];
        $state = $row['state'];
        $contact = $row['contact'];
    }
}

if (move_uploaded_file($_FILES['input_profile_picture']['tmp_name'], $uploadfile)) {
    
    if ($answer) {
        
        $insert = "INSERT INTO church (id, name, state, contact, profile_picture) VALUES ( {$id}, '{$name}', '{$state}', '{$contact}', '{$attach}')";

        if ($mysqli->query($insert)) {
            echo "yes";
        } else {
            echo "insert_error";
        }
        
    } else {
        echo "select_error";
    }
    
} else {
    
    if ($answer) {
        
        $insert = "INSERT INTO church (id, name, state, contact) VALUES ( {$id}, '{$name}', '{$state}', '{$contact}')";

        if ($mysqli->query($insert)) {
            echo "yes";
        } else {
            echo "insert_error2";
        }
        
    } else {
        echo "select_error2";
    }
}

$mysqli->close();
?>