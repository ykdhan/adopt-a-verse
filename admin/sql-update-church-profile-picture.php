<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$id = $_GET['id'];

<<<<<<< HEAD

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
shuffle($seed);
$name = '';
foreach (array_rand($seed, 6) as $k) $id .= $seed[$k];  // 6-char random id


$temporary = explode(".", $_FILES["input_profile_picture"]["name"]);
$file_extension = end($temporary);
$attach = "church-".$name.".".$file_extension;
$uploaddir = '../img/profile/';
$uploadfile = $uploaddir.$attach;

if (move_uploaded_file($_FILES['input_profile_picture']['tmp_name'], $uploadfile)) {
    
    include('config.php');

    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($mysqli->connect_errno) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }
    
    $sql = "UPDATE church SET profile_picture = '{$attach}' WHERE id = '{$id}'";

    if ($result = $mysqli->query($sql)) {
        echo "yes";
    } else {
        echo "update_error";
    }

    $mysqli->close();
} else {
    echo "upload_error";
}
=======
$temporary = explode(".", $_FILES["input_profile_picture"]["name"]);
$file_extension = end($temporary);
$attach = $id.".".$file_extension;
$uploaddir = '../img/profile/';
$uploadfile = $uploaddir.$attach;

echo $uploadfile;

if (move_uploaded_file($_FILES['input_profile_picture']['tmp_name'], $uploadfile)) {
    echo "yes";
} else {
    echo "no";
}

>>>>>>> 330947e15412e45c91c28dc2680d90223c10a9d1
?>



