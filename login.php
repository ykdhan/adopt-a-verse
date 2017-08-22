<?php 
session_start();
if(isset($_SESSION['aav-user'])) { 
    header('Location: user/index.php');
} else if (isset($_SESSION['aav-admin']) || isset($_SESSION['aav-super-admin'])) { 
    header('Location: admin/index.php');
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
    <link rel="stylesheet" type="text/css" href="css/admin.css?ver=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/filamentgroup/fixed-sticky/master/fixedsticky.js"></script>
    <script type="text/javascript" src="js/sidebar.js"></script>
    
    
    <!-- Wycliffe links -->

    
</head>
    
<body>
    


    
<!-- Body -->
<div id="bg" align="center">
<div id="login-wrapper">
        
    
    <img id="login-logo" alt="Adopt a Verse" src="img/wycliffe-logo.png">
    <br>
    <input type="email" id="login-email" class="login-text" placeholder="Email Address"><br>
    <input type="password" id="login-password" class="login-text" placeholder="Password"><br>
    <div id="login-error">
        Invalid email or password
    </div>
    <button type="button" id="login-submit" class="admin-submit" onclick="login()">Sign In</button>
    <div id="login-more">
        <a href="">Forgot your password?</a>
    </div>
    
    <div id="login-division"></div>
    
    <div id="login-first-time">
        <span>First time using Adopt-a-Verse?</span>
        <button class="login-link" onclick="create_account()">Create an Account</button>
    </div>
    
    
    
      
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

    

<script>
    
function login() {
    var email = document.getElementById('login-email');
    var password = document.getElementById('login-password');

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        console.log(ajaxObj.responseText);
        
        if (ajaxObj.responseText == "no\n") {
            document.getElementById('login-error').style.display = "block";
        } else {
            document.getElementById('login-error').style.display = "none";
            if (ajaxObj.responseText == 1) {
                window.location.href = "admin/index.php";
            } else if (ajaxObj.responseText == 2) {
                window.location.href = "user/index.php";
            }
        }

    }}}
    ajaxObj.open("GET", "sql-login.php?email="+email.value+"&password="+password.value);
    ajaxObj.send();
}
    
function create_account() {
    //window.location.href = "create-account.php";
}    

    
$('#login-password').keypress(function (e) {
    if (e.which == 13) {
        login();
        return false;
    }
});
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>