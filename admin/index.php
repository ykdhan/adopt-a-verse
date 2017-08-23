<?php 
session_start();
if (isset($_SESSION['aav-super-admin'])) { 
    header('Location: admin.php');
} else if (isset($_SESSION['aav-admin'])) { 
    header('Location: church.php');
} else {
    header('Location: ../login.php');
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

    
<!-- Body -->
<div id="bg" align="center">
<div id="landing-wrapper">
    
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

    

<script>

    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>