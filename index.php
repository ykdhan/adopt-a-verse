<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf8" />
    <title>Adopt a Verse | Wycliffe Bible Translators</title>
    
    <!-- Links -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css?ver=2.9" />
    <script type="text/javascript" src="js/init.js?v=2.8"></script>
    <script type="text/javascript" src="js/select-verse.js?v=2.8"></script>
    <script type="text/javascript" src="js/navigate-tab.js?v=2.8"></script>
    <script type="text/javascript" src="js/load-chapter.js?v=2.8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/filamentgroup/fixed-sticky/master/fixedsticky.js"></script>
    <script type="text/javascript" src="js/sidebar.js"></script>
    
    
    <!-- Wycliffe links -->

    
</head>
    
<body>
    
    
<!-- Top Bar -->
<div class="top-bar desktop">
    <table><tr>
    <td>
        <img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="img/wycliffe-logo.png">
    </td>
    <th>
        <!-- middle -->
    </th>
    <td>
        
        <!--
        <table class="top-bar-church">
        <tr>
        <td id="cell-church-logo">
            <img id="church-logo" alt="Church Logo" align="middle" src="img/church-logo.png">
        </td>    
        <td id="cell-church-name" class="capitalize">
            
        </td>
        </tr>
        </table>
        -->
        
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
<div id="landing-wrapper">
    
    <h1>Campaigns</h1>
    
    <div id="tab-church" class="landing-content landing-content-now">

        <input type="text" class="landing-text" id="search-church" onkeyup="search_church()" placeholder="Search">

        <div class="list" id="list-church"></div>
        
    </div>
    
    
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

    

<script>

search_church();
    
function search_church() {
    
    var word = document.getElementById('search-church');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-church').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-church').innerHTML += '<div class="list-group church-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var state = resp[num]['state'];
                    var church = resp[num]['church'];
                    var id = resp[num]['id'];
                    var langauge = resp[num]['langauge'];
                    var book = resp[num]['book'];

                    document.getElementById('list-church').innerHTML += '<div class="list-item church-item" onclick="select_church(\''+id+'\')"><div class="row-1">'+church+'<span class="church-tag">'+state+'</span></div><div class="row-2">'+langauge+'<span class="church-tag">'+book+'</span></div></div>';

                }
            }
            
        }}}
        ajaxObj.open("GET", "search-campaign-church.php?church="+word.value);
        ajaxObj.send();
        
}
    
function select_church(ch) {
    
    if (ch == "") {
    
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

    } else {
        window.location.href = "app.php?id="+ch;
    }
    
}

</script>
    
    
</body>
    
<footer>
    
</footer>
    
</html>