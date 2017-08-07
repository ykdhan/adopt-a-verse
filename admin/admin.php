<?php 
session_start();
if (isset($_SESSION['aav-admin'])) { 
    header('Location: index.php');
} else if (!isset($_SESSION['aav-super-admin'])) { 
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
    
    
    <script type="text/javascript" src="../js/remodal.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/remodal-default-theme.css" />
    <link rel="stylesheet" type="text/css" href="../css/remodal.css" />
    
    
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
        <span id="admin-title"></span>
    </td>
    </tr></table>
</div>
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="landing-wrapper">
        
    <div class="landing-tab-div">
        <div class="landing-tab">
            <button class="capitalize landing-tabs landing-tabs-now" onclick="landing_tab(event, 'tab-church')">Church</button>
            <button class="capitalize landing-tabs" onclick="landing_tab(event, 'tab-campaign')">Campaign</button>
            <button class="capitalize landing-tabs" onclick="landing_tab(event, 'tab-user')">User</button>
        </div>
    </div>
    
    
    <div id="tab-church" class="landing-content landing-content-now">
        
        <input type="text" class="landing-text" id="search-church" onkeyup="search_church()" placeholder="Search">
        
        <div class="landing-add">
            <a href="#add-church"><button type="button" class="landing-button"><img alt="" src="../img/add_new.png">Add Church</button></a>
        </div>

        <div class="list" id="list-church">Not Available</div>
        
    </div>
    
    
    <div id="tab-campaign" class="landing-content">
        <input type="text" class="landing-text" id="search-campaign" onkeyup="search_campaign()" placeholder="Search">
        
        <div class="list" id="list-campaign">Not Available</div>
    </div>
    
    
    <div id="tab-user" class="landing-content">
        <input type="text" class="landing-text" id="search-user" onkeyup="search_user()" placeholder="Search">
        
        <div class="list" id="list-user">Not Available</div>
    </div>
      
    
    
    
</div> <!-- wrapper -->
    
    <div id="footer">
        ©2017 Wycliffe Bible Translators. All rights reserved.
    </div>
</div> <!-- bg -->
    
    
    
    
<div class="remodal" data-remodal-id="add-church" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">Add Church</div>
        <section>
            <div class="col-left">Church</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="admin-text-long" id="add-church" onkeyup="search_add_church()" placeholder="Search for church">
                
                <div class="drop" id="drop-add-church"></div>
                
            </div>
            <div class="col-left">Profile Picture</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <form method="post" enctype="multipart/form-data">
                
                <button type="button" id="select-profile-picture">Choose Image</button>
                <div class="error" id="error-profile-picture"></div>
                
                <input type="file" id="input-profile-picture" hidden onchange="select_profile_picture(this)">
                </form>
                
            </div>
            <div class="col-left">Preview</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <div id="preview-profile-picture"></div>
                <img alt="preview" src="" id="preview" hidden>

            </div>
        </section>
        <section class="last-section">
            <button type="button" class="admin-submit" onclick="add_church()">Add Church</button>
        </section>
    </div>
</div>

    
    
    
    

    

<script>
    
search_church();
    
function search_church() {
    
    var word = document.getElementById('search-church');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-church').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-church').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var state = resp[num]['state'];
                    var church = resp[num]['name'];
                    var profile_picture = resp[num]['profile_picture'];
                    
                    var image = "";
                    
                    if (profile_picture != null) {
                        image = '../img/profile/'+profile_picture;
                    } else {
                        image = '../img/choose_image.png';
                    }

                    document.getElementById('list-church').innerHTML += '<div class="list-item" onclick="select_church(\''+num+'\')"><div class="col-church-profile-picture" style="background-image: url(\''+image+'\')"></div><div class="col-church-name">'+church+'</div><div class="col-church-state">'+state+'</div></div>';
                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-churches.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
function select_church(id) {
    
    if (id == "") {

    } else {
        window.location.href = "church.php?id="+id;
    }
    
}
    
    
    

var view_campaign = "";
    
search_campaign();
    
function search_campaign() {
    
    var word = document.getElementById('search-campaign');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-campaign').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-campaign').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var state = resp[num]['state'];
                    var church = resp[num]['name'];
                    var language = resp[num]['people_group'];
                    var book = resp[num]['book'];

                    document.getElementById('list-campaign').innerHTML += '<div class="list-item" onclick="select_campaign(\''+num+'\')"><div class="col-campaign-book">'+book+'<br><div class="col-campaign-language">'+language+'</div></div><div class="col-campaign-church">'+church+'</div></div>';

                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-campaigns.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
function select_campaign(id) {
    
    if (id == "") {

    } else {
        view_campaign = id;
        window.location.href = "admin.php#view-campaign";
    }
    
}

    
    
    
    
search_user();
    
function search_user() {
    
    var word = document.getElementById('search-user');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-user').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-user').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var first_name = resp[num]['first_name'];
                    var last_name = resp[num]['last_name'];
                    var role = resp[num]['role'];
                    
                    var admin = "";
                    
                    if (role == "campaign_admin") {
                        admin = "A";
                    } else if (role == "wycliffe_admin") {
                        admin = "W";
                    }

                    document.getElementById('list-user').innerHTML += '<div class="list-item" onclick="select_user(\''+num+'\')"><div class="col-user-name">'+first_name+' '+last_name+'</div><div class="col-user-role">'+admin+'</div></div>';
                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-users.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
function select_user(id) {
    
    if (id == "") {

    } else {
        window.location.href = "church.php?id="+id;
    }
    
}


    
function landing_tab(evt, tabName) {

    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("landing-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("landing-tabs");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" landing-tabs-now", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " landing-tabs-now";
    

}
    
    
    
    
    
    
// ADD CHURCH

var form_profile = false;
var profile_type = "";
function select_profile_picture(prof) {
    
    document.getElementById('error-profile-picture').style.visibility = "visible";
            
    var file = prof.files[0];
    var imagefile = file.type;
    profile_type = file.type.split("/")[1];
        
    var match = ["image/jpeg","image/png","image/jpg","image/gif"];
    
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))) {
        form_profile = false;
        imageNotLoaded();
        $('#input-profile-picture').val('');
        document.getElementById('error-profile-picture').className = "error red";
        document.getElementById('error-profile-picture').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Invalid file type (jpg, gif, png)';
    } else {
        if (file.size > 2000000) {
            form_profile = false;
            imageNotLoaded();
            $('#input-profile-picture').val('');
            document.getElementById('error-profile-picture').className = "error red";
            document.getElementById('error-profile-picture').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Invalid file size (Max: 2 MB)';
        } else {
            form_profile = true;
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(file);
            document.getElementById('error-profile-picture').className = "error green";
            document.getElementById('error-profile-picture').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Valid image';
        }
    }
    
}
function imageIsLoaded(e) {
    $('img[alt="preview"]').attr('src', e.target.result);
    $('#preview-profile-picture').css({backgroundImage: 'url("'+$('img[alt="preview"]').attr('src')+'")'});
}  
function imageNotLoaded() {
    $('#preview-preview-picture').css({backgroundImage: 'url("../../img/choose_image.png")'});
}

function add_church () {
    
    var valid = true;
    
    document.getElementById('select-profile-picture').style.borderColor = "#d1d1d1";
    
    if (document.getElementById('input-profile-picture').value == '') {
        document.getElementById('select-profile-picture').style.borderColor = "#db5353";
        document.getElementById('select-profile-picture').focus();
        valid = false;
    }
    
    if (valid) {
        
        $.ajax({
            url: "sql-update-church-profile-picture.php?id="+church_id,
            type: "POST",
            data:  new FormData($('#input-profile-picture')),
            contentType: false,
            processData:false,
            success: function(data) {
                console.log(data);
                window.location.href = "church.php?id="+church_id+"#";
            },
            error: function(data) {
                console.log(data);
                alert("Error: Edit Profile Picture");
            } 	        
        });
        
    }
    
}

    
    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>