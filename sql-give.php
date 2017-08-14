<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789');
shuffle($seed);
$id = '';
foreach (array_rand($seed, 10) as $k) $id .= $seed[$k];  // 6-char random id

$campaign = $_GET['campaign'];
$display = $_GET['display_name'];
$honor = $_GET['honoree_name'];
$amount = $_GET['amount'];
$price = $_GET['verse_price'];
$date = date('Y-m-d');

$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$email = $_GET['email'];

$book = $_GET['book'];
$item = $_GET['items'];
$items = explode(".", $item);


$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
    die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}



$check_user_sql = "SELECT * FROM user WHERE email = '{$email}'";
$check_user = false;
$user_id = 0;

if ($result = $mysqli->query($check_user_sql)) {
    while ($row = $result->fetch_assoc()) {
        $check_user = true;
        $user_id = $row['id'];
    }
} 



// if user already exists
if ($check_user) {

    $fail = false;
    foreach ($items as &$pairs) {
        $pair = explode(":", $pairs);
        $chapter = $pair[0];
        $verse = $pair[1];
        
        $new_purchase_sql = "INSERT INTO purchase_history ( id, campaign_id, user_id, book, chapter, verse, display_name, honoree_name, purchase_date, verse_price, amount) VALUES ( '{$id}', '{$campaign}', {$user_id}, '{$book}', '{$chapter}', '{$verse}', '{$display}', '{$honor}', '{$date}', '{$price}', '{$amount}')";

        if ($mysqli->query($new_purchase_sql)) {
        } else {
            $fail = true;
        }
    }

    if ($fail) {
        echo "no";
    } else {
        echo "yes";
    }
    
}
// if user does not exist
else {

    // GET LAST ID FROM USER TABLE and ADD 1
    
    $last_id_sql = "SELECT * FROM user ORDER BY id DESC LIMIT 1";
    $last_id = 0;

    if ($result = $mysqli->query($last_id_sql)) {
        while ($row = $result->fetch_assoc()) {
            $last_id = $row['id'];
            $last_id ++;
        }
    } 
    
    if ($last_id != 0) {
        
        $create_user_sql = "INSERT INTO user (id, first_name, last_name, email, register_date) VALUES ( {$last_id}, '{$first_name}', '{$last_name}', '{$email}', '{$date}')";
        
        if ($mysqli->query($create_user_sql)) {
            
            $fail = false;
            foreach ($items as &$pairs) {
                $pair = explode(":", $pairs);
                $chapter = $pair[0];
                $verse = $pair[1];
                
                $new_purchase_sql = "INSERT INTO purchase_history ( id, campaign_id, user_id, book, chapter, verse, display_name, honoree_name, purchase_date, verse_price, amount) VALUES ( '{$id}', '{$campaign}', {$last_id}, '{$book}', '{$chapter}', '{$verse}', '{$display}', '{$honor}', '{$date}', '{$price}', '{$amount}')";

                if ($mysqli->query($new_purchase_sql)) {
                } else {
                    $fail = true;
                }
            }
            
            if ($fail) {
                echo "no";
            } else {
                echo "yes";
            }
            
        } else {
            echo "no-create-user";
        }
        
    } else {
        echo "no-last-id";
    }
    
}

$mysqli->close();
?>



