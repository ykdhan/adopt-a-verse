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
        <a href="index.php"><img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="img/wycliffe-logo.png"></a>
    </td>
    <th>
        <div class="div-tab font--bold">
        <button class="tabs capitalize tabs-now" onclick="tab(event, 'tab-donate')">Donate</button>
        <button class="tabs capitalize" onclick="tab(event, 'tab-about')">About the Language</button>
        <button class="tabs capitalize" onclick="tab(event, 'tab-goal')">Our Campaign Goal</button>
        </div>
    </th>
    <td>
        <table class="top-bar-church">
        <tr>
        <td id="cell-church-logo">
            <img id="church-logo" alt="Church Logo" align="middle" src="img/church-logo.png">
        </td>    
        <td id="cell-church-name" class="capitalize">
            
        </td>
        </tr>
        </table>
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
            <button class="capitalize tabs" onclick="tab(event, 'tab-about')">About the Language</button>
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
            <div class="tab-title">About the Language</div>
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
            <div class="tab-title">Our Campaign Goal</div>
            <div id="campaign-description" class="tab-text">
                
            </div>
            <div class="tab-title top-gap">Total Raised</div>
            <div class="tab-text">
                
                <div id="div-chart">
                    <!-- Donut graph -->
                </div>

                <!-- Still need -->
                <div id="div-chart-info">
                    <div class="goal-total-info-1">
                        Still Need <span id="total-still-need"></span><br>
                    </div>

                    <!-- Total goal -->
                    <div class="goal-total-info-2">
                        Goal <span id="total-goal"></span>
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
                    Still Need <span id="small-total-still-need"></span><br>
                </div>

                <!-- Total goal -->
                <div class="total-info-2">
                    Goal <span id="small-total-goal"></span>
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
                    <button id="small-checkout" class="checkout border--round empty">Give $0</button>
                </div>
            </div>
        </div>
        
        
        <!-- Language Group Details Side Bar -->
        <div id="small-side-language" class="small-sides border--round hide">
            <div id="small-language" class="small-side-bar" onclick="toggle_small_language()">
                <span class="small-title capitalize">Language Group Details</span>
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
                        <span class="details-title">People Group(s)</span><br>
                        <span class="details-info" id="details-people-group"></span>
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
    
    

    

<script>
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
    
    var ajaxObj = new XMLHttpRequest();
	ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
		var resp = JSON.parse(ajaxObj.responseText);
        if (resp.status == 0) {
            alert("The campaign does not exist.");
        }


        campaign.book = resp.info.book;
        campaign.church = resp.info.church;
        campaign.language = resp.info.language;
        campaign.project_description = resp.info.project_description;
        campaign.goal_description = resp.info.goal_description;
        campaign.goal_amount = parseFloat(resp.info.goal_amount).toFixed(2);
        campaign.verse_price = parseFloat(resp.info.verse_price).toFixed(2);
        campaign.start_date = resp.info.start_date;
        campaign.end_date = resp.info.end_date;
        campaign.region = resp.info.region;
        campaign.number_of_speakers = parseInt(resp.info.number_of_speakers);
        campaign.scripture_published = resp.info.scripture_published;
        campaign.pdf_url = resp.info.pdf_url;
        
        book = campaign.book;
        //document.getElementById('data-verse-price').value = campaign.verse_price;
        //document.getElementById('data-total-goal').value = campaign.goal_amount;
        verse_price = parseFloat(campaign.verse_price).toFixed(2);
        total_goal = parseFloat(campaign.goal_amount).toFixed(2);
        
        document.getElementById('book').innerHTML = book;
        document.getElementById('campaign-language').innerHTML = campaign.language;
        document.getElementById('campaign-region').innerHTML = campaign.region;
        document.getElementById('cell-church-name').innerHTML = campaign.church;
        document.getElementById('language-description').innerHTML = "<p>"+campaign.project_description+"</p>";
        document.getElementById('campaign-description').innerHTML = "<p>"+campaign.goal_description+"</p>";
        document.getElementById('details-region').innerHTML = campaign.region;
        document.getElementById('details-people-group').innerHTML = campaign.language;
        document.getElementById('details-native-speakers').innerHTML = campaign.number_of_speakers;
        document.getElementById('details-scripture-published').innerHTML = campaign.scripture_published;
        document.getElementById('download-pdf').innerHTML = '<a href="'+campaign.pdf_url+'" target="_blank"><button class="tab-button" type="button">View PDF</button></a>';
    
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
        
        
        total_adopted = 10;
        total_verses = 750;
        total_raised = 100;
        total_percentage = total_raised / total_goal * 100;


        // fill in the fields on page
        document.getElementById('total-adopted').innerHTML = total_adopted;
        document.getElementById('total-verses').innerHTML = total_verses;
        document.getElementById('small-total-adopted').innerHTML = total_adopted;
        document.getElementById('small-total-verses').innerHTML = total_verses;
        
	}}}
	ajaxObj.open("GET", "search-campaign.php?campaign="+code);
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


     document.getElementById('total-goal').innerHTML = "$" + total_goal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
     var total_still_need = total_goal - total_raised;
     document.getElementById('total-still-need').innerHTML = "$" + total_still_need.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

     // initial value
     var percent = 0;
     // start the animation loop
     var handler = setInterval(function(){
         // values increment
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


        document.getElementById('total-goal').innerHTML = "$" + total_goal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
         var total_still_need = total_goal - total_raised;
         document.getElementById('total-still-need').innerHTML = "$" + total_still_need.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
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


        document.getElementById('small-total-goal').innerHTML = "$" + total_goal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        var total_still_need = total_goal - total_raised;
        document.getElementById('small-total-still-need').innerHTML = "$" + total_still_need.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

        // initial value
        var percent = 0;
        // start the animation loop
        var handler = setInterval(function(){
            // values increment
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


        document.getElementById('small-total-goal').innerHTML = "$" + total_goal.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        var total_still_need = total_goal - total_raised;
        document.getElementById('small-total-still-need').innerHTML = "$" + total_still_need.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
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

    
    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>