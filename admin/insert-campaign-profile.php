<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$id = $_GET['id'];

$temporary = explode(".", $_FILES["profile"]["name"]);
$file_extension = end($temporary);
$attach = $id.".".$file_extension;
$uploaddir = '../img/profile/';
$uploadfile = $uploaddir.$attach);

move_uploaded_file($_FILES['profile']['tmp_name'], $uploadfile)) {

?>



