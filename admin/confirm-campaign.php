

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
    <script type="text/javascript" src="../js/countdown.js"></script>
    
    
    <script type="text/javascript" src="../js/remodal.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/remodal-default-theme.css" />
    <link rel="stylesheet" type="text/css" href="../css/remodal.css" />
    <link href="https://cdn.quilljs.com/1.3.0/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.0/quill.js"></script>
    
    
    <!-- Wycliffe links -->

    
    
    <style>
        #details-goal-description p {
            margin: 0;
            padding: 0;
        }
    </style>
    
</head>
    
<body>
    
<!-- Top Bar -->
<div class="top-bar desktop">
    <div id="confirm-top-bar">
        <img id="adopt-logo-big" alt="Adopt-a-Verse Logo" align="middle" src="../img/wycliffe-logo-white.png">
    </div>
</div>
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="confirm-wrapper">
     
    <div class="lightbox">
        <div id="title">Confirm Campaign</div>
        <section>
            <div class="col-left">Church</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <p id="details-church"></p>
            </div>
            <div class="col-left">Campaign Url</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <p id="details-url">adopt.wycliffe.org</p>
            </div>
            <div class="col-left">Campaign Duration</div>
            <div class="col-tip"></div>
            <div class="col-right" id="campaign-duration">
                <p id="details-duration"></p>
            </div>
            <div class="col-left d-day"></div>
            <div class="col-tip d-day"></div>
            <div class="col-right d-day">
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
        <section>
            <div class="col-left">Fund ID</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <input type="text" class="admin-text" id="fund-id" placeholder="Fund ID"><span class="error" id="error-fund"></span><br>
                
            </div>
        </section>
        <section class="last-section" id="details-buttons">
            <p class="message" id="admin-message">A notification email will be sent to the Wycliffe admin.</p>
            <button type="button" id="admin-button" class="admin-submit" onclick="confirm_campaign()">Confirm Campaign</button>
        </section>
    </div>
    
    
</div> <!-- wrapper -->
    
    <div id="footer">
        ©2017 Wycliffe Bible Translators. All rights reserved.
    </div>
</div> <!-- bg -->
    
    


    

<script>

var page_param = window.location.search.substring(1);
var page_url = new URL(window.location.href);
var campaign_id = page_url.searchParams.get("id");
    
load_campaign();
    
function load_campaign() {
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            
            if (ajaxObj.responseText == "no\n") {
                alert("Error: Invalid campaign");
                window.location.href = "index.php";
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                var book = resp['book'];
                var language = resp['language'];
                var goal_description = resp['goal_description'];
                var goal_amount = resp['goal_amount'];
                var verse_price = resp['verse_price'];
                var start_date = new Date(resp['start_date']);
                var end_date = new Date(resp['end_date']);
                var url = resp['url'];
                var verified = resp['verified'];
                var church = resp['church'];
                
                if (verified != 0) {
                    alert("This campaign has already been confirmed.");
                    window.location.href = "index.php";
                } else {
                    var start_year = (""+start_date.getFullYear()).slice(-2);
                    var start_month = start_date.getMonth() + 1;
                    var end_year = (""+end_date.getFullYear()).slice(-2);
                    var end_month = end_date.getMonth() + 1;
                    var start = start_month+"/"+start_date.getDate()+"/"+start_year;
                    var end = end_month+"/"+end_date.getDate()+"/"+end_year;

                    document.getElementById('details-book').innerHTML = book;
                    document.getElementById('details-language').innerHTML = language;
                    document.getElementById('details-goal-description').innerHTML = goal_description;
                    document.getElementById('details-goal-amount').innerHTML = "&#36;"+goal_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    document.getElementById('details-verse-price').innerHTML = "&#36;"+verse_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    document.getElementById('details-duration').innerHTML = start+" - "+end;
                    document.getElementById('details-url').innerHTML = url;
                    document.getElementById('details-church').innerHTML = church;

                    countdownDate(resp['start_date']);
                    
                }
                
                
            }
            
        }}}
        ajaxObj.open("GET", "sql-church-campaign.php?id="+campaign_id);
        ajaxObj.send();
        
}
    
    
    
    
// CHECK NEW FUND ID
    
var fund_id = "";
    
function check_fund_id() {
    
    var fund = document.getElementById('fund-id');
    
    document.getElementById('error-fund').style.visibility = "visible";

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        var valid = true;
        fund_id = "";
        
        if (ajaxObj.responseText == "yes\n") {
            document.getElementById('error-fund').className = "error red";
            document.getElementById('error-fund').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Fund ID already exists';
            valid = false;
        } 
        
        if (valid) {
            fund_id = fund.value;
            document.getElementById('error-fund').className = "error green";
            document.getElementById('error-fund').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Fund ID is valid';
        }

    }}}
    ajaxObj.open("GET", "sql-check-fund-id.php?id="+fund.value);
    ajaxObj.send();
}
    
$( "#fund-id" ).focusout(function() {
    check_fund_id();
});

    

    
// CONFIRM CAMPAIGN
    
function confirm_campaign() {
    
    var valid = true;
    
    document.getElementById('fund-id').style.borderColor = "#d1d1d1";

    if (fund_id == "") {
        document.getElementById('fund-id').style.borderColor = "#db5353";
        document.getElementById('fund-id').focus();
        valid = false;
    } 
    
    if (valid) {
        
        var params = 'campaign_id='+campaign_id+'&fund_id='+fund_id;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            console.log(ajaxObj.responseText);

            if (ajaxObj.responseText != "no\n\n\n") {
                alert("Campaign is confirmed.");
                window.location.href = "index.php";
                
            } else {
                alert("Error occurred");
            }
            
        }}}
        ajaxObj.open("GET", "sql-confirm-campaign.php?"+params);
        ajaxObj.send();
        
    }
}


    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>