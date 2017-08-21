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


    
    <!-- Wycliffe links -->

    
</head>
    
<body>
    
    
<!-- Body -->
<div id="bg" align="center">
    

<div class='body'>
  <span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </span>
  <div class='base'>
    <span></span>
    <div class='face'></div>
  </div>
</div>
<div class='longfazers'>
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div>
<h1 id="transaction-title">Delivering your verses</h1>
    
<form action="https://www.wycliffe.org/p/Contributions/Contributions/addToCart">
    <fieldset id="transaction-form">
        <input type="hidden" name="campaign_id" id="campaign" value="">
        <!--<input type="hidden" name="transaction_id" id="transaction" value="">-->
        <input type="number" step="any" name="amount" id="amount" required="" min="0" max="100000">
        <input id="submit" type="submit" value="Submit">
    </fieldset>
</form>
    
    
</div> <!-- bg -->
    
    

<script>
    
var page_param = window.location.search.substring(1);
var page_url = new URL(window.location.href);
var transaction = page_url.searchParams.get("transaction");
var campaign = 12495; //page_url.searchParams.get("campaign");
var amount = page_url.searchParams.get("amount");
    
console.log(transaction);
console.log(campaign);
console.log(amount);

//document.getElementById('transaction').value = transaction;
document.getElementById('campaign').value = campaign;
document.getElementById('amount').value = amount;
$('#submit').click();
    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>