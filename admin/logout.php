<?php

session_start();
unset($_SESSION["aav-admin"]);
header("Location: login.php");

?>