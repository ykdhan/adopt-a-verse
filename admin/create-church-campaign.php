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
    <link rel="stylesheet" type="text/css" href="../css/admin.css?ver=1.4" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/filamentgroup/fixed-sticky/master/fixedsticky.js"></script>
    <script type="text/javascript" src="../js/sidebar.js"></script>
    
    
    <link href="https://cdn.quilljs.com/1.3.0/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.0/quill.js"></script>
    
    
    <!-- Wycliffe links -->
    
    
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
        
    <div id="content-create-campaign" class="admin-content">
        <div id="title">New Campaign</div>
        <section>
            
            
            <div class="column-left">Church</div>
            <div class="column-tip"></div>
            <div class="column-right">
                
                <p id="campaign-church"></p>
                <!--
                <input type="text" class="admin-text" id="campaign-church" onkeyup="search_church()" placeholder="Search for church">
                
                <div class="drop" id="drop-church"></div>
                
                <img alt="" src="../img/choose_image.png" id="profile-preview">

                -->
                
            </div>
            
            
            <div class="column-left">Campaign Url</div>
            <div class="column-tip"></div>
            <div class="column-right">adopt.wycliffe.org/ <input type="text" class="admin-text" id="campaign-url" placeholder="church-name"><span class="error" id="error-url"></span>
            </div>
            
            <!--
            <div class="column-left">Campaign Profile</div>
            <div class="column-tip"></div>
            <div class="column-right">
                
                <form id="upload-form" action="" method="post" enctype="multipart/form-data">
                    
                    <input type="file" class="admin-file" id="campaign-profile-picture" onchange="select_profile(this)" accept="image/*">
                    <button id="profile-button" type="button" class="admin-button">Choose Image</button>
                    <span class="error" id="error-profile"></span>
                </form>
            </div>
            -->
            
            <div class="column-left">Campaign Duration</div>
            <div class="column-tip"></div>
            <div class="column-right"><input type="date" class="admin-text" id="campaign-start-date" onchange="select_start_date(this)">&nbsp; to &nbsp;<input type="date" class="admin-text" id="campaign-end-date" onchange="select_end_date(this)"></div>
        </section>
        
        <!--
        <section>
            <div class="column-left">Admin Account</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <input type="text" class="admin-text" id="campaign-email" placeholder="Email Address"><span class="error" id="error-email"></span><br>
            </div>
            <div class="column-left">Contact</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <input type="text" class="admin-text" id="campaign-first-name" placeholder="First Name" onkeyup="input_form('first-name')">
                <input type="text" class="admin-text" id="campaign-last-name" placeholder="Last Name" onkeyup="input_form('last-name')">
                <input type="text" class="admin-text" id="campaign-phone" placeholder="Phone Number" onkeyup="input_form('phone')"></div>
        </section>
        -->
        
        
        <section>
            <div class="column-left">Language</div>
            <div class="column-tip"></div>
            <div class="column-right">
            
                <input type="text" class="admin-text" id="campaign-language" onkeyup="search_language()" placeholder="Search for language">
                
                <div class="drop" id="drop-language"></div>
                
            </div>
            <div class="column-left">Book</div>
            <div class="column-tip"></div>
            <div class="column-right">
            
                <input type="text" class="admin-text" id="campaign-book" onkeyup="search_book()" placeholder="Search for book of the Bible">
                
                <div class="drop" id="drop-book"></div>
                
                <span id="num-verses"></span>
                
            </div>
        </section>
        <section>
            
            <div class="column-left">Total Goal Amount</div>
            <div class="column-tip"></div>
            <div class="column-right">&#36;&nbsp; <input type="text" id="campaign-total-goal" class="admin-text small" onkeyup="input_fund('total')" placeholder="0"><span class="error" id="error-total"></span></div>
            <div class="column-left">Cost per Verse</div>
            <div class="column-tip"></div>
            <div class="column-right">&#36;&nbsp; <input type="text" id="campaign-verse-price" class="admin-text small" onkeyup="input_fund('verse')" placeholder="0"><span class="error" id="error-verse"></span></div>
            <div class="column-left">Goal Description</div>
            <div class="column-tip"><span class="tool-tip">?</span></div>
            <div class="column-right">
                <div id="editor">
                    <?php echo $info_goal_description; ?>
                </div>
            </div>
            
        </section>
        <section id="last-section">
            <button type="button" class="admin-submit" onclick="submit_form()">Create Campaign</button>
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
var church = page_url.searchParams.get("id");
get_church_name(church);


// text editor
var quill = new Quill('#editor', {
    theme: 'snow'
});

var form_description = "";
var form_data = {
    url: "",
    start_date: "",
    end_date: "",
    first_name: "",
    last_name: "",
    phone: "",
    email: "",
    language: "",
    book: "",
    total_goal: "",
    verse_price: ""
    
    // goal description = form_description
}


function get_church_name(ch) {
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        document.getElementById('campaign-church').innerHTML = "";

        if (ajaxObj.responseText == "no\n") {
            document.getElementById('campaign-church').innerHTML += 'INVALID CHURCH';
        } else {
            var resp = JSON.parse(ajaxObj.responseText);
            var name = resp['name'];
            var state = resp['state'];
            var picture = resp['profile_picture'];
            
            document.getElementById('campaign-church').innerHTML = name;
        }

    }}}
    ajaxObj.open("GET", "sql-church.php?id="+ch);
    ajaxObj.send();
}










var verses = {};
    
load_bible_data();
    
function load_bible_data() {
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        document.getElementById('drop-church').innerHTML = "";

        if (ajaxObj.responseText == "no\n") {
            document.getElementById('drop-church').innerHTML += '<div class="drop-group">No search result.</div>';
        } else {
            var resp = JSON.parse(ajaxObj.responseText);

            for (var i = 0; i < Object.keys(resp).length; i++) {

                var bk = Object.keys(resp)[i];
                var chs = resp[bk]['chapters'];
                var vs = resp[bk]['verses'];
                
                verses[bk] = vs;
            }
        }

    }}}
    ajaxObj.open("GET", "bible-chapters-verses.php");
    ajaxObj.send();
}
    
 
    
function search_church() {
    
    var word = document.getElementById('campaign-church');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    document.getElementById('drop-church').style.visibility = "visible";
    
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        document.getElementById('drop-church').innerHTML = "";

        if (ajaxObj.responseText == "no\n") {
            document.getElementById('drop-church').innerHTML += '<div class="drop-group church-group">No search result.</div>';
        } else {
            var resp = JSON.parse(ajaxObj.responseText);

            for (var i = 0; i < Object.keys(resp.church).length; i++) {

                var name = Object.keys(resp.church)[i];
                var state = resp.church[name]['state'];
                var id = resp.church[name]['id'];
                var picture = resp.church[name]['profile_picture'];

                document.getElementById('drop-church').innerHTML += '<div class="drop-item church-item" onclick="select_church(\''+id+'\',\''+name+'\',\''+picture+'\')">'+name+'<span class="church-tag">'+state+'</span></div>';

            }
        }

    }}}
    ajaxObj.open("GET", "search-church.php?church="+word.value);
    ajaxObj.send();
        
}
    
function select_church(ch,name,profile) {
    form_data.church = ch;
    document.getElementById('campaign-church').value = name;
    if (ch == "") {
        $('#profile-preview').attr('src', '../img/choose_image.png');
        $('#profile-preview').hide();
    } else if (profile == "null") {
        $('#profile-preview').show();
        $('#profile-preview').attr('src', '../img/choose_image.png');
    } else {
        $('#profile-preview').show();
        $('#profile-preview').attr('src', '../img/profile/'+profile);
    }
    
    var items = document.getElementsByClassName("church-item");
    for(var i = 0; i < items.length; i++)
    {
       items[i].style.visibility = "hidden";
    }
    var groups = document.getElementsByClassName("church-group");
    for(var i = 0; i < groups.length; i++)
    {
       groups[i].style.visibility = "hidden";
    }
    var tags = document.getElementsByClassName("church-tag");
    for(var i = 0; i < tags.length; i++)
    {
       tags[i].style.visibility = "hidden";
    }

    document.getElementById('drop-church').style.visibility = "hidden";
}

    

    
    

// common email format, checks if exists in database
function search_email() {
    
    var email = document.getElementById('campaign-email');
    
    document.getElementById('error-email').style.visibility = "visible";
    

    if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Email is invalid';
            valid = false;
    }
        
    if (valid) {
        form_data.email = email.value;
        document.getElementById('error-email').className = "error green";
        document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Email is valid';
    }
    
    
    /*
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
    
    */
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
    

function input_password() {
    var pass = document.getElementById('campaign-password');
    var valid = true;

    document.getElementById('error-password').style.visibility = "visible";
    
    if (pass.value.length < 6) {
        
        document.getElementById('error-password').className = "error red";
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Password is too short';
        valid = false;
    } 
    if (pass.value.length > 35) {
        document.getElementById('error-password').className = "error red";
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Password is too long';
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
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Password is valid';
    } else {
        form_data.password = "";
        document.getElementById('error-password').style.visibility = "visible";
        document.getElementById('error-password').className = "error red";
        document.getElementById('error-password').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Passwords must match';
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
        default:
            break;
    }
}

    
    

    
    
var form_profile = false;
var profile_type = "";
function select_profile(prof) {
    
    document.getElementById('error-profile').style.visibility = "visible";
            
    var file = prof.files[0];
    var imagefile = file.type;
    profile_type = file.type.split("/")[1];
        
    var match = ["image/jpeg","image/png","image/jpg","image/gif"];
    
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))) {
        form_profile = false;
        imageNotLoaded();
        $('#campaign-profile-picture').val('');
        document.getElementById('error-profile').className = "error red";
        document.getElementById('error-profile').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Invalid file type (jpg, gif, png)';
    } else {
        if (file.size > 500000) {
            form_profile = false;
            imageNotLoaded();
            $('#campaign-profile-picture').val('');
            document.getElementById('error-profile').className = "error red";
            document.getElementById('error-profile').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Invalid file size. (Max: 500 KB)';
        } else {
            form_profile = true;
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(file);
            document.getElementById('error-profile').className = "error green";
            document.getElementById('error-profile').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Valid image.';
        }
    }
    
}
function imageIsLoaded(e) {
    $('#profile-preview').attr('src', e.target.result);
}  
function imageNotLoaded() {
    $('#profile-preview').attr('src', '../img/choose_image.png');
}
    
    

function submit_form() {
    
    console.log(form_data);
    console.log(quill.getLength());
    
    var edits = document.getElementsByClassName("ql-editor");
    for(var i = 0; i < edits.length; i++) {
        form_description = edits[i].innerHTML;
        console.log(form_description);
    }
    
    var valid = true;
    

    document.getElementById('campaign-url').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-start-date').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-end-date').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-first-name').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-last-name').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-email').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-phone').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-language').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-book').style.border = "1px solid #d1d1d1";
    var editors = document.getElementsByClassName("ql-container");
    for(var i = 0; i < editors.length; i++)
    {
        editors[i].style.borderColor = "#d1d1d1";
    }
    document.getElementById('campaign-total-goal').style.border = "1px solid #d1d1d1";
    document.getElementById('campaign-verse-price').style.border = "1px solid #d1d1d1";
    
    if (form_data.url == "") {
        document.getElementById('campaign-url').style.border = "1px solid #db5353";
        document.getElementById('campaign-url').focus();
        valid = false;
    } else if (form_profile == false) {
        document.getElementById('profile-preview').style.border = "1px solid #db5353";
        document.getElementById('profile-button').focus();
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
    } else if (form_data.language == "") {
        document.getElementById('campaign-language').style.border = "1px solid #db5353";
        document.getElementById('campaign-language').focus();
        valid = false;
    } else if (form_data.book == "") {
        document.getElementById('campaign-book').style.border = "1px solid #db5353";
        document.getElementById('campaign-book').focus();
        valid = false;
    } else if (quill.getLength() <= 1) {
        var editors = document.getElementsByClassName("ql-container");
        for(var i = 0; i < editors.length; i++)
        {
            editors[i].style.borderColor = "#db5353";
        }
        quill.focus();
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
        
        var params = 'church='+church+'&language='+form_data.language+'&book='+form_data.book+'&goal_description='+form_description+'&goal_amount='+form_data.total_goal+'&verse_price='+form_data.verse_price+'&start_date='+form_data.start_date+'&end_date='+form_data.end_date+'&first_name='+form_data.first_name+'&last_name='+form_data.last_name+'&email='+form_data.email+'&phone='+form_data.phone+'&url='+form_data.url+'&profile_type='+profile_type;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText != "no\n") {
                var resp = JSON.parse(ajaxObj.responseText);
                $.ajax({
                    url: "insert-campaign-profile.php?id="+resp['id'],
                    type: "POST",
                    data:  new FormData($('#campaign-profile-picture')),
                    contentType: false,
                    processData:false,
                    success: function(data) {
                        window.location.href = "admin.php";
                    },
                    error: function() {
                        alert("Profile upload error");
                    } 	        
                });
            } else {
                alert("Error occurred");
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