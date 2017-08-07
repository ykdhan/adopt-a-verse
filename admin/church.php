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
    <script type="text/javascript" src="../js/sidebar.js"></script>
    
    
    <script type="text/javascript" src="../js/remodal.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/remodal-default-theme.css" />
    <link rel="stylesheet" type="text/css" href="../css/remodal.css" />
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
        <span id="admin-title">Church</span>
    </td>
    </tr></table>
</div>
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="church-wrapper">
    
    
    <div id="section-profile" class="church-section">
        <div id="content-profile" class="church-content">
            <div class="church-title">Profile</div>
            <a href="#edit-profile-picture"><div id="church-profile-picture"><span><i class="fa fa-pencil" aria-hidden="true"></i> Change Picture</span></div></a>
            <div id="church-name"></div>
            <div id="church-state"></div>
        </div>
    </div><div id="section-admins" class="church-section">
        <div id="content-admins" class="church-content">
            <div class="church-title">Administrators
                <a href="#add-admin"><img class="button-admin-add" alt="" src="../img/plus_admin.svg"></a>
            </div>
            <div id="church-admins">
                
                <!-- church administrators -->
                
            </div>
        </div>
    </div><div id="section-campaigns" class="church-section">
        <div id="content-campaigns" class="church-content">
            <div class="church-title" id="church-campaign-bar">Campaigns
                
                <!-- only Wycliffe admins can create campaigns -->
                <?php if (isset($_SESSION['aav-super-admin'])) { echo '<a href="#add-campaign"><img class="button-admin-add" alt="" src="../img/plus_admin.svg"></a>'; } ?>
                
            </div>
            <div id="church-campaigns">
                
                <!-- church campaigns -->
                
            </div>
        </div>
    </div>
    
    
    <div id="footer">
        ©2017 Wycliffe Bible Translators. All rights reserved.
    </div>
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    
    
<div class="remodal" data-remodal-id="edit-profile-picture" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <form method="post" enctype="multipart/form-data">
        
        <div id="title">Change Profile Picture</div>
        <section>
            <div class="col-left">Image File</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <button type="button" id="select-profile-picture">Choose Image</button>
                <div class="error" id="error-profile-picture"></div>
                
                <input type="file" id="input-profile-picture" name="input-profile-picture" hidden onchange="select_profile_picture(this)">
                
            </div>
            <div class="col-left">Preview</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <div id="preview-profile-picture"></div>
                <img alt="preview" src="" id="preview" hidden>

            </div>
        </section>
        <section class="last-section">
            <button type="button" class="admin-submit" id="button-edit-profile-picture" onclick="edit_profile_picture()">Change Image</button>
        </section>
        
        </form>
    </div>
</div>

    

    
<div class="remodal" data-remodal-id="add-admin" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">New Administrator</div>
        <section>
            <div class="col-left">Church</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <p id="admin-church"></p>
            </div>
        </section>
        <section>
            <div class="col-left">Account</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <input type="text" class="admin-text" id="admin-first-name" placeholder="First Name" onkeyup="input_form('first-name')">
                <input type="text" class="admin-text" id="admin-last-name" placeholder="Last Name" onkeyup="input_form('last-name')">
            </div>
            <div class="col-left"></div>
            <div class="col-tip"></div>
            <div class="col-right">
                <input type="text" class="admin-text" id="admin-email" placeholder="Email Address"><span class="error" id="error-email"></span><br>
            </div>
            <div class="col-left"></div>
            <div class="col-tip"></div>
            <div class="col-right">
                <input type="text" class="admin-text" id="admin-phone" placeholder="Phone Number" onkeyup="input_form('phone')">
            </div>
        </section>
        <section class="last-section">
            <p class="message">An email will be sent to the new user to set up their account password.</p>
            <button type="button" class="admin-submit" onclick="add_admin()">Create Admin</button>
        </section>
    </div>
</div>

    
    
    
<div class="remodal" data-remodal-id="add-campaign" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">New Campaign</div>
        <section>
            
            
            <div class="col-left">Church</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="new-church"></p>

            </div>
            <div class="col-left">Campaign Url</div>
            <div class="col-tip"></div>
            <div class="col-right">adopt.wycliffe.org/ <input type="text" class="admin-text" id="new-url" placeholder="church-name"><span class="error" id="error-url"></span>
            </div>
            <div class="col-left">Campaign Duration</div>
            <div class="col-tip"></div>
            <div class="col-right"><input type="date" class="admin-text" id="new-start-date" onchange="select_start_date(this)">&nbsp; to &nbsp;<input type="date" class="admin-text" id="new-end-date" onchange="select_end_date(this)"></div>
        </section>
        <section>
            <div class="col-left">Language</div>
            <div class="col-tip"></div>
            <div class="col-right">
            
                <input type="text" class="admin-text-long" id="new-language" onkeyup="search_language()" placeholder="Search for language">
                
                <div class="drop" id="drop-language"></div>
                
            </div>
            <div class="col-left">Book</div>
            <div class="col-tip"></div>
            <div class="col-right">
            
                <input type="text" class="admin-text-long" id="new-book" onkeyup="search_book()" placeholder="Search for book of the Bible">
                
                <div class="drop" id="drop-book"></div>
                
                <span id="num-verses"></span>
                
            </div>
        </section>
        <section>
            
            <div class="col-left">Total Goal Amount</div>
            <div class="col-tip"></div>
            <div class="col-right">&#36;&nbsp; <input type="text" id="new-total-goal" class="admin-text small" onkeyup="input_fund('total')" placeholder="0"><span class="error" id="error-total"></span></div>
            <div class="col-left">Cost per Verse</div>
            <div class="col-tip"></div>
            <div class="col-right">&#36;&nbsp; <input type="text" id="new-verse-price" class="admin-text small" onkeyup="input_fund('verse')" placeholder="0"><span class="error" id="error-verse"></span></div>
            <div class="col-left">Goal Description</div>
            <div class="col-tip"><span class="tool-tip">?<div class="tooltip">This message will appear on the "Our Campaign Goal" tab of your campaign.</div></span></div>
            <div class="col-right">
                <div id="new-goal-description" class="text-editor">
                    
                </div>
            </div>
            
        </section>
        <section class="last-section">
            <button type="button" class="admin-submit" onclick="add_campaign()">Create Campaign</button>
        </section>
    </div>
</div>
    
    
    

<div class="remodal" data-remodal-id="campaign-details" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">Campaign Details</div>
        <section>
            <div class="col-left">Campaign Url</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <p id="details-url">adopt.wycliffe.org</p>
            </div>
            <div class="col-left">Campaign Duration</div>
            <div class="col-tip"></div>
            <div class="col-right" id="campaign-duration">
                <input type="date" class="admin-text" id="details-start-date" onchange="edit_start_date(this)">&nbsp; to &nbsp;<input type="date" class="admin-text" id="details-end-date" onchange="edit_end_date(this)">
            </div>
        </section>
        <section>
            <div class="col-left">Language</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <p id="details-language"></p>
            </div>
            <div class="col-left">Book</div> 
            <div class="col-tip"></div>
            <div class="col-right">
                <p id="details-book"></p>
            </div>
        </section>
        <section>
            <div class="col-left">Total Goal Amount</div>
            <div class="col-tip"></div>
            <div class="col-right"><p id="details-goal-amount">&#36; 100,000</p>
            </div>
            <div class="col-left">Cost per Verse</div>
            <div class="col-tip"></div>
            <div class="col-right"><p id="details-verse-price">&#36; 1.50</p>
            </div>
            <div class="col-left">Goal Description</div>
            <div class="col-tip"><span class="tool-tip">?<div class="tooltip">This message will appear on the "Our Campaign Goal" tab of your campaign.</div></span></div>
            <div class="col-right" id="campaign-goal-description">
                <div id="details-goal-description" class="text-editor">

                </div>
            </div>
        </section>
        <section class="last-section" id="details-buttons">
            
        </section>
    </div>
</div>

    
    
    
    

<script>
    
var page_param = window.location.search.substring(1);
var page_url = new URL(window.location.href);
var church_id = page_url.searchParams.get("id");
    
$("#select-profile-picture").click(function(){
    $("#input-profile-picture").click();
});

    
var campaigns = {};
var campaign_id = "";
var campaign_status = "";
    
search_church();
function search_church() {
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            if (ajaxObj.responseText == "no\n") {
                alert("Church not found");
                window.location.href = "index.php";
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                var state = resp['state'];
                var church = resp['name'];
                var profile_pic = resp['profile_picture'];

                document.getElementById('church-name').innerHTML = church;
                document.getElementById('admin-church').innerHTML = church;
                document.getElementById('new-church').innerHTML = church;
                document.getElementById('church-state').innerHTML = state;
                
                if (profile_pic != null) {
                    document.getElementById('church-profile-picture').style.backgroundImage = 'url("../img/profile/'+profile_pic+'")';
                }
                
            }
            
        }}}
        ajaxObj.open("GET", "sql-church.php?id="+church_id);
        ajaxObj.send();
    
}
    
    
search_admins();
function search_admins() {
    console.log("admins");
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        document.getElementById('church-admins').innerHTML = "";

        if (ajaxObj.responseText == "no\n") {
            console.log("no admins");
            document.getElementById('church-admins').innerHTML = "<span style='float: left; text-align: left;'>Please add church admins</span>";
        } else {
            var resp = JSON.parse(ajaxObj.responseText);

            for (var i = 0; i < Object.keys(resp.verified).length; i++) {

                var num = Object.keys(resp.verified)[i];
                var first_name = resp.verified[num]['first_name'];
                var last_name = resp.verified[num]['last_name'];
                var email = resp.verified[num]['email'];
                
                document.getElementById('church-admins').innerHTML += '<div class="church-admin" onmouseover="show_delete('+num+')" onmouseout="hide_delete('+num+')"><div class="church-admin-name">'+first_name+' '+last_name+'</div><div class="church-admin-email">'+email+'</div><div class="church-admin-delete"><img alt="" src="../img/delete.svg" id="delete-'+num+'" onclick="delete_admin('+num+')"></div></div>';
            }
            
            for (var i = 0; i < Object.keys(resp.pending).length; i++) {

                var num = Object.keys(resp.pending)[i];
                var first_name = resp.pending[num]['first_name'];
                var last_name = resp.pending[num]['last_name'];
                var email = resp.pending[num]['email'];

                document.getElementById('church-admins').innerHTML += '<div class="church-admin" onmouseover="show_delete('+num+')" onmouseout="hide_delete('+num+')"><div class="church-admin-name">'+first_name+' '+last_name+'</div><div class="church-admin-email">'+email+'</div><div class="church-admin-delete"><img alt="" src="../img/delete.svg" id="delete-'+num+'" onclick="delete_admin('+num+')"></div><div class="church-admin-pending">Pending</div></div>';
            }
            
            
            
        }

    }}}
    ajaxObj.open("GET", "sql-church-admins.php?id="+church_id);
    ajaxObj.send();
    
}

/*
search_admins_pending();
function search_admins_pending() {
    console.log("admins_pending");
    var ajaxObj2 = new XMLHttpRequest();
    ajaxObj2.onreadystatechange= function() { if(ajaxObj2.readyState == 4) { if(ajaxObj2.status == 200) {

        if (ajaxObj2.responseText == "no\n") {
            console.log("no pending admins");
            if (document.getElementById('church-admins').innerHTML == "") {
                document.getElementById('church-admins').innerHTML = "<span style='float: left; text-align: left;'>Please add church admins</span>";
            }
        } else {
            var resp = JSON.parse(ajaxObj2.responseText);

            for (var i = 0; i < Object.keys(resp).length; i++) {

                var num = Object.keys(resp)[i];
                var first_name = resp[num]['first_name'];
                var last_name = resp[num]['last_name'];
                var email = resp[num]['email'];
                var verified = resp[num]['verified'];

                document.getElementById('church-admins').innerHTML += '<div class="church-admin" onmouseover="show_delete('+num+')" onmouseout="hide_delete('+num+')"><div class="church-admin-name">'+first_name+' '+last_name+'</div><div class="church-admin-email">'+email+'</div><div class="church-admin-delete"><img alt="" src="../img/delete.svg" id="delete-'+num+'" onclick="delete_admin('+num+')"></div><div class="church-admin-pending">Pending</div></div>';
            }
        }

    }}}
    ajaxObj2.open("GET", "sql-church-admins-pending.php?id="+church_id);
    ajaxObj2.send();
}
*/
    
search_campaigns();
function search_campaigns() {
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('church-campaigns').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                console.log("no campaigns");
                document.getElementById('church-campaigns').innerHTML = "Please contact Wycliffe to set up church campaigns";
            
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    
                    var book = resp[num]['book'];
                    var language = resp[num]['language'];
                    var goal_description = resp[num]['goal_description'];
                    var goal_amount = resp[num]['goal_amount'];
                    var verse_price = resp[num]['verse_price'];
                    var start_date = resp[num]['start_date'];
                    var end_date = resp[num]['end_date'];
                    var url = resp[num]['url'];
                    var status = resp[num]['status'];
                    
                    campaigns[num] = {};
                    campaigns[num]['book'] = book;
                    campaigns[num]['language'] = language;
                    campaigns[num]['goal_description'] = goal_description;
                    campaigns[num]['goal_amount'] = goal_amount;
                    campaigns[num]['verse_price'] = verse_price;
                    campaigns[num]['start_date'] = start_date;
                    campaigns[num]['end_date'] = end_date;
                    campaigns[num]['url'] = url;
                    campaigns[num]['status'] = status;
                    
                    var goal = parseFloat(goal_amount.toString().replace(/,/g,''));
                    goal_amount = goal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    var verse = parseFloat(verse_price.toString().replace(/,/g,''));
                    verse_price = verse.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    if (status == "inprogress") {
                        document.getElementById('church-campaigns').innerHTML += '<div class="church-campaign-div"><a href="#campaign-details"><div class="church-campaign" onclick="select_campaign(\''+num+'\')"><div class="church-campaign-top">'+start_date+' - '+end_date+'<span class="church-campaign-status active">In Progress</span></div><div class="church-campaign-book">'+book+'</div><div class="church-campaign-language">'+language+'</div><div class="church-campaign-raised">$450</div><div class="church-campaign-goal">$'+goal_amount+'</div><div class="church-campaign-bottom"><div class="church-campaign-bar"><div class="church-campaign-progress" style="width: 45%;"></div></div><div class="church-campaign-percent">45%</div></div></div></a></div>';
                    } else if (status == "coming") {
                        document.getElementById('church-campaigns').innerHTML += '<div class="church-campaign-div"><a href="#campaign-details"><div class="church-campaign coming" onclick="select_campaign(\''+num+'\')"><div class="church-campaign-top">'+start_date+' - '+end_date+'<span class="church-campaign-status coming">Scheduled</span></div><div class="church-campaign-book">'+book+'</div><div class="church-campaign-language">'+language+'</div><div class="church-campaign-raised">$0</div><div class="church-campaign-goal">$'+goal_amount+'</div><div class="church-campaign-bottom"><div class="church-campaign-bar"><div class="church-campaign-progress coming"></div></div><div class="church-campaign-percent coming">0%</div></div></div></a></div>';
                    } else if (status == "complete") {
                        document.getElementById('church-campaigns').innerHTML += '<div class="church-campaign-div"><a href="#campaign-details"><div class="church-campaign complete" onclick="select_campaign(\''+num+'\')"><div class="church-campaign-top">'+start_date+' - '+end_date+'<span class="church-campaign-status complete">Complete</span></div><div class="church-campaign-book">'+book+'</div><div class="church-campaign-language">'+language+'</div><div class="church-campaign-raised">$450</div><div class="church-campaign-goal">$'+goal_amount+'</div><div class="church-campaign-bottom"><div class="church-campaign-bar"><div class="church-campaign-progress complete" style="width: 95%;"></div></div><div class="church-campaign-percent complete">95%</div></div></div></a></div>';
                    }
                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-church-campaigns.php?id="+church_id);
        ajaxObj.send();
    
}

    
    
    
function show_delete(admin) {
    document.getElementById('delete-'+admin).style.visibility = "visible";
}
function hide_delete(admin) {
    document.getElementById('delete-'+admin).style.visibility = "hidden";
}
    
function delete_admin(admin) {
    console.log("delete- "+admin);
    
    if(confirm("Delete admin?")) {
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "yes\n") {
                console.log("deleted");
                search_admins();
            } else {
                console.log("Error: delete admin");
            }

        }}}
        ajaxObj.open("GET", "sql-delete-church-admin.php?id="+admin);
        ajaxObj.send();
    }
    
}
    
function delete_campaign(campaign) {
    console.log("delete- "+campaign);
    
    if(confirm("Delete campaign?")) {
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "yes\n") {
                console.log("deleted");
                window.location.href = "church.php?id="+church_id+"#";
                search_campaigns();
            } else {
                console.log("Error: delete campaign");
            }

        }}}
        ajaxObj.open("GET", "sql-delete-church-campaign.php?id="+campaign);
        ajaxObj.send();
    }
}
    
    
    
    
    
// EDIT PROFILE PICTURE
var formdata = new FormData();
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
            
            formdata.append("input_profile_picture", file);
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

function edit_profile_picture () {
    
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
            data:  formdata,
            contentType: false,
            processData:false,
            success: function(data) {
                console.log(data);
                if (data == "yes\n\n\n") {
                    window.location.href = "church.php?id="+church_id+"#";
                    search_church();
                } else {
                    alert("Error: "+data);
                }
            }      
        });
        
    }
    
}


    
    
    
    
// VIEW/EDIT CAMPAIGNS

var details_goal_description = "";     // text editor
    
var details_description = "";
var details_data = {
    start_date: "",
    end_date: ""
    
    // goal description = form_description
}
    
function select_campaign(num) {
    campaign_id = num;
}

function edit_start_date(e) {
    var start_now = new Date(e.value);
    var start_day = ("0" + start_now.getDate()).slice(-2);
    var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);
    var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
    
    var today = new Date();
    if (start_now < today) {
        e.style.borderColor = "#db5353";
        details_data.start_date = "";
        alert("Invalid duration");
    } else {
        e.style.borderColor = "#d1d1d1";
        details_data.start_date = e.value;
        document.getElementById('details-end-date').focus();
    }
    
}
function edit_end_date(e) {
    
    var start_now = new Date(details_data.start_date);
    var start_day = ("0" + start_now.getDate()).slice(-2);
    var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);

    var end_now = new Date(e.value);
    var end_day = ("0" + end_now.getDate()).slice(-2);
    var end_month = ("0" + (end_now.getMonth() + 1)).slice(-2);

    var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
    var end_date = end_now.getFullYear()+"-"+(end_month)+"-"+(end_day);

    var today = new Date();
    if (start_date >= end_date || today > end_date) {
        e.style.borderColor = "#db5353";
        details_data.end_date = "";
        alert("Invalid duration");
    } else {
        e.style.borderColor = "#d1d1d1";
        details_data.end_date = e.value;
    }
    
}
    
function edit_campaign(campaign) {
    console.log(details_data);
    console.log(details_goal_description.getLength());
    
    var edits = document.getElementById('details-goal-description').getElementsByClassName("ql-editor");
    for(var i = 0; i < edits.length; i++) {
        details_description = edits[i].innerHTML;
        console.log(details_description);
    }
    
    var valid = true;
    
    if ( $( "#details-start-date" ).length ) {
        document.getElementById('details-start-date').style.border = "1px solid #d1d1d1";
    }
    document.getElementById('details-end-date').style.border = "1px solid #d1d1d1";
    $( "#details-goal-description.ql-container" ).css( "border", "1px solid #d1d1d1" );
    

    if (details_data.start_date == "") {
        document.getElementById('details-start-date').style.border = "1px solid #db5353";
        document.getElementById('details-start-date').focus();
        valid = false;
    } else if (details_data.end_date == "") {
        document.getElementById('details-end-date').style.border = "1px solid #db5353";
        document.getElementById('details-end-date').focus();
        valid = false;
    } else if (details_goal_description.getLength() <= 1) {
        $( "#details-goal-description.ql-container" ).css( "border", "1px solid #db5353" );
        details_goal_description.focus();
        valid = false;
    } 
    
    
    if (valid) {
        
        var params = 'id='+campaign+'&goal_description='+details_description+'&start_date='+details_data.start_date+'&end_date='+details_data.end_date;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {
                
                window.location.href = "church.php?id="+church_id+"#";
                search_campaigns();
            }
            
        }}}
        ajaxObj.open("GET", "sql-update-church-campaign.php?"+params);
        ajaxObj.send();
        
        
        
    }
}
        
    
    
    
    
    
    
    
// ADD ADMIN
    
var admin_data = {
    first_name: "",
    last_name: "",
    phone: "",
    email: ""
}
    
function search_email() {
    
    var email = document.getElementById('admin-email');
    
    document.getElementById('error-email').style.visibility = "visible";

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        
        var valid = true;
        admin_data.email = "";
        
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
            admin_data.email = email.value;
            document.getElementById('error-email').className = "error green";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Email is valid';
        }

    }}}
    ajaxObj.open("GET", "sql-check-email.php?email="+email.value);
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
            admin_data.first_name = document.getElementById('admin-first-name').value;
            break;
        case 'last-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            admin_data.last_name = document.getElementById('admin-last-name').value;
            break;
        case 'phone':
            word.value = word.value.replace(/[^0-9\)-\.\+\s]+/, '');
            admin_data.phone = document.getElementById('admin-phone').value;
            break;
        default:
            break;
    }
}
    
function add_admin() {
    
    var valid = true;
    
    document.getElementById('admin-first-name').style.border = "1px solid #d1d1d1";
    document.getElementById('admin-last-name').style.border = "1px solid #d1d1d1";
    document.getElementById('admin-email').style.border = "1px solid #d1d1d1";
    document.getElementById('admin-phone').style.border = "1px solid #d1d1d1";
    
    if (admin_data.first_name == "") {
        document.getElementById('admin-first-name').style.border = "1px solid #db5353";
        document.getElementById('admin-first-name').focus();
        valid = false;
    } else if (admin_data.last_name == "") {
        document.getElementById('admin-last-name').style.border = "1px solid #db5353";
        document.getElementById('admin-last-name').focus();
        valid = false;
    } else if (admin_data.email == "") {
        document.getElementById('admin-email').style.border = "1px solid #db5353";
        document.getElementById('admin-email').focus();
        valid = false;
    } else if (admin_data.phone == "") {
        document.getElementById('admin-phone').style.border = "1px solid #db5353";
        document.getElementById('admin-phone').focus();
        valid = false;
    }
    
    if (valid) {
        
        var params = 'church='+church_id+'&first_name='+admin_data.first_name+'&last_name='+admin_data.last_name+'&email='+admin_data.email+'&phone='+admin_data.phone;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            

            if (ajaxObj.responseText == "yes\n\n\n") {
                
                window.location.href = "church.php?id="+church_id+"#";
                search_admins();
                
                
            } else {
                alert("Error occurred");
            }
            
        }}}
        ajaxObj.open("GET", "sql-insert-church-admin.php?"+params);
        ajaxObj.send();
        
    }
}
    
    
    
    
// ADD CAMPAIGN
        
var new_goal_description = new Quill('#new-goal-description', {
    theme: 'snow'
});

var campaign_description = "";
var campaign_data = {
    url: "",
    start_date: "",
    end_date: "",
    language: "",
    book: "",
    total_goal: "",
    verse_price: ""
    
    // goal description = form_description
}
    
var verses = {};
    
load_bible_data();
    
function load_bible_data() {
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        if (ajaxObj.responseText == "no\n") {
            alert("Error: load_bible_data");
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
    ajaxObj.open("GET", "sql-chapters-verses.php");
    ajaxObj.send();
}


function search_book() {
    
    var word = document.getElementById('new-book');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    document.getElementById('drop-book').style.visibility = "visible";
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('drop-book').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('drop-book').innerHTML += '<div class="drop-group book-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var book = Object.keys(resp)[i];
                    var verses = resp[book];

                    document.getElementById('drop-book').innerHTML += '<div class="drop-item book-item" onclick="select_book(\''+book+'\')">'+book+'<span class="book-tag">'+verses.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+' verses</span></div>';

                }
            }
            
        }}}
        ajaxObj.open("GET", "search-book.php?book="+word.value);
        ajaxObj.send();
        
}

function select_book(bk) {
    campaign_data.book = bk;
    document.getElementById('new-book').value = bk;
    
    if (bk == "") {
        document.getElementById('num-verses').innerHTML = "";
    } else {
        document.getElementById('num-verses').innerHTML = verses[bk].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" verses";
    }
    
    
    var items = document.getElementsByClassName("book-item");
    for(var i = 0; i < items.length; i++)
    {
       items[i].style.visibility = "hidden";
    }
    var groups = document.getElementsByClassName("book-group");
    for(var i = 0; i < groups.length; i++)
    {
       groups[i].style.visibility = "hidden";
    }
    var tags = document.getElementsByClassName("book-tag");
    for(var i = 0; i < tags.length; i++)
    {
       tags[i].style.visibility = "hidden";
    }

    document.getElementById('drop-book').style.visibility = "hidden";
}

    
function search_language() {
    
    var word = document.getElementById('new-language');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    document.getElementById('drop-language').style.visibility = "visible";
    
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        document.getElementById('drop-language').innerHTML = "";

        if (ajaxObj.responseText == "no\n") {
            document.getElementById('drop-language').innerHTML += '<div class="drop-group language-group">No search result.</div>';
        } else {
            var resp = JSON.parse(ajaxObj.responseText);

            for (var i = 0; i < Object.keys(resp.language).length; i++) {

                var name = Object.keys(resp.language)[i];
                var region = resp.language[name]['region'];
                var id = resp.language[name]['id'];

                document.getElementById('drop-language').innerHTML += '<div class="drop-item language-item" onclick="select_language(\''+id+'\',\''+name+'\')">'+name+'<span class="language-tag">'+region+'</span></div>';

            }
        }

    }}}
    ajaxObj.open("GET", "search-language.php?language="+word.value);
    ajaxObj.send();
        
}
    
function select_language(lang,name) {
    campaign_data.language = lang;
    document.getElementById('new-language').value = name;
    
    var items = document.getElementsByClassName("language-item");
    for(var i = 0; i < items.length; i++)
    {
       items[i].style.visibility = "hidden";
    }
    var groups = document.getElementsByClassName("language-group");
    for(var i = 0; i < groups.length; i++)
    {
       groups[i].style.visibility = "hidden";
    }
    var tags = document.getElementsByClassName("language-tag");
    for(var i = 0; i < tags.length; i++)
    {
       tags[i].style.visibility = "hidden";
    }

    document.getElementById('drop-language').style.visibility = "hidden";
}
    
    
// length: 6~30   characters: a-z 0-9 _ -   checks if exists in database
function search_url() {
    
    var word = document.getElementById('new-url');

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        var valid = true;
        campaign_data.url = "";
        document.getElementById('error-url').style.visibility = "visible";
        
        if (word.value.length < 6) {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">URL is too short';
            valid = false;
        }
        
        if (word.value.length > 30) {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">URL is too long';
            valid = false;
        }
        
        if (ajaxObj.responseText == "exist\n") {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">URL already exists';
            valid = false;
        }

        if (valid) {
            document.getElementById('error-url').className = "error green";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">URL is valid';
            campaign_data.url = word.value;
        }

    }}}
    ajaxObj.open("GET", "search-url.php?url="+word.value);
    ajaxObj.send();
        
}
    

function select_start_date(e) {
    var start_now = new Date(e.value);
    var start_day = ("0" + start_now.getDate()).slice(-2);
    var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);
    var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
    
    var today = new Date();
    if (start_now < today) {
        e.style.borderColor = "#db5353";
        campaign_data.start_date = "";
        alert("Invalid duration");
    } else {
        e.style.borderColor = "#d1d1d1";
        campaign_data.start_date = e.value;
        document.getElementById('new-end-date').focus();
    }
    
}
function select_end_date(e) {
    
    var start_now = new Date(campaign_data.start_date);
    var start_day = ("0" + start_now.getDate()).slice(-2);
    var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);

    var end_now = new Date(e.value);
    var end_day = ("0" + end_now.getDate()).slice(-2);
    var end_month = ("0" + (end_now.getMonth() + 1)).slice(-2);

    var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
    var end_date = end_now.getFullYear()+"-"+(end_month)+"-"+(end_day);

    if (start_date >= end_date) {
        e.style.borderColor = "#db5353";
        campaign_data.end_date = "";
        alert("Invalid duration");
    } else {
        e.style.borderColor = "#d1d1d1";
        campaign_data.end_date = e.value;
        document.getElementById('new-language').focus();
    }
    
}
    

$( "#new-language" ).focusout(function() {
    select_language("","");
});    
$( "#new-book" ).focusout(function() {
    select_book("");
});    
$( "#new-url" ).focusout(function() {
    search_url();
});
    
function input_fund(title) {

    var money_total = document.getElementById('new-total-goal');
    var money_verse = document.getElementById('new-verse-price');

    
    if (title == 'total') {
        money_total.value = money_total.value.replace(/[^0-9\.,]+/, '');
        var before = parseFloat(money_total.value.toString().replace(/,/g,''));
        money_total.value = before.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var valid = true;
        campaign_data.total_goal = "";
        
        if (campaign_data.book == "") {
            document.getElementById('error-total').style.visibility = "visible";
            document.getElementById('error-total').className = "error red";
            document.getElementById('error-total').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Book is not selected';
            valid = false;
            money_total.value = "";
        }
        
        if (valid) {
            document.getElementById('error-total').style.visibility = "hidden";
            
            var pure = parseFloat(money_total.value.toString().replace(/,/g,''));
            campaign_data.total_goal = pure;
            
            money_verse.value = (pure/parseFloat(verses[campaign_data.book])).toFixed(2);
            
            campaign_data.verse_price = money_verse.value;
            
            money_verse.value = money_verse.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        
    } else if (title == 'verse') {
        money_verse.value = money_verse.value.replace(/[^0-9\.,]+/, '');
        var before = parseFloat(money_verse.value.toString().replace(/,/g,''));
        money_verse.value = before.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        var valid = true;
        campaign_data.verse_price = "";
        
        if (campaign_data.book == "") {
            document.getElementById('error-verse').style.visibility = "visible";
            document.getElementById('error-verse').className = "error red";
            document.getElementById('error-verse').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Book is not selected';
            valid = false;
            money_verse.value = "";
        }
        
        if (valid) {
            document.getElementById('error-verse').style.visibility = "hidden";
            
            var pure = parseFloat(money_verse.value.toString().replace(/,/g,''));
            campaign_data.verse_price = pure;
            
            money_total.value = (pure*parseFloat(verses[campaign_data.book])).toFixed(2);
            
            campaign_data.total_goal = money_total.value;
            
            money_total.value = money_total.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }
    
}
    
function input_url() {
    var word = document.getElementById('new-url');
    word.value = word.value.replace(/[^a-z0-9_-]+/, '');
}
    
    
    
function add_campaign() {
    console.log(campaign_data);
    console.log(new_goal_description.getLength());
    
    var edits = document.getElementById('new-goal-description').getElementsByClassName("ql-editor");
    for(var i = 0; i < edits.length; i++) {
        campaign_description = edits[i].innerHTML;
        console.log(campaign_description);
    }
    
    var valid = true;
    

    document.getElementById('new-url').style.border = "1px solid #d1d1d1";
    document.getElementById('new-start-date').style.border = "1px solid #d1d1d1";
    document.getElementById('new-end-date').style.border = "1px solid #d1d1d1";
    document.getElementById('new-language').style.border = "1px solid #d1d1d1";
    document.getElementById('new-book').style.border = "1px solid #d1d1d1";
    document.getElementById('new-total-goal').style.border = "1px solid #d1d1d1";
    document.getElementById('new-verse-price').style.border = "1px solid #d1d1d1";
    $( "#new-goal-description.ql-container" ).css( "border", "1px solid #d1d1d1" );
    
    
    if (campaign_data.url == "") {
        document.getElementById('new-url').style.border = "1px solid #db5353";
        document.getElementById('new-url').focus();
        valid = false;
    } else if (campaign_data.start_date == "") {
        document.getElementById('new-start-date').style.border = "1px solid #db5353";
        document.getElementById('new-start-date').focus();
        valid = false;
    } else if (campaign_data.end_date == "") {
        document.getElementById('new-end-date').style.border = "1px solid #db5353";
        document.getElementById('new-end-date').focus();
        valid = false;
    } else if (campaign_data.language == "") {
        document.getElementById('new-language').style.border = "1px solid #db5353";
        document.getElementById('new-language').focus();
        valid = false;
    } else if (campaign_data.book == "") {
        document.getElementById('new-book').style.border = "1px solid #db5353";
        document.getElementById('new-book').focus();
        valid = false;
    } else if (campaign_data.total_goal == "") {
        document.getElementById('new-total-goal').style.border = "1px solid #db5353";
        document.getElementById('new-total-goal').focus();
        valid = false;
    } else if (campaign_data.verse_price == "") {
        document.getElementById('new-verse-price').style.border = "1px solid #db5353";
        document.getElementById('new-verse-price').focus();
        valid = false;
    } else if (new_goal_description.getLength() <= 1) {
        $( "#new-goal-description.ql-container" ).css( "border", "1px solid #db5353" );
        new_goal_description.focus();
        valid = false;
    } 
    
    
    if (valid) {
        
        var params = 'church='+church_id+'&language='+campaign_data.language+'&book='+campaign_data.book+'&goal_description='+campaign_description+'&goal_amount='+campaign_data.total_goal+'&verse_price='+campaign_data.verse_price+'&start_date='+campaign_data.start_date+'&end_date='+campaign_data.end_date+'&url='+campaign_data.url;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {
                
                window.location.href = "church.php?id="+church_id+"#";
                search_campaigns();
            }
            
        }}}
        ajaxObj.open("GET", "sql-insert-church-campaign.php?"+params);
        ajaxObj.send();
        
        
        
    }
}
    
    

    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>