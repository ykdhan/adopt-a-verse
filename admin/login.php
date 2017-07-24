<?php 
session_start();
if(isset($_SESSION['aav-admin'])) { 
    header('Location: index.php');
} 
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf8" />
    <title>Adopt a Verse | Wycliffe Bible Translators</title>
    
    <!-- Links -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin.css?ver=1.5" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/filamentgroup/fixed-sticky/master/fixedsticky.js"></script>
    <script type="text/javascript" src="../js/sidebar.js"></script>
    
    
    <!-- Wycliffe links -->

    
    
    
    <?php 
    
    error_reporting(E_ALL ^ E_DEPRECATED);

    include('config.php');

    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($mysqli->connect_errno) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    
    $sql = "SELECT * FROM campaign WHERE email = '".$email."' AND password = '".$password."'";
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    if ($result = $mysqli->query($sql)) {
        header("Location: index.php");
    }
    else {
        
    }
    
    ?>
    
    
    
</head>
    
<body>
    


    
<!-- Body -->
<div id="bg" align="center">
<div id="login-wrapper">
        
    
    <img id="login-logo" alt="Adopt a Verse" src="../img/wycliffe-logo.png">
    <span id="login-tag">Admin</span>
    <br>
    <input type="email" id="login-email" class="login-text" placeholder="Email Address"><br>
    <input type="password" id="login-password" class="login-text" placeholder="Password"><br>
    <div id="login-error">
        Invalid email or password
    </div>
    <button type="button" id="login-submit" class="admin-submit" onclick="login()">Sign In</button><br>
    
    <div id="login-more">
        <a href="">Forgot your password?</a>
    </div>
      
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

    

<script>
    
function login() {
    var email = document.getElementById('login-email');
    var password = document.getElementById('login-password');

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        if (ajaxObj.responseText == "no\n") {
            document.getElementById('login-error').style.display = "block";
        } else {
            document.getElementById('login-error').style.display = "none";
            window.location.href = "index.php";
        }

    }}}
    ajaxObj.open("GET", "sql-login.php?email="+email.value+"&password="+password.value);
    ajaxObj.send();
}
    
    
$('#login-password').keypress(function (e) {
    if (e.which == 13) {
        console.log("enter");
        $('#login-submit').submit();
        return false;
    }
});
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>