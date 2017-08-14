<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
shuffle($seed);
$id = '';
foreach (array_rand($seed, 6) as $k) $id .= $seed[$k];  // 6-char random id


$church = $_GET['church'];
$language = $_GET['language'];
$book = $_GET['book'];
$goal_description = $_GET['goal_description'];
$goal_amount = $_GET['goal_amount'];
$verse_price = $_GET['verse_price'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
$url = $_GET['url'];


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}


$sql = "INSERT INTO campaign (id,
                       church_id,
                     language_id,
                            book,
                goal_description,
                     goal_amount,
                     verse_price,
                      start_date,
                        end_date,
                             url)
               VALUES ('".$id."',
                     ".$church.",
                 '".$language."',
                     '".$book."',
         '".$goal_description."',
                ".$goal_amount.",
                ".$verse_price.",
               '".$start_date."',
                 '".$end_date."',
                      '".$url."')";

if ($result = $mysqli->query($sql)) {
    echo "yes";
} else {
    echo "no";
}

$mysqli->close();


?>



