<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$id = $_GET['id'];

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

?>



