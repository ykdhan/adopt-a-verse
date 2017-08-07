<?php 
session_start();
$id = "";
if(isset($_SESSION['aav-admin']) || isset($_SESSION['aav-super-admin'])) { 
    $id = $_GET['id'];
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

    
    
    
    <?php 
    
    error_reporting(E_ALL ^ E_DEPRECATED);

    include('config.php');

    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    if ($mysqli->connect_errno) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    
    $sql = "SELECT *, campaign.id AS cam_id FROM campaign INNER JOIN church ON church_id = church.id INNER JOIN language ON language_id = language.id INNER JOIN user ON user_id = user.id WHERE campaign.id = '".$id."'";
    
    $info_id = "";
    $info_church = "";
    $info_language = "";
    $info_book = "";
    $info_goal_description = "";
    $info_goal_amount = "";
    $info_verse_price = "";
    $info_start_date = "";
    $info_end_date = "";
    $info_first_name = "";
    $info_last_name = "";
    $info_phone = "";
    $info_email = "";
    $info_url = "";

    if ($result = $mysqli->query($sql)) {

        while ($row = $result->fetch_assoc()) {
            $info_id = $row['cam_id'];                          // id
            $info_church = $row['name'];                        // church name
            $info_language = $row['people_group'];              // language
            $info_book = $row['book'];                          // book
            $info_goal_description = $row['goal_description'];  // goal description
            $info_goal_amount = $row['goal_amount'];            // total goal
            $info_verse_price = $row['verse_price'];            // verse price
            $info_start_date = $row['start_date'];              // start date
            $info_end_date = $row['end_date'];                  // end date
            $info_first_name = $row['first_name'];              // first name
            $info_last_name = $row['last_name'];                // last name
            $info_phone = $row['phone'];                        // phone
            $info_email = $row['email'];                        // email
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
        <a href="index.php"><img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="../img/wycliffe-logo.png"><span id="tag-admin">Admin</span></a>
    </td>
    <th>
    </th>
    <td>
        <span id="admin-logout"><a href="logout.php">Logout</a></span>
        <span id="admin-title">Church Campaign</span>
    </td>
    </tr></table>
</div>

    
    
    
<!-- Body -->
<div id="bg" align="center">
<div id="wrapper">
        
    <div id="content-create-campaign-result" class="admin-content">
        <div id="title">Campaign Profile</div>
            
        <section>
            
            
            <div class="column-left">Church</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_church; ?></p>
            </div>
            
            <div class="column-left">Url</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p>adopt.wycliffe.org/<?php echo $info_url; ?></p>
            </div>
            
            <div class="column-left">Campaign Duration</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo date("F j, Y", strtotime($info_start_date))." - ".date("F j, Y", strtotime($info_end_date)); ?></p>
            </div>
        </section>
        <section>
            <div class="column-left">Admin Account</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_email; ?></p>
            </div>
            <div class="column-left">Contact</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_first_name." ".$info_last_name; ?></p>
                <p><?php echo $info_phone; ?></p>
            </div>
        </section>
        <section>
            <div class="column-left">Language</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_language; ?></p>
            </div>
            <div class="column-left">Book</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p><?php echo $info_book; ?></p>
            </div>
        </section>
        <section>
            <div class="column-left">Goal Description</div>
            <div class="column-tip"><span class="tool-tip">?</span></div>
            <div class="column-right">
                <?php echo "<div id='div-description'>".$info_goal_description."</div>"; ?>
            </div>
            <div class="column-left">Total Goal Amount</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p>&#36; <?php echo $info_goal_amount; ?></p>
            </div>
            <div class="column-left">Cost per Verse</div>
            <div class="column-tip"></div>
            <div class="column-right">
                <p>&#36; <?php echo $info_verse_price; ?></p>
            </div>
        </section>
        <section id="last-section">
            <a href='<?php echo "edit-church-campaign.php?id=".$info_id; ?>'>
                <button type="button" class="admin-button">Edit Campaign</button>
            </a>
            <a href='<?php echo "../app.php?id=".$info_id; ?>' target="_blank">
                <button type="button" class="admin-submit">Go to Campaign</button>
            </a>
        </section>
    </div>


         
    <div id="footer">
        ©2017 Wycliffe Bible Translators. All rights reserved.
    </div> 
    
    
    
</div> <!-- wrapper -->
    
    
</div> <!-- bg -->
    
    

    

<script>
    

    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>