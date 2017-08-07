<?php 
session_start();
$id = "";
if(isset($_SESSION['aav-admin']) || isset($_SESSION['aav-super-admin'])) { 
    $id = $_GET['id'];
} else {
    header('Location: login.php');
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
    
    
    <link href="https://cdn.quilljs.com/1.3.0/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.0/quill.js"></script>
    
    
    
    <?php 
    
    error_reporting(E_ALL ^ E_DEPRECATED);

    include('config.php');

    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($mysqli->connect_errno) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    
    $sql = "SELECT *, campaign.id AS cam_id FROM campaign INNER JOIN church ON church_id = church.id INNER JOIN language ON language_id = language.id INNER JOIN user ON user_id = user.id WHERE campaign.id = '".$id."'";
    
    $info_id = "";
    $info_church = "";
    $info_language = "";
    $info_book = "";
    $info_goal_description = "";
    $info_goal_amount = "";
    $info_verse_price = "";
    $info_start_date = "";
    $info_end_date = "";
    $info_first_name = "";
    $info_last_name = "";
    $info_phone = "";
    $info_email = "";
    $info_url = "";

    if ($result = $mysqli->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            $info_id = $row['cam_id'];                          // id
            $info_church = $row['name'];                        // church name
            $info_language = $row['people_group'];              // language
            $info_book = $row['book'];                          // book
            $info_goal_description = $row['goal_description'];  // goal description
            $info_goal_amount = $row['goal_amount'];            // total goal
            $info_verse_price = $row['verse_price'];            // verse price
            $info_start_date = $row['start_date'];              // start date
            $info_end_date = $row['end_date'];                  // end date
            $info_first_name = $row['first_name'];              // first name
            $info_last_name = $row['last_name'];                // last name
            $info_phone = $row['phone'];                        // phone
            $info_email = $row['email'];                        // email
            $info_url = $row['url'];                            // url
        } 
    }
    
    
    ?>
    
    
</head>
    
<body>
    
    
<!-- Top Bar -->
<div class="top-bar desktop">
    <table><tr>
    <td>
        <a href="index.php"><img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="../img/wycliffe-logo.png"><span id="tag-admin">Admin</span></a>
    </td>
    <th>
    </th>
    <td>
        <span id="admin-logout"><a href="logout.php">Logout</a></span>
        <span id="admin-title">Church Campaign</span>
    </td>
    </tr></table>
</div>
    
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="wrapper">
        
    <div id="content-edit-campaign" class="admin-content">
        <div id="title">Edit Campaign</div>
        <section>
            <div class="column-left">Church</div>
            <div class="column-tip"></div>
            <div class="column-right">
                
                <p><?php echo $info_church; ?></p>
            
            </div>
            <div class="column-left">Campaign Url</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p>adopt.wycliffe.org/<?php echo $info_url; ?></p>
            </div>
            <div class="column-left">Campaign Duration</div>
            <div class="column-tip"></div>
            <div class="column-right"><input type="date" class="admin-text" id="campaign-start-date" onchange="select_start_date(this)" value="<?php echo $info_end_date; ?>">&nbsp; to &nbsp;<input type="date" class="admin-text" id="campaign-end-date" onchange="select_end_date(this)" value="<?php echo $info_end_date; ?>"></div>
        </section>
        <section>
            <div class="column-left">Language</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_language; ?></p>
            </div>
            <div class="column-left">Book</div> 
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_book; ?></p>
            </div>
        </section>
        <section>
            
            <div class="column-left">Total Goal Amount</div>
            <div class="column-tip"></div>
            <div class="column-right"><p class="">&#36; <?php echo $info_goal_amount; ?></p>
            </div>
            <div class="column-left">Cost per Verse</div>
            <div class="column-tip"></div>
            <div class="column-right"><p class="">&#36; <?php echo $info_verse_price; ?></p>
            </div>
            
            
            <div class="column-left">Goal Description</div>
            <div class="column-tip"><span class="tool-tip">?</span></div>
            <div class="column-right">
            
            <div id="editor">
                <?php echo $info_goal_description; ?>
            </div>
            
            </div>
            
            
            
             
        </section>
        <section id="last-section">
            <button type="button" class="admin-button">Cancel</button>
            <button type="button" class="admin-submit" onclick="submit_form()">Edit Campaign</button>
        </section>
    </div>


         
    <div id="footer">
        ©2017 Wycliffe Bible Translators. All rights reserved.
    </div> 
    
    
    
</div> <!-- wrapper -->
    
    
</div> <!-- bg -->
    
    

    

<script>
    
var quill = new Quill('#editor', {
    theme: 'snow'
});
    
var form_data = {
    start_date: "",
    end_date: "",
    first_name: "",
    last_name: "",
    phone: "",
    email: "",
    password: "",
    goal_description: ""
}

    
// common email format, checks if exists in database
function search_email() {
    
    var email = document.getElementById('campaign-email');
    
    document.getElementById('error-email').style.visibility = "visible";
    
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        
        var valid = true;
        form_data.email = "";
        
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Email is invalid';
            valid = false;
        }
        
        if (ajaxObj.responseText == "yes\n") {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Email already exists';
            valid = false;
        } 
        
        if (valid) {
            form_data.email = email.value;
            document.getElementById('error-email').className = "error green";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="img/error_valid.png">Email is valid';
        }

    }}}
    ajaxObj.open("GET", "search-email.php?email="+email.value);
    ajaxObj.send();
}
    
    
$( "#campaign-church" ).focusout(function() {
    select_church("","");
});
$( "#campaign-language" ).focusout(function() {
    select_language("","");
});    
$( "#campaign-book" ).focusout(function() {
    select_book("");
});    
    
$( "#campaign-url" ).focusout(function() {
    search_url();
});
$( "#campaign-email" ).focusout(function() {
    search_email();
});
$( "#campaign-password" ).focusout(function() {
    input_password();
});
$( "#campaign-confirm-password" ).focusout(function() {
    input_confirm_password();
});
    
function input_fund(title) {

    var money_total = document.getElementById('campaign-total-goal');
    var money_verse = document.getElementById('campaign-verse-price');

    
    if (title == 'total') {
        money_total.value = money_total.value.replace(/[^0-9\.,]+/, '');
        var before = parseFloat(money_total.value.toString().replace(/,/g,''));
        money_total.value = before.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var valid = true;
        form_data.total_goal = "";
        
        if (form_data.book == "") {
            document.getElementById('error-total').style.visibility = "visible";
            document.getElementById('error-total').className = "error red";
            document.getElementById('error-total').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Book is not selected';
            valid = false;
            money_total.value = "";
        }
        
        if (valid) {
            document.getElementById('error-total').style.visibility = "hidden";
            
            var pure = parseFloat(money_total.value.toString().replace(/,/g,''));
            form_data.total_goal = pure;
            
            money_verse.value = (pure/parseFloat(verses[form_data.book])).toFixed(2);
            
            form_data.verse_price = money_verse.value;
            
            money_verse.value = money_verse.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        
    } else if (title == 'verse') {
        money_verse.value = money_verse.value.replace(/[^0-9\.,]+/, '');
        var before = parseFloat(money_verse.value.toString().replace(/,/g,''));
        money_verse.value = before.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var valid = true;
        form_data.verse_price = "";
        
        if (form_data.book == "") {
            document.getElementById('error-verse').style.visibility = "visible";
            document.getElementById('error-verse').className = "error red";
            document.getElementById('error-verse').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Book is not selected';
            valid = false;
            money_verse.value = "";
        }
        
        if (valid) {
            document.getElementById('error-verse').style.visibility = "hidden";
            
            var pure = parseFloat(money_verse.value.toString().replace(/,/g,''));
            form_data.verse_price = pure;
            
            money_total.value = (pure*parseFloat(verses[form_data.book])).toFixed(2);
            
            form_data.total_goal = money_total.value;
            
            money_total.value = money_total.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }
    
}
    
function input_url() {
    var word = document.getElementById('campaign-url');
    word.value = word.value.replace(/[^a-z0-9_-]+/, '');
}
    
function input_password() {
    var pass = document.getElementById('campaign-password');
    var valid = true;

    document.getElementById('error-password').style.visibility = "visible";
    
    if (pass.value.length < 6) {
        
        document.getElementById('error-password').className = "error red";
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Password is too short';
        valid = false;
    } 
    if (pass.value.length > 35) {
        document.getElementById('error-password').className = "error red";
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Password is too long';
        valid = false;
    } 
    
    if (valid) {
        document.getElementById('error-password').innerHTML = '';
    } 
}    
    
function input_confirm_password() {
    var pass = document.getElementById('campaign-password');
    var confirm = document.getElementById('campaign-confirm-password');
    
    document.getElementById('error-password').style.visibility = "visible";
    
    if (pass.value == confirm.value) {
        form_data.password = confirm.value;
        document.getElementById('error-password').className = "error green";
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="img/error_valid.png">Password is valid';
    } else {
        form_data.password = "";
        document.getElementById('error-password').style.visibility = "visible";
        document.getElementById('error-password').className = "error red";
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Passwords must match';
    } 
}
    
function input_form(title) {
    
    var word = document.getElementById('campaign-'+title);
    
    switch(title) {
        case 'first-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            form_data.first_name = document.getElementById('campaign-first-name').value;
            break;
        case 'last-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            form_data.last_name = document.getElementById('campaign-last-name').value;
            break;
        case 'phone':
            word.value = word.value.replace(/[^0-9\)-\.\+\s]+/, '');
            form_data.phone = document.getElementById('campaign-phone').value;
            break;
        case 'goal-description':
            form_data.goal_description = document.getElementById('campaign-goal-description').value;
        default:
            break;
    }
}

    
    
    
function select_start_date(e) {
    form_data.start_date = e.value;
}
function select_end_date(e) {
    form_data.end_date = e.value;
}
    
    
    
function submit_form() {
    
    console.log(form_data);
    
    var valid = true;
    
    document.getElementById('campaign-church').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-url').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-start-date').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-end-date').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-first-name').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-last-name').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-email').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-phone').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-password').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-language').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-book').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-goal-description').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-total-goal').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-verse-price').style.border = "1px solid #d1d1d1";
    
    if (form_data.church == "") {
        document.getElementById('campaign-church').style.border = "1px solid #db5353";
        document.getElementById('campaign-church').focus();
        valid = false;
    } else if (form_data.url == "") {
        document.getElementById('campaign-url').style.border = "1px solid #db5353";
        document.getElementById('campaign-url').focus();
        valid = false;
    } else if (form_data.start_date == "") {
        document.getElementById('campaign-start-date').style.border = "1px solid #db5353";
        document.getElementById('campaign-start-date').focus();
        valid = false;
    } else if (form_data.end_date == "") {
        document.getElementById('campaign-end-date').style.border = "1px solid #db5353";
        document.getElementById('campaign-end-date').focus();
        valid = false;
    } else if (form_data.first_name == "") {
        document.getElementById('campaign-first-name').style.border = "1px solid #db5353";
        document.getElementById('campaign-first-name').focus();
        valid = false;
    } else if (form_data.last_name == "") {
        document.getElementById('campaign-last-name').style.border = "1px solid #db5353";
        document.getElementById('campaign-last-name').focus();
        valid = false;
    } else if (form_data.email == "") {
        document.getElementById('campaign-email').style.border = "1px solid #db5353";
        document.getElementById('campaign-email').focus();
        valid = false;
    } else if (form_data.phone == "") {
        document.getElementById('campaign-phone').style.border = "1px solid #db5353";
        document.getElementById('campaign-phone').focus();
        valid = false;
    } else if (form_data.password == "") {
        document.getElementById('campaign-password').style.border = "1px solid #db5353";
        document.getElementById('campaign-password').focus();
        valid = false;
    } else if (form_data.language == "") {
        document.getElementById('campaign-language').style.border = "1px solid #db5353";
        document.getElementById('campaign-language').focus();
        valid = false;
    } else if (form_data.book == "") {
        document.getElementById('campaign-book').style.border = "1px solid #db5353";
        document.getElementById('campaign-book').focus();
        valid = false;
    } else if (form_data.goal_description == "") {
        document.getElementById('campaign-goal-description').style.border = "1px solid #db5353";
        document.getElementById('campaign-goal-description').focus();
        valid = false;
    } else if (form_data.total_goal == "") {
        document.getElementById('campaign-total-goal').style.border = "1px solid #db5353";
        document.getElementById('campaign-total-goal').focus();
        valid = false;
    } else if (form_data.verse_price == "") {
        document.getElementById('campaign-verse-price').style.border = "1px solid #db5353";
        document.getElementById('campaign-verse-price').focus();
        valid = false;
    }
    
    if (valid) {
        var params = 'church='+form_data.church+'&language='+form_data.language+'&book='+form_data.book+'&goal_description='+form_data.goal_description+'&goal_amount='+form_data.total_goal+'&verse_price='+form_data.verse_price+'&start_date='+form_data.start_date+'&end_date='+form_data.end_date+'&first_name='+form_data.first_name+'&last_name='+form_data.last_name+'&email='+form_data.email+'&phone='+form_data.phone+'&password='+form_data.password+'&url='+form_data.url;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText != "no\n") {
                var resp = JSON.parse(ajaxObj.responseText);
                window.location.href = "campaign-registration-result.php?id="+resp['id'];
            } else {
                alert("Error occurred.");
            }
            
        }}}
        ajaxObj.open("GET", "insert-campaign.php?"+params);
        ajaxObj.send();
    }
    
}
    
    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>