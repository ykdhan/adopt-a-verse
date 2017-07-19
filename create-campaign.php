<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf8" />
    <title>Adopt a Verse | Wycliffe Bible Translators</title>
    
    <!-- Links -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/admin.css?ver=1.4" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/filamentgroup/fixed-sticky/master/fixedsticky.js"></script>
    <script type="text/javascript" src="js/sidebar.js"></script>
    
    
    <!-- Wycliffe links -->

    
    
    
    <?php 
    
    error_reporting(E_ALL ^ E_DEPRECATED);

    include('config.php');

    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($mysqli->connect_errno) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    
    $sql_church = "SELECT * FROM church ORDER BY name";
    $sql_book = "SELECT * FROM bible_contents";

    ?>
    
    
    
</head>
    
<body>
    
    
<!-- Top Bar -->
<div class="top-bar desktop">
    <table><tr>
    <td>
        <img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="img/wycliffe-logo.png"><span id="tag-admin">Admin</span>
    </td>
    <th>
    </th>
    <td>
        <span id="admin-title">Campaign Registration</span>
    </td>
    </tr></table>
</div>
    
    
<!-- Top Bar (mobile) -->
<div id="top-bar" class="top-bar mobile">
    
    <div id="top-bar-menu" onclick="toggle_menu()">
        <img id="menu-icon" alt="Menu" align="middle"  src="img/menu_open.png">
    </div>
    <div id="top-bar-logo">
        <img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="img/wycliffe-logo.png">
    </div>
    <div id="toggle-menu">
        <div class="div-tab font--bold">
            <button class="capitalize tabs tabs-now" onclick="tab(event, 'tab-donate')">Donate</button>
            <button class="capitalize tabs" onclick="tab(event, 'tab-about')">About the Language</button>
            <button class="capitalize tabs" onclick="tab(event, 'tab-goal')">Our Campaign Goal</button>
        </div>
    </div>
    
</div>
    
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="wrapper">
        
    <div id="content-create-campaign" class="admin-content">
        <div id="title-create-campaign">New Campaign</div>
        <section>
            <div class="column-left">Church</div>
            <div class="column-tip"></div>
            <div class="column-right">
                
                <input type="text" class="admin-text" id="church-name" onkeyup="search_church()" placeholder="Church">
                
                <div class="drop" id="drop-church">
                </div>
            
            </div>
            <div class="column-left">Campaign Url</div>
            <div class="column-tip"></div>
            <div class="column-right">adopt.wycliffe.org/&nbsp; <input type="text" class="admin-text" id="campaign-url" onkeyup="search_url()" placeholder="church-name"><span class="error" id="error-url"></span>
            </div>
            <div class="column-left">Campaign Duration</div>
            <div class="column-tip"></div>
            <div class="column-right"><input type="date" class="admin-text" placeholder="0">&nbsp; to &nbsp;<input type="date" class="admin-text" placeholder="0"></div>
        </section>
        <section>
            <div class="column-left">Church Contact</div>
            <div class="column-tip"></div>
            <div class="column-right"><input type="text" class="admin-text" placeholder="First Name"><input type="text" class="admin-text" placeholder="Last Name">
            <input type="text" class="admin-text" placeholder="Email Address"><input type="text" class="admin-text" placeholder="Phone Number"></div>
            <div class="column-left">Admin Account</div>
            <div class="column-tip"></div>
            <div class="column-right"><input type="text" class="admin-text" placeholder="Username"><br>
            <input type="password" class="admin-text" placeholder="Password"><input type="password" class="admin-text" placeholder="Confirm Password"></div>
        </section>
        <section>
            <div class="column-left">Language</div>
            <div class="column-tip"></div>
            <div class="column-right">
            
                <input type="text" class="admin-text" id="language-name" onkeyup="search_language()" placeholder="Language">
                
                <div class="drop" id="drop-language">
                </div>
                
            </div>
            <div class="column-left">Book</div>
            <div class="column-tip"></div>
            <div class="column-right">
            
                <button type="button" class="dropdown" id="dropdown-book" onclick="dropdown('book')">Select Book<img alt="" src="img/cart_close.png"></button>
                
                <div class="drop" id="drop-book">
                <?php
                if ($result_book = $mysqli->query($sql_book)) {
                    
                    $old = true;
                    $new = true;
                    
                    while ($row = $result_book->fetch_assoc()) {
                        if ($row['testament'] == "Old Testament" && $old) {
                            echo '<div class="drop-group book-group">Old Testament</div>';
                            $old = false;
                        } else if ($row['testament'] == "New Testament" && $new) {
                            echo '<div class="drop-group book-group">New Testament</div>';
                            $new = false;
                        }
                        
                        echo '<div class="drop-item book-item" onclick="select_book(\''.$row['book'].'\')">'.$row['book'].'</div>';
                    }

                } else {
                     echo '<div class="drop-item book-item">Error</div>';
                }
                ?> 
                </div>
                
            </div>
        </section>
        <section>
            <div class="column-left">Goal Description</div>
            <div class="column-tip"><span class="tool-tip">?</span></div>
            <div class="column-right"><textarea rows="4" class="admin-textarea" placeholder="Description"></textarea></div>
            <div class="column-left">Total Goal Amount</div>
            <div class="column-tip"></div>
            <div class="column-right">&#36;&nbsp; <input type="text" id="money-total" class="admin-text" onkeypress="input_fund('total')" placeholder="0"><span class="error" id="error-total"></span></div>
            <div class="column-left">Cost per Verse</div>
            <div class="column-tip"></div>
            <div class="column-right">&#36;&nbsp; <input type="text" id="money-verse" class="admin-text" onkeypress="input_fund('verse')" placeholder="0"><span class="error" id="error-verse"></span></div>
        </section>
        <section id="last-section">
            <button type="button" class="admin-submit">Create Campaign</button>
        </section>
    </div>


         
    <div id="footer">
        ©2017 Wycliffe Bible Translators. All rights reserved.
    </div> 
    
    
    
</div> <!-- wrapper -->
    
    
</div> <!-- bg -->
    
    

    

<script>
var church = "";
var book = "";
var language = "";
    
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
    
    
var drop_book = false;
function dropdown(title) {
    if (title == "book") {
        if (drop_book) {
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
            
            document.getElementById('drop-book').style.visibility = "hidden";
            drop_book = false;
        } else {
            var items = document.getElementsByClassName("book-item");
            for(var i = 0; i < items.length; i++)
            {
               items[i].style.visibility = "visible";
            }
            var groups = document.getElementsByClassName("book-group");
            for(var i = 0; i < groups.length; i++)
            {
               groups[i].style.visibility = "visible";
            }
            
            document.getElementById('drop-book').style.visibility = "visible";
            drop_book = true;
        }
    }
}
    
function select_book(bk) {
    book = bk;
    document.getElementById('dropdown-book').innerHTML = book+'<img alt="" src="img/cart_close.png">';
    
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

    document.getElementById('drop-book').style.visibility = "hidden";
    drop_book = false;
}
    
    

var drop_church = false;
function search_church() {
    
    var word = document.getElementById('church-name').value;
    
    document.getElementById('drop-church').style.visibility = "visible";
    drop_church = true;
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('drop-church').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('drop-church').innerHTML += '<div class="drop-group">No search result.</div>';
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
        ajaxObj.open("GET", "search-church.php?church="+word);
        ajaxObj.send();
        
}
    
function select_church(ch,name) {
    church = ch;
    document.getElementById('church-name').value = name;
    
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
    drop_church = false;
}

    
var drop_language = false;
function search_language() {
    
    var word = document.getElementById('language-name').value;
    
    document.getElementById('drop-language').style.visibility = "visible";
    drop_language = true;
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('drop-language').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('drop-language').innerHTML += '<div class="drop-group">No search result.</div>';
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
        ajaxObj.open("GET", "search-language.php?language="+word);
        ajaxObj.send();
        
}
    
function select_language(lang,name) {
    language = lang;
    document.getElementById('language-name').value = name;
    
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
    drop_language = false;
}
    
    
function search_url() {
    
    var word = document.getElementById('campaign-url').value;
    
    
    
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        var valid = true;
        document.getElementById('error-url').style.visibility = "visible";
        
        if (word.length < 8) {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">url is too short';
            valid = false;
        }
        
        if (word.length > 25) {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">url is too long';
            valid = false;
        }
        
        if (ajaxObj.responseText == "exist\n") {
            document.getElementById('error-url').className = "error red";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">url already exists';
            valid = false;
        }

        if (valid) {
            document.getElementById('error-url').className = "error green";
            document.getElementById('error-url').innerHTML = '<img class="error-icon" alt="" src="img/error_valid.png">url is valid';
        }

    }}}
    ajaxObj.open("GET", "search-url.php?url="+word);
    ajaxObj.send();
        
}
    

    
function input_fund(title) {

    var money_total = document.getElementById('money-total');
    var money_verse = document.getElementById('money-verse');

    
    if (title == 'total') {
        money_total.value = money_total.value.replace(/[^0-9.]+/, '');
        
        var valid = true;
        
        if (book == "") {
            document.getElementById('error-total').style.visibility = "visible";
            document.getElementById('error-total').className = "error red";
            document.getElementById('error-total').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Book is not selected';
            valid = false;
            money_total.value = "";
        }
        
        if (valid) {
            document.getElementById('error-total').style.visibility = "hidden";
            
            money_verse.value = (money_total.value/parseInt(verses[book])).toFixed(2);
        }
        
    } else if (title == 'verse') {
        money_verse.value = money_verse.value.replace(/[^0-9.]+/, '');
        
        var valid = true;
        
        if (book == "") {
            document.getElementById('error-verse').style.visibility = "visible";
            document.getElementById('error-verse').className = "error red";
            document.getElementById('error-verse').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Book is not selected';
            valid = false;
            money_total.value = "";
        }
        
        if (valid) {
            document.getElementById('error-verse').style.visibility = "hidden";
            
            money_total.value = (money_verse.value*parseInt(verses[book])).toFixed(2);
        }
    }
    
}
    
    
    
function submit_form() {
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        console.log(ajaxObj.responseText);

    }}}
    ajaxObj.open("POST", "insert-campaign.php", true);
    ajaxObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxObj.send();
}
    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>