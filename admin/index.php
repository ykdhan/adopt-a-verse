<?php 
session_start();
if(!isset($_SESSION['aav-admin'])) { 
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

    
    
    
    <?php 
    
    error_reporting(E_ALL ^ E_DEPRECATED);

    include('config.php');

    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($mysqli->connect_errno) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    
    $sql = "SELECT *, campaign.id AS cam_id FROM campaign INNER JOIN church ON church_id = church.id INNER JOIN language ON language_id = language.id WHERE campaign.id = '".$_SESSION['aav-admin']."'";
    
    $info_id = "";
    $info_church = "";
    $info_language = "";
    $info_book = "";
    $info_start_date = "";
    $info_end_date = "";
    $info_first_name = "";
    $info_last_name = "";
    $info_url = "";

    if ($result = $mysqli->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            $info_id = $row['cam_id'];                          // id
            $info_church = $row['name'];                        // church name
            $info_language = $row['people_group'];              // language
            $info_book = $row['book'];                          // book
            $info_start_date = $row['start_date'];              // start date
            $info_end_date = $row['end_date'];                  // end date
            $info_first_name = $row['first_name'];              // first name
            $info_last_name = $row['last_name'];                // last name
            $info_url = $row['url'];                            // url
        } 
    }
    
    
    ?>
    
    
    
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
        <span id="admin-logout"><a href="logout.php">Logout</a></span>
        <span id="admin-title"></span>
    </td>
    </tr></table>
</div>
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="wrapper">
        
    <div id="content-index" class="admin-content">
        <div id="title">Welcome</div>
        
        <section>
            <div id="introduction">Hello, <?php echo $info_first_name." ".$info_last_name; ?>.
            </div>    
        </section>
        
        <section>
            <div class="column-left">Church</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_church; ?></p>
            </div>
            <div class="column-left">Campaign Url</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p>adopt.wycliffe.org/<?php echo $info_url; ?></p>
            </div>
            <div class="column-left">Campaign Duration</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo date("F j, Y", strtotime($info_start_date))." - ".date("F j, Y", strtotime($info_end_date)); ?></p>
            </div>
            
            <div class="column-left"></div>
            <div class="column-tip"></div>
            <div class="column-right">
                <a href="campaign-profile.php"><button type="button" class="admin-button">View Details</button></a>
            </div>
        </section> 
    </div>
      
    
</div> <!-- wrapper -->
</div> <!-- bg -->
    
    

    

<script>
    

    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>