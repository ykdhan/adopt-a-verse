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
    <script type="text/javascript" src="js/countdown.js"></script>
    
    <script type="text/javascript" src="js/remodal-app.js"></script>
    <link rel="stylesheet" type="text/css" href="css/remodal-default-theme-app.css" />
    <link rel="stylesheet" type="text/css" href="css/remodal.css" />
    
    <!-- Wycliffe links -->

    
</head>
    
<body>
    
    
<!-- Top Bar -->
<div class="top-bar desktop">
    <table><tr>
    <td>
        <a href="index.php"><img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="img/wycliffe-logo.png"></a>
    </td>
    <th>
        <div class="div-tab font--bold">
        <button class="tabs capitalize tabs-now" onclick="tab(event, 'tab-donate')">Donate</button>
        <button class="tabs capitalize" onclick="tab(event, 'tab-about')" id="language-tab">About the Language</button>
        <button class="tabs capitalize" onclick="tab(event, 'tab-goal')">Our Campaign Goal</button>
        </div>
    </th>
    <td id="cell-church">
        <div id="church-logo"></div>
        <div id="church-name"></div>
    </td>
    </tr></table>
</div>
    
    
<!-- Top Bar (mobile) -->
<div id="top-bar" class="top-bar mobile">
    
    <div id="top-bar-menu" onclick="toggle_menu()">
        <img id="menu-icon" alt="Menu" align="middle"  src="img/menu_open.png">
    </div>
    <div id="top-bar-logo">
        <a href="index.php"><img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="img/wycliffe-logo.png"></a>
    </div>
    <div id="toggle-menu">
        <div class="div-tab font--bold">
            <button class="capitalize tabs tabs-now" onclick="tab(event, 'tab-donate')">Donate</button>
            <button class="capitalize tabs" onclick="tab(event, 'tab-about')" id="language-tab">About the Language</button>
            <button class="capitalize tabs" onclick="tab(event, 'tab-goal')">Our Campaign Goal</button>
        </div>
    </div>
    
</div>
    
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="wrapper">
    
    
    <!-- Tab -->
    <div id="content">
        
        <!-- Donate Tab -->
        <div id="tab-donate" class="tab-content tab-content-now">
            <div class="donate-top-bar">
            <div class="donate-bar">
                
                <div>
                    <span class="title capitalize">Language</span>
                    <span class="language" id="campaign-language"></span><span class="region" id="campaign-region"></span>
                </div>
                <div>
                    <span class="title book-chapter capitalize">Book &amp; Chapter</span>
                    <button id="button-chapter" onclick="show_chapters()">
                        <img alt="" src="img/arrow-down.png" />
                    </button>
                                
                    <div id="select-chapter">
                        <div id="select-chapter-close" onclick="hide_chapters()">
                            <img alt="X" src="img/menu_close.png" />
                        </div>
                        <div id="book"></div>
                        <div id="chapters"></div>
                    </div>
                </div>
                
            </div>
            </div>
            
            <div id="div-select-all">
            </div>
            
            <div id="bible">
                <!-- Bible verses -->
            </div>
        </div>
        
        
        <!-- About the Language Tab -->
        <div id="tab-about" class="tab-content">
            <div class="tab-title" id="language-name">About the Language</div>
            <div id="language-description" class="tab-text">
                
            </div>
            <div class="tab-text" id="download-pdf">
                
            </div>

            
            <!-- Mobile Language Group Details and Photo -->
            <div class="mobile">
              
            <div class="tab-title top-gap">Language Group Details</div>
            <div class="tab-text">
                <div class="div-details-img">
                    <img class="details-img" alt="" src="img/details_region.png">
                </div>
                <div class="div-details-content">
                    <span class="details-title">Region/Country</span><br>
                    <span class="details-info">Papua New Guinea</span>
                </div>
                <div class="div-details-img">
                    <img class="details-img" alt="" src="img/details_people.png">
                </div>
                <div class="div-details-content">
                    <span class="details-title">People Group(s)</span><br>
                    <span class="details-info">Kaninuwa</span>
                </div>
                <div class="div-details-img">
                    <img class="details-img" alt="" src="img/details_speaker.png">
                </div>
                <div class="div-details-content">
                    <span class="details-title">Native Speakers</span><br>
                    <span class="details-info">340</span>
                </div>
                <div class="div-details-img">
                    <img class="details-img" alt="" src="img/details_scripture.png">
                </div>
                <div class="div-details-content">
                    <span class="details-title">Scriptures Published</span><br>
                    <span class="details-info">None</span>
                </div>
            </div>
                
            <div class="tab-title top-gap-more">Photo</div>
            <div id="language-photo" class="tab-text">
                <img alt="" src="img/example_photo.jpg" id="first-photo">
                <div id="more-photo"><img alt="" src="img/open_photo.png"></div>
            </div>
            
            </div>

            
        </div>

        
        <!-- Our Campaign Goal Tab -->
        <div id="tab-goal" class="tab-content">
            <div class="tab-title" id="campaign-goal">Our Campaign Goal</div>
            <div id="campaign-description" class="tab-text">
            </div>
            <div id="campaign-duration">
                <div id="count-number">
                    <div class="count-days">
                        <span class="countdown-days"></span><br>
                        days
                    </div>
                    <div class="count-hours">
                        <span class="countdown-hours"></span><br>
                        hrs
                    </div>
                    <div class="count-minutes">
                        <span class="countdown-minutes"></span><br>
                        min
                    </div>
                    <div class="count-seconds">
                        <span class="countdown-seconds"></span><br>
                        sec
                    </div>
                </div>
                <div id="count-range">
                </div>
            </div>
            <div class="tab-title top-gap">Total Raised</div>
            <div class="tab-text">
                
                <div id="div-chart">
                    <!-- Donut graph -->
                </div>

                <!-- Still need -->
                <div id="div-chart-info">
                    <div class="goal-total-info-1">
                        Still Need: <span id="total-still-need"></span><br>
                    </div>

                    <!-- Total goal -->
                    <div class="goal-total-info-2">
                        Goal: <span id="total-goal"></span>
                    </div>

                    <!-- Total verses adopted -->
                    <div class="goal-total-adopted-verses">
                        <span id="total-adopted"></span> of <span id="total-verses"></span> verses adopted
                    </div>
                </div>
                
                <!-- Total raised percentage in the donut -->
                <div id="div-chart-percentage">
                    <span class="chart-percent-span" id="total-percentage">%</span>
                    <br>
                    <span class="chart-percent-span capitalize">Funded</span>
                </div>
                
            </div>
        </div>

        
        <div id="footer">
            Holy Bible, New Living Translation, copyright © 1996, 2004, 2015 by Tyndale House Foundation.<br>
            ©2017 Wycliffe Bible Translators. All rights reserved.
        </div>
    </div>
    
    

    
    
    <!-- side bar -->
    <div id="side-bar" class="desktop">
        
        <!-- Total Raised Side Bar (Tablet) -->
        <div id="small-side-total" class="small-sides border--round">
            <div id="small-total" class="small-side-bar" onclick="toggle_small_total()">
                <span class="small-title capitalize">Total Raised</span>
                <img id="small-total-icon" alt="" src="img/cart_open.png">
            </div>
            
            <div id="small-total-content" class="small-side-content">
                <div id="small-total-raised">
                    <!-- Donut graph -->
                </div>
            
                <!-- Total raised percentage in the donut -->
                <span class="total-percent-span" id="small-total-percentage">%</span>
                <br>
                <span class="total-percent-span capitalize">Funded</span>

                <!-- Still need -->
                <div class="total-info-1">
                    Still Need: <span id="small-total-still-need"></span><br>
                </div>

                <!-- Total goal -->
                <div class="total-info-2">
                    Goal: <span id="small-total-goal"></span>
                </div>

                <!-- Total verses adopted -->
                <div class="total-adopted-verses">
                    <span id="small-total-adopted" class="highlight"></span> of <span id="small-total-verses"></span> verses adopted
                </div>
            </div>
        </div>
        
        <!-- Cart Side Bar (Tablet) -->
        <div id="small-side-cart" class="small-sides border--round">
            
            <div id="small-cart" class="small-side-bar" onclick="toggle_small_cart()">
                <span class="small-title capitalize">My Cart</span>
                <div id="num-items"></div>
                <img id="small-cart-icon" alt="" src="img/cart_close.png">
            </div>
            
            <div id="small-cart-content" class="small-side-content"> 
                <div id="small-div-cart">
                </div>

                <div id="small-div-cart-empty">
                    <img id="img-empty-cart" alt="Empty Cart" src="img/empty-cart.png">
                    <br>
                    Add verses to your cart.
                </div>

                <div id="small-div-cart-label" class="no-label">&nbsp;</div>

                <div class="div-checkout">
                    <button id="small-checkout" class="checkout border--round empty" onclick="open_give()">Give $0</button>
                </div>
            </div>
        </div>
        
        
        <!-- Language Group Details Side Bar -->
        <div id="small-side-language" class="small-sides border--round hide">
            <div id="small-language" class="small-side-bar" onclick="toggle_small_language()">
                <span class="small-title capitalize">Project Details</span>
                <img id="small-language-icon" alt="" src="img/cart_open.png">
            </div>
            
            <div id="small-language-content" class="small-side-content">
                <div id="small-div-details">
                    <div class="div-details-img">
                        <img class="details-img" alt="" src="img/details_region.png">
                    </div>
                    <div class="div-details-content">
                        <span class="details-title">Region/Country</span><br>
                        <span class="details-info" id="details-region"></span>
                    </div>
                    <div class="div-details-img">
                        <img class="details-img" alt="" src="img/details_people.png">
                    </div>
                    <div class="div-details-content">
                        <span class="details-title" id="title-language">Language</span><br>
                        <span class="details-info" id="details-language"></span>
                    </div>
                    <div class="div-details-img">
                        <img class="details-img" alt="" src="img/details_speaker.png">
                    </div>
                    <div class="div-details-content">
                        <span class="details-title">Native Speakers</span><br>
                        <span class="details-info" id="details-native-speakers"></span>
                    </div>
                    <div class="div-details-img">
                        <img class="details-img" alt="" src="img/details_scripture.png">
                    </div>
                    <div class="div-details-content">
                        <span class="details-title">Scriptures Published</span><br>
                        <span class="details-info" id="details-scripture-published"></span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Photo Side Bar -->             
        <div id="small-side-photo" class="small-sides border--round hide">
            <div id="small-photo" class="small-side-bar" onclick="toggle_small_photo()">
                <span class="small-title capitalize">Photo</span>
                <img id="small-photo-icon" alt="" src="img/cart_close.png">
            </div>
            
            <div id="small-photo-content" class="small-side-content">
                <img alt="" src="img/example_photo.jpg" id="first-photo">
                <div id="more-photo"><img alt="" src="img/open_photo.png"></div>
            </div>
        </div>
        
    </div>
    
    
    
    
    <!-- Mobile Cart -->
    <div id="mobile-cart">
        <div id="cart-1">
            <div id="cart-toggle" onclick="toggle_cart()">
                <img id="cart-icon" alt="Cart" src="img/cart_open.png">
            </div>

            <div id="cart-label">
                <span class="label-title capitalize">My Cart</span><br>
                <span class="highlight">1</span> verse selected
            </div>

            <div id="cart-checkout">
                <button id="checkout-mobile" class="checkout border--round">Give $0</button>
            </div>
        </div>
        
        <div id="cart-2">
            <div id="div-cart-mobile">
                <!-- cart items -->
            </div>
        </div>
    </div>
        
    
    <!-- Hidden Data 
    <input type="hidden" id="data-verse-price" value="">
    <input type="hidden" id="data-total-goal" value="">

    -->
    
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

<div class="remodal" data-remodal-id="give" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <form method="post" enctype="multipart/form-data">
        
        <div id="title">Gift Details</div>
        <section>
            <div class="col-left">Verses Selected</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <div id="give-verses-selected">
                
                </div>
            </div>
            <div class="col-left">Total Amount</div>
            <div class="col-tip"></div>
            <div class="col-right" id="give-total-amount">
                
            </div>
        </section>
        <section>
            <div class="col-left">User</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="form-text" id="give-first-name" onkeyup="input_form('first-name')" placeholder="First Name">
                <input type="text" class="form-text" id="give-last-name" onkeyup="input_form('last-name')" placeholder="Last Name"><br>
                <input type="text" class="form-text" id="give-email" placeholder="Email Address"><span class="error" id="error-email"></span>
                
            </div>
        </section>
        <section>
            <div class="col-left">Display Name</div>
            <div class="col-tip">
                <span class="tool-tip">?<div class="tooltip">This is the name that will be displayed with your adopted verse(s)<br>(e.g. "the Smith Family").</div></span>
            </div>
            <div class="col-right">
                
                <input type="text" class="form-text" id="give-honor-name" onkeyup="input_form('honor-name')" placeholder="Honoree's Name">
                <input type="text" class="form-text" id="give-display-name" onkeyup="input_form('display-name')" placeholder="Name"><br>
                
                <div id="give-options">
                    <input id="give-anonymous" class="checkbox-custom" name="give-anonymous" type="checkbox" onclick="give_anonymous()"><label for="give-anonymous" class="checkbox-custom-label">Give anonymously</label><br>
                    <input id="give-honor" class="checkbox-custom" name="give-honor" type="checkbox" onclick="give_honor()"><label for="give-honor" class="checkbox-custom-label">Give in honor of someone else</label>
                </div>
                
            </div>
            <div class="col-left">Preview</div>
            <div class="col-tip">
            </div>
            <div class="col-right" id="col-preview">
                
                <span id="tooltip-preview" class="tooltip-taken">This verse has been sponsored<span id="give-preview"></span>.
                </span>
                
            </div>
        </section>
        <section class="last-section">
            <button type="button" class="form-button" onclick="close_give()">Cancel</button>
            <button type="button" class="form-submit long" onclick="checkout()">Proceed to Checkout</button>
        </section>
        
        </form>
    </div>
</div>

    
    
    

<script>
$(document).ready(function () {
    $("html,body").scrollTop(0);
});
    
var page_param = window.location.search.substring(1);
var page_url = new URL(window.location.href);
var code = page_url.searchParams.get("id");

// fixed side bar
$(function() {

    var $sidebar   = $("#side-bar"), 
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 100;

    $window.scroll(function() {
        if ($window.scrollTop() > offset.top) {
            var newMargin = $window.scrollTop() - offset.top + topPadding
            $sidebar.css('margin-top', newMargin);
        } else {
            $sidebar.css('margin-top', 0);
        }
    });
    
});
  
    
// initialize all the necessary fields on page
function init() {
    
    campaign = {};
    chapter = 1;
    verses = [];
    selected = {};
    abbreviation = "";
    
    var ajaxObj = new XMLHttpRequest();
	ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
		
        if (ajaxObj.responseText == "no\n") {
            alert("The campaign does not exist.");
            window.location.href = "index.php";
        } else {
            var resp = JSON.parse(ajaxObj.responseText);

            campaign.book = resp.book;
            campaign.church = resp.church;
            campaign.profile_picture = resp.profile_picture;
            campaign.language = resp.language;
            campaign.project_description = resp.project_description;
            campaign.goal_description = resp.goal_description;
            campaign.goal_amount = parseFloat(resp.goal_amount).toFixed(2);
            campaign.verse_price = parseFloat(resp.verse_price).toFixed(2);
            campaign.start_date = resp.start_date;
            campaign.end_date = resp.end_date;
            campaign.region = resp.region;
            campaign.number_of_speakers = parseInt(resp.number_of_speakers);
            campaign.scripture_published = resp.scripture_published;
            campaign.pdf_url = resp.pdf_url;
            
            countdownDate(campaign.end_date);
            var start_date = new Date(campaign.start_date);
            var start_year = (""+start_date.getFullYear()).slice(-2);
            var start_month = start_date.getMonth() + 1;
            var start = start_month+"/"+start_date.getDate()+"/"+start_year;
            var end_date = new Date(campaign.end_date);
            var end_year = (""+end_date.getFullYear()).slice(-2);
            var end_month = end_date.getMonth() + 1;
            var end = end_month+"/"+end_date.getDate()+"/"+end_year;
            document.getElementById('count-range').innerHTML = start+" - "+end;
            
            
            book = campaign.book;
            
            verse_price = parseFloat(campaign.verse_price).toFixed(2);
            total_goal = parseFloat(campaign.goal_amount).toFixed(2);
            
            document.getElementById('total-goal').innerHTML = "$" + total_goal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
            document.getElementById('small-total-goal').innerHTML = "$" + total_goal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        
            
            if (campaign.profile_picture != null) {
                document.getElementById('church-logo').style.backgroundImage = 'url("img/profile/'+campaign.profile_picture+'")';
            }

            document.getElementById('book').innerHTML = book;
            document.getElementById('campaign-language').innerHTML = campaign.language;
            document.getElementById('campaign-region').innerHTML = campaign.region;
            document.getElementById('church-name').innerHTML = campaign.church;
            document.getElementById('language-name').innerHTML = campaign.language;
            document.getElementById('language-tab').innerHTML = "About the "+campaign.language;
            document.getElementById('language-description').innerHTML = "<p>"+campaign.project_description+"</p>";
            document.getElementById('campaign-description').innerHTML = "<p>"+campaign.goal_description+"</p>";
            document.getElementById('details-region').innerHTML = campaign.region;
            document.getElementById('details-language').innerHTML = campaign.language;
            var num_speakers = campaign.number_of_speakers.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            document.getElementById('details-native-speakers').innerHTML = num_speakers;
            document.getElementById('details-scripture-published').innerHTML = campaign.scripture_published;
            document.getElementById('download-pdf').innerHTML = '<a href="'+campaign.pdf_url+'" target="_blank"><button class="tab-button" type="button">View PDF</button></a>';
            
            
            taken = {};
            
            var ajaxObj1 = new XMLHttpRequest();
            ajaxObj1.onreadystatechange= function() { if(ajaxObj1.readyState == 4) { if(ajaxObj1.status == 200) {
                
                var total_still_need = 0;
                
                if (ajaxObj1.responseText == "no\n") {
                    
                    total_adopted = 0;
                    total_raised = 0;
                    total_percentage = 0;
                    total_still_need = parseFloat(total_goal).toFixed(2);
                    
                } else {
                    var resp = JSON.parse(ajaxObj1.responseText);

                    var count = 0;

                    for (var i = 0; i < Object.keys(resp).length; i++) {

                        var chapter = Object.keys(resp)[i];
                        taken[chapter] = {};

                        for (var j = 0; j < Object.keys(resp[chapter]).length; j++) {
                            var verse = Object.keys(resp[chapter])[j];
                            var sponsor = resp[chapter][verse];

                            taken[chapter][verse] = sponsor;

                            count++;
                        }
                    }
                    
                    total_adopted = count;
                    total_raised = parseFloat(count * campaign.verse_price).toFixed(2);
                    total_percentage = Math.round(total_raised / total_goal * 100);
                    total_still_need = parseFloat(total_goal - total_raised).toFixed(2);
                }
                
                console.log("Taken Verses:");
                console.log(taken);
                
                document.getElementById('total-still-need').innerHTML = "$" + total_still_need.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                document.getElementById('small-total-still-need').innerHTML = "$" + total_still_need.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                document.getElementById('total-adopted').innerHTML = total_adopted;
                document.getElementById('small-total-adopted').innerHTML = total_adopted;

            }}}
            ajaxObj1.open("GET", "sql-taken-verses.php?id="+code);
            ajaxObj1.send();
            

            bible = {};

            var ajaxObj2 = new XMLHttpRequest();
            ajaxObj2.onreadystatechange= function() { if(ajaxObj2.readyState == 4) { if(ajaxObj2.status == 200) {
                
                var resp = JSON.parse(ajaxObj2.responseText);

                max_chapter = resp.size;
                bible = resp.bible;

                // load book of the Bible
                load_book(book);

            }}}
            ajaxObj2.open("GET", "bible.php?book="+book);
            ajaxObj2.send();
            
            
            var ajaxObj3 = new XMLHttpRequest();
            ajaxObj3.onreadystatechange= function() { if(ajaxObj3.readyState == 4) { if(ajaxObj3.status == 200) {
                var resp = JSON.parse(ajaxObj3.responseText);

                abbreviation = resp[book]['abbreviation'];
                total_verses = resp[book]['verses'];
                
                document.getElementById('total-verses').innerHTML = total_verses;
                document.getElementById('small-total-verses').innerHTML = total_verses;

                
            }}}
            ajaxObj3.open("GET", "sql-chapters-verses.php");
            ajaxObj3.send();
            
            
        }
        
        
    }}}
    ajaxObj.open("GET", "search-campaign.php?id="+code);
    ajaxObj.send();

    
    cart = {
        price: 0,       // total price
        items: {},      // items 
        total: 0        // total number of items
    }
    
}
    
init();
    
    
// reload total raised chart when screen is resized
$(window).on('resize', function(){
    // on side bar
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawSmallChart);
    
    // on campaign goal
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
});


// draw total-raised chart
var chart_goal = true;
    
function drawChart() {

    
    if (chart_goal) {
     var data = new google.visualization.DataTable();
     data.addColumn('string', 'text');
     data.addColumn('number', 'number');

     data.addRows(2);
     data.setValue(0, 0, 'Total Raised');
     data.setValue(0, 1, 0);
     data.setValue(1, 0, 'Still Needed');
     data.setValue(1, 1, total_goal);

     var options = {
         pieHole: 0.6,
         chartArea: {
             width: 160,
             height: 160,
             backgroundColor: '#dbdbdb'
         },
         height: 180,
         colors: [ '#dbdbdb', '#039da6'],
         pieSliceBorderColor: '#dbdbdb',
         legend: 'none',
         pieSliceText: 'none',
         pieSliceBorderColor: 'white',
         reverseCategories: true,
         tooltip: {
             textStyle: {
                 fontName: "Gotham-Book",
                 fontSize: 14
             },
             text: 'value'
         },
         animation: {
             duration: 1000,
             easing: 'out',
             startup: true
         }
     };

     var chart = new google.visualization.PieChart(document.getElementById('div-chart'));
     chart.draw(data, options);


     // initial value
     var percent = 0;
     // start the animation loop
     var handler = setInterval(function(){
         // values increment
         
         if (total_percentage != 0) {
             percent += 1;
             document.getElementById('total-percentage').innerHTML = percent + "%";
             // apply new values
             data.setValue(0, 1, (total_goal * percent / 100));
             data.setValue(1, 1, total_goal - (total_goal * percent / 100));
             // update the pie
             chart.draw(data, options);
             // check if we have reached the desired value
             if (percent >= total_percentage)
                 // stop the loop
                 clearInterval(handler);

         } else {
                document.getElementById('total-percentage').innerHTML = percent + "%";
                clearInterval(handler);
         }
            
         
         
     }, 10);
        
    } else {
        
        // do not animate chart when resize screen
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'text');
        data.addColumn('number', 'number');

        data.addRows(2);
        data.setValue(0, 0, 'Total Raised');
        data.setValue(0, 1, total_raised);
        data.setValue(1, 0, 'Still Needed');
        data.setValue(1, 1, total_goal-total_raised);

        var options = {
            pieHole: 0.6,
            chartArea: {
                width: 160,
                height: 160,
                backgroundColor: '#dbdbdb'
            },
            height: 180,
            colors: [ '#dbdbdb', '#039da6'],
            pieSliceBorderColor: '#dbdbdb',
            legend: 'none',
            pieSliceText: 'none',
            pieSliceBorderColor: 'white',
            reverseCategories: true,
            tooltip: {
                trigger: 'none'
            },
            animation: {
                duration: 1000,
                easing: 'out',
                startup: true
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('div-chart'));
        chart.draw(data, options);

    }
    chart_goal = false;
}
        
// draw total-raised chart (tablet)
var chart_sidebar = true;
    
google.charts.load("current", {packages: ["corechart"]});
google.charts.setOnLoadCallback(drawSmallChart);

function drawSmallChart() {
    
    // animate when load first time
    if (chart_sidebar) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'text');
        data.addColumn('number', 'number');

        data.addRows(2);
        data.setValue(0, 0, 'Total Raised');
        data.setValue(0, 1, 0);
        data.setValue(1, 0, 'Still Needed');
        data.setValue(1, 1, total_goal);

        var options = {
            backgroundColor: 'none',
            pieHole: 0.6,
            chartArea: {
                width: 160,
                height: 160,
                backgroundColor: '#dbdbdb'
            },
            height: 180,
            colors: [ '#dbdbdb', '#039da6' ],
            pieSliceBorderColor: '#dbdbdb',
            legend: 'none',
            pieSliceText: 'none',
            pieSliceBorderColor: 'white',
            reverseCategories: true,
            tooltip: {
                trigger: 'none'
            },
            animation: {
                duration: 1000,
                easing: 'out',
                startup: true
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('small-total-raised'));
        chart.draw(data, options);

        // initial value
        var percent = 0;
        // start the animation loop
        var handler = setInterval(function(){
            // values increment
            
            if (total_percentage != 0) {
                percent += 1;
                document.getElementById('small-total-percentage').innerHTML = percent + "%";
                // apply new values
                data.setValue(0, 1, (total_goal * percent / 100));
                data.setValue(1, 1, total_goal - (total_goal * percent / 100));
                // update the pie
                chart.draw(data, options);
                // check if we have reached the desired value
                if (percent >= total_percentage)
                    // stop the loop
                    clearInterval(handler);
            } else {
                document.getElementById('small-total-percentage').innerHTML = percent + "%";
                clearInterval(handler);
            }
            
        }, 10);
        
        
    } else {
        
        // do not animate chart when resize screen
        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'text');
        data.addColumn('number', 'number');

        data.addRows(2);
        data.setValue(0, 0, 'Total Raised');
        data.setValue(0, 1, total_raised);
        data.setValue(1, 0, 'Still Needed');
        data.setValue(1, 1, total_goal-total_raised);

        var options = {
            pieHole: 0.6,
            chartArea: {
                width: 160,
                height: 160,
                backgroundColor: '#dbdbdb'
            },
            height: 180,
            colors: [ '#dbdbdb', '#039da6'],
            pieSliceBorderColor: '#dbdbdb',
            legend: 'none',
            pieSliceText: 'none',
            pieSliceBorderColor: 'white',
            reverseCategories: true,
            tooltip: {
                trigger: 'none'
            },
            animation: {
                duration: 1000,
                easing: 'out',
                startup: true
            }
        };

        var chart = new google.visualization.PieChart(document.getElementById('small-total-raised'));
        chart.draw(data, options);
    }
    chart_sidebar = false;
}
    

    
// Toggle mobile menu
 function toggle_menu() {
     
    // open menu
    if (!menu) {
        original_menu_height = $('#top-bar').height();
        $('#top-bar').animate({height: '40vh'}, '2000');
        document.getElementById('toggle-menu').style.display = 'block';
        
        $('#menu-icon').attr('src', 'img/menu_close.png');
        document.getElementById('top-bar-logo').innerHTML = '<div id="mobile-church"><img id="church-logo" alt="Church Logo" align="middle" src="img/church-logo.png"><span id="mobile-church-name" class="capitalize">'+campaign.church+'</span></div>';
        menu = true;
    } 
    // close menu
    else {
        
        document.getElementById('toggle-menu').style.display = 'none';
        $('#top-bar').animate({height: original_menu_height}, '2000');
        $('#menu-icon').attr('src', 'img/menu_open.png');
        document.getElementById('top-bar-logo').innerHTML = '<img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="img/wycliffe-logo.png">';
        menu = false;    
    }
    
}

// Toggle mobile cart
function toggle_cart() {
    
    // open menu
    if (!cart) {
        document.getElementById('cart-2').style.display = 'none';
        $('#cart-icon').attr('src', 'img/cart_open.png');
        $('#mobile-cart').animate({height: original_cart_height});
        cart = true;
        
    } 
    // close menu
    else {
        original_cart_height = $('#mobile-cart').height();
        $('#mobile-cart').animate({height: '100vh'});
        document.getElementById('cart-2').style.display = 'block';
        $('#cart-icon').attr('src', 'img/cart_close.png');
        cart = false;    
    }
}
    
     
// Toggle small sides
function toggle_small_total() {

    $('#small-total-content').slideToggle('2000', "swing");
    
    if (small_total) {
        $('#small-total-icon').attr('src', 'img/cart_close.png');
        small_total = false;
    } else {
        $('#small-total-icon').attr('src', 'img/cart_open.png');
        small_total = true;
        
        google.charts.load("current", {packages: ["corechart"]});
        google.charts.setOnLoadCallback(drawSmallChart);
    }
    
    if ($(window).height() < 900) {
        if (small_cart) {
            $('#small-cart-content').slideToggle('2000', "swing");
            $('#small-cart-icon').attr('src', 'img/cart_close.png');
            if (num_items != 0) {
                document.getElementById('num-items').style.display = "inline-block";
                document.getElementById('num-items').innerHTML = num_items;
            } else {
                document.getElementById('num-items').style.display = "none";
            }
            small_cart = false;
        }
    }
}
function toggle_small_cart() {

    $('#small-cart-content').slideToggle('2000', "swing");
    
    if (small_cart) {
        $('#small-cart-icon').attr('src', 'img/cart_close.png');
        small_cart = false;
        if (num_items != 0) {
            document.getElementById('num-items').style.display = "inline-block";
            document.getElementById('num-items').innerHTML = num_items;
        } else {
            document.getElementById('num-items').style.display = "none";
        }
        
    } else {
        $('#small-cart-icon').attr('src', 'img/cart_open.png');
        small_cart = true;
        document.getElementById('num-items').style.display = "none";
    }
    
    if ($(window).height() < 900) {
        if (small_total) {
            $('#small-total-content').slideToggle('2000', "swing");
            $('#small-total-icon').attr('src', 'img/cart_close.png');
            small_total = false;
        }
    }
} 

function toggle_small_language() {

    $('#small-language-content').slideToggle('2000', "swing");
    
    if (small_language) {
        $('#small-language-icon').attr('src', 'img/cart_close.png');
        small_language = false;
    } else {
        $('#small-language-icon').attr('src', 'img/cart_open.png');
        small_language = true;
    }
    
    if ($(window).height() < 900) {
        if (small_photo) {
            $('#small-photo-content').slideToggle('2000', "swing");
            $('#small-photo-icon').attr('src', 'img/cart_close.png');
            small_photo = false;
        }
    }
}
function toggle_small_photo() {

    $('#small-photo-content').slideToggle('2000', "swing");
    
    if (small_photo) {
        $('#small-photo-icon').attr('src', 'img/cart_close.png');
        small_photo = false;
        
    } else {
        $('#small-photo-icon').attr('src', 'img/cart_open.png');
        small_photo = true;
    }
    
    if ($(window).height() < 900) {
        if (small_language) {
            $('#small-language-content').slideToggle('2000', "swing");
            $('#small-language-icon').attr('src', 'img/cart_close.png');
            small_language = false;
        }
    }
} 


    
    
    
// GIVE
    
var give_data = {
    first_name: "",
    last_name: "",
    email: "",
    display_name: "",
    honor_name: ""
}
    
var anonymous = false;
var honor = false;

function give_anonymous() {
    if (anonymous) {
        document.getElementById('give-display-name').style.display = "inline-block";
        document.getElementById('give-display-name').value = "";
        document.getElementById('give-display-name').setAttribute('placeholder','Display Name');
        document.getElementById('give-options').style.marginTop = "0";
        document.getElementById('give-display-name').style.borderColor = '#d1d1d1';
        anonymous = false;
        
        give_data.display_name = "";
    } else {
        document.getElementById('give-display-name').style.display = "none";
        document.getElementById('give-honor-name').style.display = "none";
        document.getElementById('give-options').style.marginTop = "-0.8em";
        anonymous = true;
        honor = false;
        document.getElementById('give-options').innerHTML = '<input id="give-anonymous" class="checkbox-custom" name="give-anonymous" type="checkbox" onclick="give_anonymous()"><label for="give-anonymous" class="checkbox-custom-label">Give anonymously</label><br><input id="give-honor" class="checkbox-custom" name="give-honor" type="checkbox" onclick="give_honor()"><label for="give-honor" class="checkbox-custom-label">Give in honor of someone else</label>';
        document.getElementById('give-anonymous').setAttribute('checked','true');
        document.getElementById('give-display-name').setAttribute('placeholder','Display Name');
    }
    
    
    if (anonymous) {
        give_preview(" by Anonymous");
    } else {
        if (give_data.first_name == "") {

            if (give_data.last_name == "") {
                give_preview("");
            } else {
                give_preview(" by " + give_data.last_name[0]);
            }

        } else {

            if (give_data.last_name == "") {
                give_preview(" by " + give_data.first_name);
            } else {
                give_preview(" by " + give_data.first_name + " " + give_data.last_name[0]);
            }
        }

    }
    
}
    
function give_honor() {
    if (honor) {
        document.getElementById('give-honor-name').style.display = "none";
        document.getElementById('give-display-name').setAttribute('placeholder','Name');
        honor = false;
    } else {
        document.getElementById('give-display-name').style.display = "inline-block";
        document.getElementById('give-honor-name').style.display = "inline-block";
        document.getElementById('give-display-name').setAttribute('placeholder','From Name');
        document.getElementById('give-display-name').style.borderColor = '#d1d1d1';
        document.getElementById('give-honor-name').style.borderColor = '#d1d1d1';
        document.getElementById('give-honor-name').value = "";
        document.getElementById('give-options').style.marginTop = "0";
        honor = true;
        anonymous = false;
        document.getElementById('give-options').innerHTML = '<input id="give-anonymous" class="checkbox-custom" name="give-anonymous" type="checkbox" onclick="give_anonymous()"><label for="give-anonymous" class="checkbox-custom-label">Give anonymously</label><br><input id="give-honor" class="checkbox-custom" name="give-honor" type="checkbox" onclick="give_honor()"><label for="give-honor" class="checkbox-custom-label">Give in honor of someone else</label>';
        document.getElementById('give-honor').setAttribute('checked','true');
        
        give_data.honoree_name = "";
    }
    
    
    
    if (honor) {
        give_preview(" in honor of "+give_data.honor_name+" by "+give_data.display_name);
    } else {
        if (give_data.display_name == "") {

            if (give_data.first_name == "") {

                if (give_data.last_name == "") {
                    give_preview("");
                } else {
                    give_preview(" " + give_data.last_name[0]);
                }

            } else {

                if (give_data.last_name == "") {
                    give_preview(" " + give_data.first_name);
                } else {
                    give_preview(" " + give_data.first_name + " " + give_data.last_name[0]);
                }
            }

        } else {

            if (!anonymous) {
                give_preview(" " + give_data.display_name);
            }
        }
    }
    
    
}
    
    
function open_give() {
    if (cart.total != 0) {
        window.location.href = "app.php?id="+code+"#give";
    }
}
    
function close_give() {
    window.location.href = "app.php?id="+code+"#";
}
 
    
$( "#give-email" ).focusout(function() {
    input_form('email');
});

function input_form(title) {
    
    var word = document.getElementById('give-'+title);
    
    switch(title) {
        case 'first-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            give_data.first_name = document.getElementById('give-first-name').value;
            if (!honor && !anonymous && give_data.first_name != "" && give_data.display_name == "") {
                if (give_data.last_name == "") {
                    give_preview(" by " + give_data.first_name);
                } else {
                    give_preview(" by " + give_data.first_name + " " + give_data.last_name[0]);
                }
                
            }
            break;
        case 'last-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            give_data.last_name = document.getElementById('give-last-name').value;
            if (!honor && !anonymous && give_data.last_name != "" && give_data.display_name == "") {
                if (give_data.first_name == "") {
                    give_preview(" by " + give_data.last_name[0]);
                } else {
                    give_preview(" by " + give_data.first_name + " " + give_data.last_name[0]);
                }
            }
            break;
        case 'email':
            document.getElementById('error-email').style.visibility = "visible";

            var valid = true;
            give_data.email = "";

            if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(word.value))) {
                document.getElementById('error-email').className = "error red";
                document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="img/error_invalid.png">Email is invalid';
                valid = false;
            }

            if (valid) {
                give_data.email = word.value;
                document.getElementById('error-email').className = "error green";
                document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="img/error_valid.png">Email is valid';
            }

            break;
            
        case "display-name":
            word.value = word.value.replace(/[^a-zA-Z0-9\.\s]+/, '');
            give_data.display_name = document.getElementById('give-display-name').value;
            
            if (honor) {
                give_preview(" in honor of "+give_data.honor_name+" by "+give_data.display_name);
            } else {
                if (give_data.display_name == "") {
                
                    if (give_data.first_name == "") {

                        if (give_data.last_name == "") {
                            give_preview("");
                        } else {
                            give_preview(" by " + give_data.last_name[0]);
                        }

                    } else {

                        if (give_data.last_name == "") {
                            give_preview(" by " + give_data.first_name);
                        } else {
                            give_preview(" by " + give_data.first_name + " " + give_data.last_name[0]);
                        }
                    }

                } else {
                    
                    if (!anonymous) {
                        give_preview(" by " + give_data.display_name);
                    }
                }
            }
            
            
            break;
        case "honor-name":
            word.value = word.value.replace(/[^a-zA-Z0-9\.\s]+/, '');
            give_data.honor_name = document.getElementById('give-honor-name').value;
            if (honor) {
                give_preview(" in honor of "+give_data.honor_name+" by "+give_data.display_name);
            }
            break;
        default:
            break;
    }
}
    
    
function give_preview(v) {
    document.getElementById('give-preview').innerHTML = v;
}
    
    
function checkout() {
    
    console.log(give_data);
    
    var valid = true;
    
    document.getElementById('give-first-name').style.borderColor = "#d1d1d1";
    document.getElementById('give-last-name').style.borderColor = "#d1d1d1";
    document.getElementById('give-email').style.borderColor = "#d1d1d1";
    document.getElementById('give-display-name').style.borderColor = "#d1d1d1";
    document.getElementById('give-honor-name').style.borderColor = "#d1d1d1";
    
    
    if(give_data.first_name == "") {
        document.getElementById('give-first-name').style.borderColor = "#db5353";
        document.getElementById('give-first-name').focus();
        valid = false;
    } else if(give_data.last_name == "") {
        document.getElementById('give-last-name').style.borderColor = "#db5353";
        document.getElementById('give-last-name').focus();
        valid = false;
    } else if(give_data.email == "") {
        document.getElementById('give-email').style.borderColor = "#db5353";
        document.getElementById('give-email').focus();
        valid = false;
    }
    
    
    if (honor) {
        
        if (give_data.display_name == "") {
            give_data.display_name = give_data.first_name + " " + give_data.last_name[0];
        }
        
    } else if (anonymous) {
        
        if(give_data.honor_name == "") {
            document.getElementById('give-honor-name').style.borderColor = "#db5353";
            document.getElementById('give-honor-name').focus();
            valid = false;
        }
        
    } else {
        
        if (give_data.display_name == "") {
            give_data.display_name = give_data.first_name + " " + give_data.last_name[0];
        }
        
    }
    
    
    if (valid) {
        
        function sortNumber(a,b) {
            return a - b;
        }

        // sort selected items
        var sorted = [];
        for(var key in selected) {
            sorted[sorted.length] = key;
        }
        sorted.sort();

        var items = {};
        for(var i = 0; i < sorted.length; i++) {
            items[sorted[i]] = selected[sorted[i]].sort(sortNumber);
        }
        
        var param_items = "";
        var first_item = true;
        for (b in items) {
            for (c in items[b]) {
                if (first_item) {
                    param_items += b + ":" + items[b][c];
                    first_item = false;
                } else {
                    param_items += "." + b + ":" + items[b][c];
                }
            }
        }
        
        var params = 'campaign='+code+'&first_name='+give_data.first_name+'&last_name='+give_data.last_name+'&email='+give_data.email+'&book='+book+'&items='+param_items+'&amount='+cart.price+'&display_name='+give_data.display_name+'&honoree_name='+give_data.honor_name+'&verse_price='+campaign.verse_price;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "yes\n\n\n") {
                
                window.location.href = "transaction.php";
                
            } else {
                
                alert("Error: "+ajaxObj.responseText);
                
            }
            
        }}}
        ajaxObj.open("GET", "sql-give.php?"+params);
        ajaxObj.send();
        
    }
    
    
    
    
}
    
    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>