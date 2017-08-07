<?php

session_start();
unset($_SESSION["aav-admin"]);
unset($_SESSION["aav-super-admin"]);
unset($_SESSION["aav-church"]);
header("Location: login.php");

?>