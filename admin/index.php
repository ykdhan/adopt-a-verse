<?php 
session_start();
if (isset($_SESSION['aav-super-admin'])) { 
    header('Location: admin.php');
} else if (isset($_SESSION['aav-admin'])) { 
    header('Location: church.php?id='.$_SESSION['aav-church']);
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
    
    
    <div class="index-content">
        
        <div class="landing-title">
            Church
        </div>

        <div class="campaign-list" id="list-church"></div>
        
        <div class="landing-title">
            Individual
        </div>
        
        <div class="campaign-list" id="list-individual">No campaign</div>
        
    </div>
      
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

    

<script>
    
search_church();
    
function search_church() {
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-church').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-church').innerHTML += '<div class="campaign-group church-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp.campaign).length; i++) {

                    var num = Object.keys(resp.campaign)[i];
                    var state = resp.campaign[num]['state'];
                    var church = resp.campaign[num]['church'];
                    var id = resp.campaign[num]['id'];
                    var langauge = resp.campaign[num]['langauge'];
                    var book = resp.campaign[num]['book'];

                    document.getElementById('list-church').innerHTML += '<div class="campaign-item church-item" onclick="select_church(\''+id+'\')"><div class="row-1">'+church+'<span class="church-tag">'+state+'</span></div><div class="row-2">'+langauge+'<span class="church-tag">'+book+'</span></div></div>';

                }
            }
            
        }}}
        ajaxObj.open("GET", "search-campaign-church.php?church=");
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
        window.location.href = "view-church-campaign.php?id="+ch;
    }
    
}

    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>