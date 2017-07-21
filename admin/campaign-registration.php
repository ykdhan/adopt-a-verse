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
        <span id="admin-title">Campaign Registration</span>
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
                
                <input type="text" class="admin-text" id="campaign-church" onkeyup="search_church()" placeholder="Search for church">
                
                <div class="drop" id="drop-church"></div>
            
            </div>
            <div class="column-left">Campaign Url</div>
            <div class="column-tip"></div>
            <div class="column-right">adopt.wycliffe.org/ <input type="text" class="admin-text" id="campaign-url" placeholder="church-name"><span class="error" id="error-url"></span>
            </div>
            <div class="column-left">Campaign Duration</div>
            <div class="column-tip"></div>
            <div class="column-right"><input type="date" class="admin-text" id="campaign-start-date" onchange="select_start_date(this)">&nbsp; to &nbsp;<input type="date" class="admin-text" id="campaign-end-date" onchange="select_end_date(this)"></div>
        </section>
        <section>
            <div class="column-left">Admin Account</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <input type="text" class="admin-text" id="campaign-email" placeholder="Email Address"><span class="error" id="error-email"></span><br>
                <input type="password" class="admin-text" id="campaign-password" placeholder="Password">
                <input type="password" class="admin-text" id="campaign-confirm-password" placeholder="Confirm Password">
                <span class="error" id="error-password"></span></div>
            <div class="column-left">Contact</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <input type="text" class="admin-text" id="campaign-first-name" placeholder="First Name" onkeyup="input_form('first-name')">
                <input type="text" class="admin-text" id="campaign-last-name" placeholder="Last Name" onkeyup="input_form('last-name')">
                <input type="text" class="admin-text" id="campaign-phone" placeholder="Phone Number" onkeyup="input_form('phone')"></div>
        </section>
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
            <div class="column-left">Goal Description</div>
            <div class="column-tip"><span class="tool-tip">?</span></div>
            <div class="column-right"><textarea rows="4" class="admin-textarea" id="campaign-goal-description" placeholder="Description" onkeyup="input_form('goal-description')"></textarea></div>
            <div class="column-left">Total Goal Amount</div>
            <div class="column-tip"></div>
            <div class="column-right">&#36;&nbsp; <input type="text" id="campaign-total-goal" class="admin-text small" onkeyup="input_fund('total')" placeholder="0"><span class="error" id="error-total"></span></div>
            <div class="column-left">Cost per Verse</div>
            <div class="column-tip"></div>
            <div class="column-right">&#36;&nbsp; <input type="text" id="campaign-verse-price" class="admin-text small" onkeyup="input_fund('verse')" placeholder="0"><span class="error" id="error-verse"></span></div>
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
    
var form_data = {
    church: "",
    url: "",
    start_date: "",
    end_date: "",
    first_name: "",
    last_name: "",
    phone: "",
    email: "",
    password: "",
    language: "",
    book: "",
    goal_description: "",
    total_goal: "",
    verse_price: ""
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
    
    

function search_book() {
    
    var word = document.getElementById('campaign-book');
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
    form_data.book = bk;
    document.getElementById('campaign-book').value = bk;
    
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

                    document.getElementById('drop-church').innerHTML += '<div class="drop-item church-item" onclick="select_church(\''+id+'\',\''+name+'\')">'+name+'<span class="church-tag">'+state+'</span></div>';

                }
            }
            
        }}}
        ajaxObj.open("GET", "search-church.php?church="+word.value);
        ajaxObj.send();
        
}
    
function select_church(ch,name) {
    form_data.church = ch;
    document.getElementById('campaign-church').value = name;
    
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

    
function search_language() {
    
    var word = document.getElementById('campaign-language');
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
    form_data.language = lang;
    document.getElementById('campaign-language').value = name;
    
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
    
    var word = document.getElementById('campaign-url');

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        var valid = true;
        form_data.url = "";
        document.getElementById('error-url').style.visibility = "visible";
        
        if (word.value.length < 6) {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">URL is too short';
            valid = false;
        }
        
        if (word.value.length > 30) {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">URL is too long';
            valid = false;
        }
        
        if (ajaxObj.responseText == "exist\n") {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">URL already exists';
            valid = false;
        }

        if (valid) {
            document.getElementById('error-url').className = "error green";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_valid.png">URL is valid';
            form_data.url = word.value;
        }

    }}}
    ajaxObj.open("GET", "search-url.php?url="+word.value);
    ajaxObj.send();
        
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