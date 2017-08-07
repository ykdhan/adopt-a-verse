<?php 
session_start();

if (isset($_SESSION['aav-super-admin'])) { 
} else if (isset($_SESSION['aav-admin'])) { 
    
    if ($_GET['id'] != $_SESSION['aav-church']) {
        header("Location: login.php");
    }
    
} else {
    header("Location: login.php");
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

</head>
    
<body>
    
<!-- Top Bar -->
<div class="top-bar desktop">
    <table><tr>
    <td>
        <img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="../img/wycliffe-logo.png"><span id="tag-admin">Admin</span>
    </td>
    <th>
    </th>
    <td>
        <span id="admin-logout"><a href="logout.php">Logout</a></span>
        <span id="admin-title"></span>
    </td>
    </tr></table>
</div>
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="wrapper">
    
   
    
    
    <div id="content-create-admin" class="admin-content">
        <div id="title">New Administrator</div>
        <section>
            <div class="column-left">Church</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p id="admin-church"></p>
            </div>
        </section>
        <section>
            <div class="column-left">Admin Account</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <input type="text" class="admin-text" id="admin-email" placeholder="Email Address"><span class="error" id="error-email"></span><br>
            </div>
            <div class="column-left">Contact</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <input type="text" class="admin-text" id="admin-first-name" placeholder="First Name" onkeyup="input_form('first-name')">
                <input type="text" class="admin-text" id="admin-last-name" placeholder="Last Name" onkeyup="input_form('last-name')">
                <input type="text" class="admin-text" id="admin-phone" placeholder="Phone Number" onkeyup="input_form('phone')"></div>
        </section>
        <section id="last-section">
            <button type="button" class="admin-button" onclick="history.back()">Cancel</button>
            <button type="button" class="admin-submit" onclick="submit_form()">Create Admin</button>
        </section>
    </div>


         
    <div id="footer">
        ©2017 Wycliffe Bible Translators. All rights reserved.
    </div> 
    
    
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

    

<script>
    
var page_param = window.location.search.substring(1);
var page_url = new URL(window.location.href);
var church_id = page_url.searchParams.get("id");
    
    
var form_data = {
    first_name: "",
    last_name: "",
    phone: "",
    email: ""
}
    
search_church();
    
function search_church() {
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            if (ajaxObj.responseText == "no\n") {
                alert("Error: Church does not exist");
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                var state = resp['state'];
                var name = resp['name'];

                document.getElementById('admin-church').innerHTML = name;
            }
            
        }}}
        ajaxObj.open("GET", "sql-church.php?id="+church_id);
        ajaxObj.send();
        
}

function search_email() {
    
    var email = document.getElementById('admin-email');
    
    document.getElementById('error-email').style.visibility = "visible";

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        
        var valid = true;
        form_data.email = "";
        
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Email is invalid';
            valid = false;
        }
        
        if (ajaxObj.responseText == "yes\n") {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Email already exists';
            valid = false;
        } 
        
        if (valid) {
            form_data.email = email.value;
            document.getElementById('error-email').className = "error green";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Email is valid';
        }

    }}}
    ajaxObj.open("GET", "search-email.php?email="+email.value);
    ajaxObj.send();
}
    
$( "#admin-email" ).focusout(function() {
    search_email();
});

function input_form(title) {
    
    var word = document.getElementById('admin-'+title);
    
    switch(title) {
        case 'first-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            form_data.first_name = document.getElementById('admin-first-name').value;
            break;
        case 'last-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            form_data.last_name = document.getElementById('admin-last-name').value;
            break;
        case 'phone':
            word.value = word.value.replace(/[^0-9\)-\.\+\s]+/, '');
            form_data.phone = document.getElementById('admin-phone').value;
            break;
        default:
            break;
    }
}

    
function submit_form() {
    
    var valid = true;
    
    document.getElementById('admin-first-name').style.border = "1px solid #d1d1d1";
    document.getElementById('admin-last-name').style.border = "1px solid #d1d1d1";
    document.getElementById('admin-email').style.border = "1px solid #d1d1d1";
    document.getElementById('admin-phone').style.border = "1px solid #d1d1d1";
    
    if (form_data.first_name == "") {
        document.getElementById('admin-first-name').style.border = "1px solid #db5353";
        document.getElementById('admin-first-name').focus();
        valid = false;
    } else if (form_data.last_name == "") {
        document.getElementById('admin-last-name').style.border = "1px solid #db5353";
        document.getElementById('admin-last-name').focus();
        valid = false;
    } else if (form_data.email == "") {
        document.getElementById('admin-email').style.border = "1px solid #db5353";
        document.getElementById('admin-email').focus();
        valid = false;
    } else if (form_data.phone == "") {
        document.getElementById('admin-phone').style.border = "1px solid #db5353";
        document.getElementById('admin-phone').focus();
        valid = false;
    }
    
    if (valid) {
        
        var params = 'church='+church_id+'&first_name='+form_data.first_name+'&last_name='+form_data.last_name+'&email='+form_data.email+'&phone='+form_data.phone;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            

            if (ajaxObj.responseText == "yes\n\n\n") {
                window.location.href = "church.php?id="+church_id;
            } else {
                alert("Error occurred");
            }
            
        }}}
        ajaxObj.open("GET", "insert-church-admin.php?"+params);
        ajaxObj.send();
        
        
        
    }
}
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>