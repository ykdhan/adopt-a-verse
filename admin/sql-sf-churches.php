<?php

error_reporting(E_ALL ^ E_DEPRECATED);

include('config.php');

$keyword = $_GET['keyword'];

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($mysqli->connect_errno) {
die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

$sql = "SELECT * FROM sf_church WHERE id RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(name) RLIKE '[[:<:]]".strtolower($keyword)."' OR lower(state) RLIKE '[[:<:]]".strtolower($keyword)."' ORDER BY name, state";

$answer = false;

if ($result = $mysqli->query($sql)) {
    
    $num = 0;
    while ($row = $result->fetch_assoc()) {
        $answer = true;
        $church_id = $row['id'];
        $output[$num]['id'] = $row['id'];
        $output[$num]['state'] = $row['state'];
        $output[$num]['contact'] = $row['contact'];
        $output[$num]['name'] = $row['name'];
        
        $select = "SELECT * FROM church WHERE id='{$church_id}'";
        $exist = false;

        if ($res = $mysqli->query($select)) {
            while ($rw = $res->fetch_assoc()) {
                $exist = true;
            }
        }
        
        if ($exist) {
            $output[$num]['status'] = "added";
        } else {
            $output[$num]['status'] = "not added";
        }
        
        $num++;
    }
} 

if ($answer) {
    echo JSON_encode($output);
} else {
    echo "no";
}


$mysqli->close();


?>

