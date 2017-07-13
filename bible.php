
<?php
error_reporting(E_ALL ^ E_DEPRECATED);

include("config.php");

$link = mysql_connect($server, $db_user, $db_pass)
or die ("MYSQL failed. ".mysql_error());

mysql_query("set names utf8");

mysql_select_db($database)
or die ("DB failed. ".mysql_error());

$book = $_GET['book'];

$output = array('size');
$output = array('bible');


$sql = "SELECT * FROM bible.nlt WHERE book = '".$book."'";

$qry = mysql_query($sql) or die ("SELECT failed. ".mysql_error());
$num_rows = mysql_num_rows($qry);


if ($num_rows > 0) {
    
    while ($row = mysql_fetch_array($qry)) {
        $verse = $row['verse'];
        $chapter = $row['chapter'];
        $output['bible'][$chapter][$verse] = $row['text'];
    }
    
    $output['size'] = sizeof(array_keys($output['bible']));
    
} else {
    
    $output['size'] = 0;

}


echo JSON_encode($output);

?>
