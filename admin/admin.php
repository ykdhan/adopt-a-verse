<?php 
session_start();
if (isset($_SESSION['aav-admin'])) { 
    header('Location: index.php');
} else if (!isset($_SESSION['aav-super-admin'])) { 
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
    <script type="text/javascript" src="../js/countdown.js"></script>
    
    
    <script type="text/javascript" src="../js/remodal.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/remodal-default-theme.css" />
    <link rel="stylesheet" type="text/css" href="../css/remodal.css" />
    <link href="https://cdn.quilljs.com/1.3.0/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.0/quill.js"></script>
    
    
    <!-- Wycliffe links -->
    <style>
    body {
        overflow: hidden;
    }
    </style>
    
</head>
    
<body>
    
<div id="admin-layout">
    

    
    
<!-- Top Bar -->
<div id="side">
    <div id="section-logo">
        <a href="index.php"><img id="adopt-logo" alt="Adopt-a-Verse Logo" align="middle" src="../img/wycliffe-admin-logo.png"><span id="tag-admin">Admin</span></a>
    </div>
    <div id="section-tab">
        <button class="landing-tabs landing-tabs-now" onclick="landing_tab(event, 'tab-campaign')"><img alt="" src="../img/icon_campaign.svg"><br>Campaigns</button>
        <button class="landing-tabs" onclick="landing_tab(event, 'tab-church')"><img alt="" src="../img/icon_church.svg"><br>Churches</button>
        <button class="landing-tabs" onclick="landing_tab(event, 'tab-language')"><img alt="" src="../img/icon_language.svg"><br>Languages</button>
        <button class="landing-tabs" onclick="landing_tab(event, 'tab-user')"><img alt="" src="../img/icon_user.svg"><br>Users</button>
        <button class="landing-tabs" onclick="landing_tab(event, 'tab-transaction')"><img alt="" src="../img/icon_transaction.svg"><br>Transactions</button>
    </div>
    <div id="section-setting">
        <div class="side-division"></div>
        <button class="button-setting" onclick="logout()">Logout</button>
    </div>
</div>
    
    
<!-- Body -->
<div id="main">
    
    
<div id="landing-wrapper">
    
    <div id="tab-campaign" class="landing-content landing-content-now">
        <h1>Campaigns</h1>
        <div class="control-bar">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="landing-text" id="search-campaign" onkeyup="search_campaign()" placeholder="Search by a book of the Bible, language or church name">
            <div class="filters">
            Filter by <button type="button" class="admin-filter" id="filter-status">Status<span class="filter-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span></button>
                <div class="filter-dropdown" id="dropdown-status">
                    <div class="filter-option"><input id="status-inprogress" class="checkbox-custom" name="status-inprogress" type="checkbox" onclick="filter_by('status','inprogress')" checked="true"><label for="status-inprogress" class="checkbox-custom-label">In Progress</label></div>
                    <div class="filter-option"><input id="status-scheduled" class="checkbox-custom" name="status-scheduled" type="checkbox" onclick="filter_by('status','coming')" checked="true"><label for="status-scheduled" class="checkbox-custom-label">Scheduled</label></div>
                    <div class="filter-option"><input id="status-pending" class="checkbox-custom" name="status-pending" type="checkbox" onclick="filter_by('status','pending')" checked="true"><label for="status-pending" class="checkbox-custom-label">Pending</label></div>
                    <div class="filter-option"><input id="status-complete" class="checkbox-custom" name="status-complete" type="checkbox" onclick="filter_by('status','complete')" checked="true"><label for="status-complete" class="checkbox-custom-label">Complete</label></div>
                    <div class="filter-option-division"></div>
                    <div class="filter-option"><input id="status-all" class="checkbox-custom" name="status-all" type="checkbox" onclick="filter_by('status','all')" checked="true"><label for="status-all" class="checkbox-custom-label">All</label></div>
                </div>
            </div>
        </div>
        <div class="list-columns"><div class="col-campaign">
            <div class="list-column" id="column-campaign-status">Status</div>
            <div class="list-column" id="column-campaign-church">Church</div>
            <div class="list-column" id="column-campaign-book">Book</div>
            <div class="list-column" id="column-campaign-language">Language</div>
            <div class="list-column" id="column-campaign-url">URL</div>
            <div class="list-column" id="column-campaign-duration">Duration</div>
            <div class="list-column" id="column-campaign-percentage">Funded</div>
            </div>
        </div>
        <div class="list" id="list-campaign">Not Available</div>
    </div>
    
    <div id="tab-church" class="landing-content">
        
        <h1>Churches</h1>
        <div class="control-bar">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="landing-text" id="search-church" onkeyup="search_church()" placeholder="Search by church name, account number or state">
            <a href="#add-church"><button type="button" class="button-add"><i class="fa fa-plus" aria-hidden="true"></i> Add Church</button></a>
        </div>
        <div class="list-columns"><div class="col-church">
            <div class="list-column" id="column-church-profile-picture"></div>
            <div class="list-column" id="column-church-name">Name</div>
            <div class="list-column" id="column-church-state">State</div>
            <div class="list-column" id="column-church-contact">Contact</div>
            <div class="list-column" id="column-church-campaign">Campaigns</div>
        </div></div>
        <div class="list" id="list-church">Not Available</div>
        
    </div>
    
    <div id="tab-language" class="landing-content">
        
        <h1>Languages</h1>
        <div class="control-bar">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="landing-text" id="search-language" onkeyup="search_language()" placeholder="Search by ID, people group or region">
            <a href="#add-language"><button type="button" class="button-add"><i class="fa fa-plus" aria-hidden="true"></i> Add Language</button></a>
            <div class="filters">
            Filter by <button type="button" class="admin-filter" id="filter-continent">Continent<span class="filter-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span></button>
                <div class="filter-dropdown" id="dropdown-continent">
                    <div class="filter-option"><input id="continent-asia" class="checkbox-custom" name="continent-asia" type="checkbox" onclick="filter_by('continent','asia')" checked="true"><label for="continent-asia" class="checkbox-custom-label">Asia</label></div>
                    <div class="filter-option"><input id="continent-africa" class="checkbox-custom" name="continent-africa" type="checkbox" onclick="filter_by('continent','africa')" checked="true"><label for="continent-africa" class="checkbox-custom-label">Africa</label></div>
                    <div class="filter-option"><input id="continent-europe" class="checkbox-custom" name="continent-europe" type="checkbox" onclick="filter_by('continent','europe')" checked="true"><label for="continent-europe" class="checkbox-custom-label">Europe</label></div>
                    <div class="filter-option"><input id="continent-north-america" class="checkbox-custom" name="continent-north-america" type="checkbox" onclick="filter_by('continent','north_america')" checked="true"><label for="continent-north-america" class="checkbox-custom-label">North America</label></div>
                    <div class="filter-option"><input id="continent-south-america" class="checkbox-custom" name="continent-south-america" type="checkbox" onclick="filter_by('continent','south_america')" checked="true"><label for="continent-south-america" class="checkbox-custom-label">South America</label></div>
                    <div class="filter-option"><input id="continent-australia" class="checkbox-custom" name="continent-australia" type="checkbox" onclick="filter_by('continent','australia')" checked="true"><label for="continent-australia" class="checkbox-custom-label">Australia/Oceania</label></div>
                    <div class="filter-option"><input id="continent-antarctica" class="checkbox-custom" name="continent-antarctica" type="checkbox" onclick="filter_by('continent','antarctica')" checked="true"><label for="continent-antarctica" class="checkbox-custom-label">Antarctica</label></div>
                    <div class="filter-option-division"></div>
                    <div class="filter-option"><input id="continent-all" class="checkbox-custom" name="continent-all" type="checkbox" onclick="filter_by('continent','all')" checked="true"><label for="continent-all" class="checkbox-custom-label">All</label></div>
                </div>
            </div>
        </div>
        <div class="list-columns"><div class="col-language">
            <div class="list-column" id="column-language-id">ID</div>
            <div class="list-column" id="column-language-people-group">People Group</div>
            <div class="list-column" id="column-language-region">Region</div>
            <div class="list-column" id="column-language-continent">Continent</div>
        </div></div>
        <div class="list" id="list-language">Not Available</div>
        
    </div>
    
    <div id="tab-user" class="landing-content">
        
        <h1>Users</h1>
        <div class="control-bar">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="landing-text" id="search-user" onkeyup="search_user()" placeholder="Search by name or email">
            <a href="#add-wycliffe-admin"><button type="button" class="button-add"><i class="fa fa-plus" aria-hidden="true"></i> Add Wycliffe Admin</button></a>
            <div class="filters">
            Filter by <button type="button" class="admin-filter" id="filter-role">Role<span class="filter-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span></button>
                <div class="filter-dropdown" id="dropdown-role">
                    <div class="filter-option"><input id="role-user" class="checkbox-custom" name="role-user" type="checkbox" onclick="filter_by('role','user')" checked="true"><label for="role-user" class="checkbox-custom-label">User</label></div>
                    <div class="filter-option"><input id="role-church-admin" class="checkbox-custom" name="role-church-admin" type="checkbox" onclick="filter_by('role','church_admin')" checked="true"><label for="role-church-admin" class="checkbox-custom-label">Church Admin</label></div>
                    <div class="filter-option"><input id="role-wycliffe-admin" class="checkbox-custom" name="role-wycliffe-admin" type="checkbox" onclick="filter_by('role','wycliffe_admin')" checked="true"><label for="role-wycliffe-admin" class="checkbox-custom-label">Wycliffe Admin</label></div>
                    <div class="filter-option-division"></div>
                    <div class="filter-option"><input id="role-all" class="checkbox-custom" name="role-all" type="checkbox" onclick="filter_by('role','all')" checked="true"><label for="role-all" class="checkbox-custom-label">All</label></div>
                </div>
            </div>
        </div>
        <div class="list-columns"><div class="col-user">
            <div class="list-column" id="column-user-name">Name</div>
            <div class="list-column" id="column-user-email">Email Address</div>
            <div class="list-column" id="column-user-role">Role</div>
        </div></div>
        <div class="list" id="list-user">Not Available</div>
        
        
    </div>
    
    <div id="tab-transaction" class="landing-content">
        <h1>Transactions</h1>
        <div class="control-bar">
            <span class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="landing-text" id="search-transaction" onkeyup="search_transaction()" placeholder="Search by transaction ID, campaign ID or user name">
            <div class="filters">
            Filter by <button type="button" class="admin-filter" id="filter-transaction">Status<span class="filter-icon"><i class="fa fa-caret-down" aria-hidden="true"></i></span></button>
                <div class="filter-dropdown" id="dropdown-transaction">
                    <div class="filter-option"><input id="transaction-pending" class="checkbox-custom" name="transaction-pending" type="checkbox" onclick="filter_by('transaction','pending')" checked="true"><label for="transaction-pending" class="checkbox-custom-label">Pending</label></div>
                    <div class="filter-option"><input id="transaction-completed" class="checkbox-custom" name="transaction-completed" type="checkbox" onclick="filter_by('transaction','completed')" checked="true"><label for="transaction-completed" class="checkbox-custom-label">Completed</label></div>
                    <div class="filter-option"><input id="transaction-canceled" class="checkbox-custom" name="transaction-canceled" type="checkbox" onclick="filter_by('transaction','canceled')" checked="true"><label for="transaction-canceled" class="checkbox-custom-label">Canceled</label></div>
                    <div class="filter-option-division"></div>
                    <div class="filter-option"><input id="transaction-all" class="checkbox-custom" name="transaction-all" type="checkbox" onclick="filter_by('transaction','all')" checked="true"><label for="transaction-all" class="checkbox-custom-label">All</label></div>
                </div>
            </div>
        </div>
        <div class="list-columns"><div class="col-transaction">
            <div class="list-column" id="column-transaction-tid">Transaction ID</div>
            <div class="list-column" id="column-transaction-cid">Campaign ID</div>
            <div class="list-column" id="column-transaction-name">User Name</div>
            <div class="list-column" id="column-transaction-verses">Verses</div>
            <div class="list-column" id="column-transaction-amount">Amount</div>
            <div class="list-column" id="column-transaction-date">Date</div>
            <div class="list-column" id="column-transaction-buttons"></div>
        </div></div>
        <div class="list" id="list-transaction">Not Available</div>
    </div>
      
    
    
    
</div> <!-- wrapper -->
    
<div id="footer">©2017 Wycliffe Bible Translators. All rights reserved.</div>
    
    
</div> <!-- main -->
    
</div>
    
    
    
    
<div class="remodal" data-remodal-id="add-church" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">Add Church</div>
        <section>
            <div class="col-left">Church</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="admin-text-long" id="add-church" onkeyup="search_add_church()" placeholder="Search for church">
                
                <div class="drop" id="drop-add-church"></div>
                
            </div>
        </section>
        <section>
            <div class="col-left">Profile Picture</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <form method="post" enctype="multipart/form-data">
                
                <button type="button" class="outline-button" id="select-profile-picture">Choose Image</button>
                <div class="error" id="error-profile-picture"></div>
                
                <input type="file" id="input-profile-picture" hidden onchange="select_profile_picture(this)">
                </form>
                
            </div>
            <div class="col-left">Preview</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <div id="preview-profile-picture"></div>
                <img alt="preview" src="" id="preview" hidden>

            </div>
        </section>
        <section class="last-section">
            <button type="button" class="admin-submit" onclick="add_church()">Add Church</button>
        </section>
    </div>
</div>

    
<div class="remodal" data-remodal-id="add-language" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">Add Language</div>
        <section>
            <div class="col-left">Language</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="admin-text-long" id="add-language" onkeyup="search_add_language()" placeholder="Search for language">
                
                <div class="drop" id="drop-add-language"></div>
                
            </div>
        </section>
        <section id="language-info">
            <div class="col-left">ID</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="add-id"> </p>
                
            </div>
            <div class="col-left">Region</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="add-region"> </p>
                
            </div>
            <div class="col-left">Continent</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="add-continent"> </p>
                
            </div>
            <div class="col-left">Number of Speakers</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="add-number-speakers"> </p>
                
            </div>
            <div class="col-left">Scripture Published</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="add-publish-date"> </p>
                
            </div>
        </section>
        <section>
            <div class="col-left">Project Description</div>
            <div class="col-tip"></div>
            <div class="col-right" id="project-description">
                
                <div id="add-project-description" class="text-editor">

                </div>
                
            </div>
            <div class="col-left">PDF URL</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="admin-text-long" id="add-pdf-url" placeholder="http://">
                
            </div>
        </section>
        <section class="last-section">
            <button type="button" class="admin-submit" onclick="add_language()">Add Language</button>
        </section>
    </div>
</div>

    
<div class="remodal" data-remodal-id="add-wycliffe-admin" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">Add Wycliffe Admin</div>
        <section>
            <div class="col-left">Account</div>
            <div class="col-tip"></div>
            <div class="col-right">
                <input type="text" class="admin-text" id="admin-first-name" placeholder="First Name" onkeyup="input_admin_form('first-name')">
                <input type="text" class="admin-text" id="admin-last-name" placeholder="Last Name" onkeyup="input_admin_form('last-name')">
            </div>
            <div class="col-left"></div>
            <div class="col-tip"></div>
            <div class="col-right">
                <input type="text" class="admin-text" id="admin-email" placeholder="Email Address"><span class="error" id="error-email"></span><br>
            </div>
            <div class="col-left"></div>
            <div class="col-tip"></div>
            <div class="col-right">
                <input type="text" class="admin-text" id="admin-phone" placeholder="Phone Number" onkeyup="input_admin_form('phone')">
            </div>
        </section>
        <section class="last-section">
            <p class="message">An email will be sent to the new admin to set up their account password.</p>
            <button type="button" class="admin-submit" onclick="add_admin()">Create Admin</button>
        </section>
    </div>
</div>


<div class="remodal" data-remodal-id="campaign-info" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">Campaign Details</div>
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
                <input type="date" class="admin-text" id="details-start-date" onchange="edit_start_date(this)">&nbsp; to &nbsp;<input type="date" class="admin-text" id="details-end-date" onchange="edit_end_date(this)">
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
        <section class="last-section" id="details-buttons">
            
        </section>
    </div>
</div>
    
    
<div class="remodal" data-remodal-id="language-info" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">Language Details</div>
        <section>
            <div class="col-left">Language</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                 <p id="language-people-group"> </p>
                
            </div>
        </section>
        <section>
            <div class="col-left">ID</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="language-id"> </p>
                
            </div>
            <div class="col-left">Region</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="language-region"> </p>
                
            </div>
            <div class="col-left">Continent</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="language-continent"> </p>
                
            </div>
            <div class="col-left">Number of Speakers</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="language-number-speakers"> </p>
                
            </div>
            <div class="col-left">Scripture Published</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="language-publish-date"> </p>
                
            </div>
        </section>
        <section>
            <div class="col-left">Project Description</div>
            <div class="col-tip"></div>
            <div class="col-right" id="language-description">
                
                <div id="language-project-description" class="text-editor">

                </div>
                
            </div>
            <div class="col-left">PDF URL</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="admin-text-long" id="language-pdf-url" placeholder="http://">
                
            </div>
        </section>
        <section class="last-section">
            <button type="button" class="admin-submit" onclick="edit_language()">Save Changes</button>
        </section>
    </div>
</div>

    
<div class="remodal" data-remodal-id="user-info" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>

    <div class="lightbox">
        <div id="title">User Details</div>
        <section>
            <div class="col-left">Contact</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="admin-text" id="user-first-name" onkeyup="input_form('first-name')" placeholder="First Name">
                <input type="text" class="admin-text" id="user-last-name" onkeyup="input_form('last-name')" placeholder="Last Name"><br>
                <input type="text" class="admin-text" id="user-phone" onkeyup="input_form('phone')" placeholder="Phone">
                
            </div>
        </section>
        <section>
            <div class="col-left">Account</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <input type="text" class="admin-text" id="user-email" onkeyup="input_form('email')" placeholder="Email">
                <span class="error" id="error-email"></span>
                <br>
                <button type="button" class="outline-button" id="reset-password">Reset Password</button>
                
            </div>
        </section>
        <section>
            <div class="col-left">Role</div>
            <div class="col-tip"></div>
            <div class="col-right">
                
                <p id="user-role"></p>
                <p id="register-date"></p>
                
            </div>
        </section>
        <section class="last-section">
            <button type="button" class="admin-submit" onclick="edit_user()">Save Changes</button>
        </section>
    </div>
</div>
 
    
    

    

<script>
    
    
$( "#filter-status" ).focusin(function() {
    $( "#dropdown-status" ).focus();
    $( "#dropdown-status" ).css({display: 'block'});
    $( "#filter-status" ).css({background: '#f2f2f2'});
});
$( "#filter-continent" ).focusin(function() {
    $( "#dropdown-continent" ).focus();
    $( "#dropdown-continent" ).css({display: 'block'});
    $( "#filter-continent" ).css({background: '#f2f2f2'});
});
$( "#filter-role" ).focusin(function() {
    $( "#dropdown-role" ).focus();
    $( "#dropdown-role" ).css({display: 'block'});
    $( "#filter-role" ).css({background: '#f2f2f2'});
}); 
$( "#filter-transaction" ).focusin(function() {
    $( "#dropdown-transaction" ).focus();
    $( "#dropdown-transaction" ).css({display: 'block'});
    $( "#filter-transaction" ).css({background: '#f2f2f2'});
}); 
    
    
$(document).mouseup(function(e) {
    var campaign_dropdown = $("#dropdown-status");
    var campaign_filter = $("#filter-status");
    if (!campaign_dropdown.is(e.target) && campaign_dropdown.has(e.target).length === 0) {
        if (!campaign_filter.is(e.target) && campaign_filter.has(e.target).length === 0) {
            $( "#dropdown-status" ).css({display: 'none'});
            $( "#filter-status" ).css({background: 'none'});
        } 
    }
    
    var language_dropdown = $("#dropdown-continent");
    var language_filter = $("#filter-continent");
    if (!language_dropdown.is(e.target) && language_dropdown.has(e.target).length === 0) {
        if (!language_filter.is(e.target) && language_filter.has(e.target).length === 0) {
            $( "#dropdown-continent" ).css({display: 'none'});
            $( "#filter-continent" ).css({background: 'none'});
        } 
    }
    
    var user_dropdown = $("#dropdown-role");
    var user_filter = $("#filter-role");
    if (!user_dropdown.is(e.target) && user_dropdown.has(e.target).length === 0) {
        if (!user_filter.is(e.target) && user_filter.has(e.target).length === 0) {
            $( "#dropdown-role" ).css({display: 'none'});
            $( "#filter-role" ).css({background: 'none'});
        } 
    }
    
    var transaction_dropdown = $("#dropdown-transaction");
    var transaction_filter = $("#filter-transaction");
    if (!transaction_dropdown.is(e.target) && transaction_dropdown.has(e.target).length === 0) {
        if (!transaction_filter.is(e.target) && transaction_filter.has(e.target).length === 0) {
            $( "#dropdown-transaction" ).css({display: 'none'});
            $( "#filter-transaction" ).css({background: 'none'});
        } 
    }
});
    
function filter_by(filter,option) {
    console.log(filter+": "+option);
    
    if (filter == "status") {
        if (option == "all") {
            var bool = false;
            document.getElementById('dropdown-status').innerHTML = '<div class="filter-option"><input id="status-inprogress" class="checkbox-custom" name="status-inprogress" type="checkbox" onclick="filter_by(\'status\',\'inprogress\')"><label for="status-inprogress" class="checkbox-custom-label">In Progress</label></div><div class="filter-option"><input id="status-scheduled" class="checkbox-custom" name="status-scheduled" type="checkbox" onclick="filter_by(\'status\',\'coming\')"><label for="status-scheduled" class="checkbox-custom-label">Scheduled</label></div><div class="filter-option"><input id="status-pending" class="checkbox-custom" name="status-pending" type="checkbox" onclick="filter_by(\'status\',\'pending\')"><label for="status-pending" class="checkbox-custom-label">Pending</label></div><div class="filter-option"><input id="status-complete" class="checkbox-custom" name="status-complete" type="checkbox" onclick="filter_by(\'status\',\'complete\')"><label for="status-complete" class="checkbox-custom-label">Complete</label></div><div class="filter-option-division"></div><div class="filter-option"><input id="status-all" class="checkbox-custom" name="status-all" type="checkbox" onclick="filter_by(\'status\',\'all\')"><label for="status-all" class="checkbox-custom-label">All</label>';
            
            if (!campaign_status.all) {
                bool = true;
                document.getElementById('status-inprogress').setAttribute('checked', 'true');
                document.getElementById('status-scheduled').setAttribute('checked', 'true');
                document.getElementById('status-pending').setAttribute('checked', 'true');
                document.getElementById('status-complete').setAttribute('checked', 'true');
                document.getElementById('status-all').setAttribute('checked', 'true');
                
            }
            
            for (var i = 0; i < Object.keys(campaign_status).length; i++) {
                campaign_status[Object.keys(campaign_status)[i]] = bool;
            }
            
        } else {
            campaign_status[option] = !campaign_status[option];
            
            var all = true;
            
            for (var i = 0; i < Object.keys(campaign_status).length; i++) {
                if (Object.keys(campaign_status)[i] != 'all' && campaign_status[Object.keys(campaign_status)[i]] == false) {
                    all = false;
                }
            }
            
            if (all) {
                document.getElementById('status-all').setAttribute('checked', 'true');
                campaign_status.all = true;
            } else {
                document.getElementById('status-all').removeAttribute('checked');
                campaign_status.all = false;
            }
            
        }
        
        console.log(campaign_status);
        search_campaign();
    } 
    else if (filter == "continent") {
        if (option == "all") {
            var bool = false;
            document.getElementById('dropdown-continent').innerHTML = '<div class="filter-option"><input id="continent-asia" class="checkbox-custom" name="continent-asia" type="checkbox" onclick="filter_by(\'continent\',\'asia\')"><label for="continent-asia" class="checkbox-custom-label">Asia</label></div><div class="filter-option"><input id="continent-africa" class="checkbox-custom" name="continent-africa" type="checkbox" onclick="filter_by(\'continent\',\'africa\')"><label for="continent-africa" class="checkbox-custom-label">Africa</label></div><div class="filter-option"><input id="continent-europe" class="checkbox-custom" name="continent-europe" type="checkbox" onclick="filter_by(\'continent\',\'europe\')"><label for="continent-europe" class="checkbox-custom-label">Europe</label></div><div class="filter-option"><input id="continent-north-america" class="checkbox-custom" name="continent-north-america" type="checkbox" onclick="filter_by(\'continent\',\'north_america\')"><label for="continent-north-america" class="checkbox-custom-label">North America</label></div><div class="filter-option"><input id="continent-south-america" class="checkbox-custom" name="continent-south-america" type="checkbox" onclick="filter_by(\'continent\',\'south_america\')"k><label for="continent-south-america" class="checkbox-custom-label">South America</label></div><div class="filter-option"><input id="continent-australia" class="checkbox-custom" name="continent-australia" type="checkbox" onclick="filter_by(\'continent\',\'australia\')"><label for="continent-australia" class="checkbox-custom-label">Australia/Oceania</label></div><div class="filter-option"><input id="continent-antarctica" class="checkbox-custom" name="continent-antarctica" type="checkbox" onclick="filter_by(\'continent\',\'antarctica\')"><label for="continent-antarctica" class="checkbox-custom-label">Antarctica</label></div><div class="filter-option-division"></div><div class="filter-option"><input id="continent-all" class="checkbox-custom" name="continent-all" type="checkbox" onclick="filter_by(\'continent\',\'all\')"><label for="continent-all" class="checkbox-custom-label">All</label></div>';
            
            if (!language_continent.all) {
                bool = true;
                
                document.getElementById('continent-asia').setAttribute('checked', 'true');
                document.getElementById('continent-africa').setAttribute('checked', 'true');
                document.getElementById('continent-europe').setAttribute('checked', 'true');
                document.getElementById('continent-north-america').setAttribute('checked', 'true');
                document.getElementById('continent-south-america').setAttribute('checked', 'true');
                document.getElementById('continent-australia').setAttribute('checked', 'true');
                document.getElementById('continent-antarctica').setAttribute('checked', 'true');
                document.getElementById('continent-all').setAttribute('checked', 'true');
                
            }
            
            for (var i = 0; i < Object.keys(language_continent).length; i++) {
                language_continent[Object.keys(language_continent)[i]] = bool;
            }
            
        } else {
            language_continent[option] = !language_continent[option];
            
            var all = true;
            
            for (var i = 0; i < Object.keys(language_continent).length; i++) {
                if (Object.keys(language_continent)[i] != 'all' && language_continent[Object.keys(language_continent)[i]] == false) {
                    all = false;
                }
            }
            
            if (all) {
                document.getElementById('continent-all').setAttribute('checked', 'true');
                language_continent.all = true;
            } else {
                document.getElementById('continent-all').removeAttribute('checked');
                language_continent.all = false;
            }
            
        }
        
        console.log(language_continent);
        search_language();
    }
    else if (filter == "role") {
        if (option == "all") {
            var bool = false;
            document.getElementById('dropdown-role').innerHTML = '<div class="filter-option"><input id="role-user" class="checkbox-custom" name="role-user" type="checkbox" onclick="filter_by(\'role\',\'user\')"><label for="role-user" class="checkbox-custom-label">User</label></div><div class="filter-option"><input id="role-church-admin" class="checkbox-custom" name="role-church-admin" type="checkbox" onclick="filter_by(\'role\',\'church_admin\')"><label for="role-church-admin" class="checkbox-custom-label">Church Admin</label></div><div class="filter-option"><input id="role-wycliffe-admin" class="checkbox-custom" name="role-wycliffe-admin" type="checkbox" onclick="filter_by(\'role\',\'wycliffe_admin\')"><label for="role-wycliffe-admin" class="checkbox-custom-label">Wycliffe Admin</label></div><div class="filter-option-division"></div><div class="filter-option"><input id="role-all" class="checkbox-custom" name="role-all" type="checkbox" onclick="filter_by(\'role\',\'all\')"><label for="role-all" class="checkbox-custom-label">All</label></div>';
            
            if (!user_role.all) {
                bool = true;
                
                document.getElementById('role-user').setAttribute('checked', 'true');
                document.getElementById('role-church-admin').setAttribute('checked', 'true');
                document.getElementById('role-wycliffe-admin').setAttribute('checked', 'true');
                document.getElementById('role-all').setAttribute('checked', 'true');
                
            }
            
            for (var i = 0; i < Object.keys(user_role).length; i++) {
                user_role[Object.keys(user_role)[i]] = bool;
            }
            
        } else {
            user_role[option] = !user_role[option];
            
            var all = true;
            
            for (var i = 0; i < Object.keys(user_role).length; i++) {
                if (Object.keys(user_role)[i] != 'all' && user_role[Object.keys(user_role)[i]] == false) {
                    all = false;
                }
            }
            
            if (all) {
                document.getElementById('role-all').setAttribute('checked', 'true');
                user_role.all = true;
            } else {
                document.getElementById('role-all').removeAttribute('checked');
                user_role.all = false;
            }
            
        }
        
        console.log(user_role);
        search_user();
    }
    else if (filter == "transaction") {
        if (option == "all") {
            var bool = false;
            document.getElementById('dropdown-transaction').innerHTML = '<div class="filter-option"><input id="transaction-pending" class="checkbox-custom" name="transaction-pending" type="checkbox" onclick="filter_by(\'transaction\',\'pending\')"><label for="transaction-pending" class="checkbox-custom-label">Pending</label></div><div class="filter-option"><input id="transaction-completed" class="checkbox-custom" name="transaction-completed" type="checkbox" onclick="filter_by(\'transaction\',\'completed\')"><label for="transaction-completed" class="checkbox-custom-label">Completed</label></div><div class="filter-option"><input id="transaction-canceled" class="checkbox-custom" name="transaction-canceled" type="checkbox" onclick="filter_by(\'transaction\',\'canceled\')"><label for="transaction-canceled" class="checkbox-custom-label">Canceled</label></div><div class="filter-option-division"></div><div class="filter-option"><input id="transaction-all" class="checkbox-custom" name="transaction-all" type="checkbox" onclick="filter_by(\'transaction\',\'all\')"><label for="transaction-all" class="checkbox-custom-label">All</label></div>';
            
            if (!transaction_status.all) {
                bool = true;
                
                document.getElementById('transaction-pending').setAttribute('checked', 'true');
                document.getElementById('transaction-canceled').setAttribute('checked', 'true');
                document.getElementById('transaction-completed').setAttribute('checked', 'true');
                document.getElementById('transaction-all').setAttribute('checked', 'true');
                
            }
            
            for (var i = 0; i < Object.keys(transaction_status).length; i++) {
                transaction_status[Object.keys(transaction_status)[i]] = bool;
            }
            
        } else {
            transaction_status[option] = !transaction_status[option];
            
            var all = true;
            
            for (var i = 0; i < Object.keys(transaction_status).length; i++) {
                if (Object.keys(transaction_status)[i] != 'all' && transaction_status[Object.keys(transaction_status)[i]] == false) {
                    all = false;
                }
            }
            
            if (all) {
                document.getElementById('transaction-all').setAttribute('checked', 'true');
                transaction_status.all = true;
            } else {
                document.getElementById('transaction-all').removeAttribute('checked');
                transaction_status.all = false;
            }
            
        }
        
        console.log(transaction_status);
        search_transaction();
    }
    
}
        
    
    
    
var campaign_id = "";
var campaigns = {};
var campaign_status = {
    inprogress: true,
    coming: true,
    pending: true,
    complete: true,
    all: true
};
    
search_campaign();
    
function search_campaign() {
    
    var word = document.getElementById('search-campaign');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-campaign').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-campaign').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var id = resp[num]['id'];
                    var book = resp[num]['book'];
                    var language = resp[num]['language'];
                    var goal_description = resp[num]['goal_description'];
                    var goal_amount = resp[num]['goal_amount'];
                    var verse_price = resp[num]['verse_price'];
                    var start_date = resp[num]['start_date'];
                    var end_date = resp[num]['end_date'];
                    var url = resp[num]['url'];
                    var status = resp[num]['status'];
                    var church = resp[num]['church'];
                    var church_id = resp[num]['church_id'];
                    var raised = resp[num]['raised'];
                    var percentage = resp[num]['percentage'];
                    
                    campaigns[id] = {};
                    campaigns[id]['book'] = book;
                    campaigns[id]['language'] = language;
                    campaigns[id]['goal_description'] = goal_description;
                    campaigns[id]['goal_amount'] = goal_amount;
                    campaigns[id]['verse_price'] = verse_price;
                    campaigns[id]['start_date'] = start_date;
                    campaigns[id]['end_date'] = end_date;
                    campaigns[id]['url'] = url;
                    campaigns[id]['status'] = status;
                    campaigns[id]['church'] = church;
                    campaigns[id]['church_id'] = church_id;
                    campaigns[id]['raised'] = raised;
                    campaigns[id]['percentage'] = percentage;
                }
                
                
                // PRINT IN PROGRESS
                if (campaign_status.inprogress) {
                for (var i = 0; i < Object.keys(campaigns).length; i++) {
                    var num = Object.keys(campaigns)[i];
                    
                    if (campaigns[num]['status'] == "inprogress") {
                        
                        var start_now = new Date(campaigns[num]['start_date']);
                        var start_year = (""+start_now.getFullYear()).slice(-2);
                        var start_month = start_now.getMonth() + 1;
                        var start_date = start_month+"/"+start_now.getDate()+"/"+start_year;

                        var end_now = new Date(campaigns[num]['end_date']);
                        var end_year = (""+end_now.getFullYear()).slice(-2);
                        var end_month = end_now.getMonth() + 1;
                        var end_date = end_month+"/"+end_now.getDate()+"/"+end_year;

                        var duration = start_date+" - "+end_date;
                        
                        document.getElementById('list-campaign').innerHTML += '<div class="list-item col-campaign" onclick="select_campaign(\''+num+'\')"><div class="col-campaign-status"><div class="status-inprogress"></div></div><div class="col-campaign-church">'+campaigns[num]['church']+'</div><div class="col-campaign-book">'+campaigns[num]['book']+'</div><div class="col-campaign-language">'+campaigns[num]['language']+'</div><div class="col-campaign-url">/'+campaigns[num]['url']+'</div><div class="col-campaign-duration">'+duration+'</div><div class="col-campaign-percentage">'+campaigns[num]['percentage']+'%</div></div>';
                        
                    }
                    
                }
                }
                
                // PRINT SCHEDULED
                if (campaign_status.coming) {
                for (var i = 0; i < Object.keys(campaigns).length; i++) {
                    var num = Object.keys(campaigns)[i];
                    
                    if (campaigns[num]['status'] == "coming") {
                        
                        var start_now = new Date(campaigns[num]['start_date']);
                        var start_year = (""+start_now.getFullYear()).slice(-2);
                        var start_month = start_now.getMonth() + 1;
                        var start_date = start_month+"/"+start_now.getDate()+"/"+start_year;

                        var end_now = new Date(campaigns[num]['end_date']);
                        var end_year = (""+end_now.getFullYear()).slice(-2);
                        var end_month = end_now.getMonth() + 1;
                        var end_date = end_month+"/"+end_now.getDate()+"/"+end_year;

                        var duration = start_date+" - "+end_date;
                        
                        document.getElementById('list-campaign').innerHTML += '<div class="list-item col-campaign" onclick="select_campaign(\''+num+'\')"><div class="col-campaign-status"><div class="status-coming"></div></div><div class="col-campaign-church">'+campaigns[num]['church']+'</div><div class="col-campaign-book">'+campaigns[num]['book']+'</div><div class="col-campaign-language">'+campaigns[num]['language']+'</div><div class="col-campaign-url">/'+campaigns[num]['url']+'</div><div class="col-campaign-duration">'+duration+'</div><div class="col-campaign-percentage">'+campaigns[num]['percentage']+'%</div></div>';
                        
                    }
                    
                }
                }
                
                // PRINT PENDING
                if (campaign_status.pending) {
                for (var i = 0; i < Object.keys(campaigns).length; i++) {
                    var num = Object.keys(campaigns)[i];
                    
                    if (campaigns[num]['status'] == "pending") {
                        
                        var start_now = new Date(campaigns[num]['start_date']);
                        var start_year = (""+start_now.getFullYear()).slice(-2);
                        var start_month = start_now.getMonth() + 1;
                        var start_date = start_month+"/"+start_now.getDate()+"/"+start_year;

                        var end_now = new Date(campaigns[num]['end_date']);
                        var end_year = (""+end_now.getFullYear()).slice(-2);
                        var end_month = end_now.getMonth() + 1;
                        var end_date = end_month+"/"+end_now.getDate()+"/"+end_year;

                        var duration = start_date+" - "+end_date;
                        
                        document.getElementById('list-campaign').innerHTML += '<div class="list-item col-campaign" onclick="select_campaign(\''+num+'\')"><div class="col-campaign-status"><div class="status-pending"></div></div><div class="col-campaign-church">'+campaigns[num]['church']+'</div><div class="col-campaign-book">'+campaigns[num]['book']+'</div><div class="col-campaign-language">'+campaigns[num]['language']+'</div><div class="col-campaign-url">/'+campaigns[num]['url']+'</div><div class="col-campaign-duration">'+duration+'</div><div class="col-campaign-percentage">'+campaigns[num]['percentage']+'%</div></div>';
                        
                    }
                    
                }
                }
                
                // PRINT COMPLETE
                if (campaign_status.complete) {
                for (var i = 0; i < Object.keys(campaigns).length; i++) {
                    var num = Object.keys(campaigns)[i];
                    
                    if (campaigns[num]['status'] == "complete") {
                        
                        var start_now = new Date(campaigns[num]['start_date']);
                        var start_year = (""+start_now.getFullYear()).slice(-2);
                        var start_month = start_now.getMonth() + 1;
                        var start_date = start_month+"/"+start_now.getDate()+"/"+start_year;

                        var end_now = new Date(campaigns[num]['end_date']);
                        var end_year = (""+end_now.getFullYear()).slice(-2);
                        var end_month = end_now.getMonth() + 1;
                        var end_date = end_month+"/"+end_now.getDate()+"/"+end_year;

                        var duration = start_date+" - "+end_date;
                        
                        document.getElementById('list-campaign').innerHTML += '<div class="list-item col-campaign" onclick="select_campaign(\''+num+'\')"><div class="col-campaign-status"><div class="status-complete"></div></div><div class="col-campaign-church">'+campaigns[num]['church']+'</div><div class="col-campaign-book">'+campaigns[num]['book']+'</div><div class="col-campaign-language">'+campaigns[num]['language']+'</div><div class="col-campaign-url">/'+campaigns[num]['url']+'</div><div class="col-campaign-duration">'+duration+'</div><div class="col-campaign-percentage">'+campaigns[num]['percentage']+'%</div></div>';
                        
                    }
                    
                }
                }
                
            }
            
        }}}
        ajaxObj.open("GET", "sql-campaigns.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
function select_campaign(id) {
    
    if (id == "") {

    } else {
        campaign_id = id;
        window.location.href = "admin.php#campaign-info";
    }
    
}

    
    
search_church();
    
function search_church() {
    
    var word = document.getElementById('search-church');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-church').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-church').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var id = resp[num]['id'];
                    var state = resp[num]['state'];
                    var church = resp[num]['name'];
                    var contact = resp[num]['contact'];
                    var profile_picture = resp[num]['profile_picture'];
                    var num_campaign = resp[num]['num_campaign'];
                    
                    var image = "";
                    
                    if (profile_picture != null) {
                        image = '../img/profile/'+profile_picture;
                    } else {
                        image = '../img/choose_image.png';
                    }
                    
                    var number_of_campaigns = num_campaign.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    document.getElementById('list-church').innerHTML += '<div class="list-item col-church" onclick="select_church(\''+id+'\')"><div class="col-church-profile-picture"><div class="church-profile-picture" style="background-image: url(\''+image+'\')"></div></div><div class="col-church-name">'+church+'</div><div class="col-church-state">'+state+'</div><div class="col-church-contact">'+contact+'</div><div class="col-church-campaign">'+number_of_campaigns+'</div></div>';
                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-churches.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
function select_church(id) {
    
    if (id == "") {

    } else {
        window.location.href = "church.php?id="+id;
    }
    
}
    
    
    
var language_id = "";
var languages = {};
var language_continent = {
    asia: true,
    africa: true,
    europe: true,
    north_america: true,
    south_america: true,
    australia: true,
    antarctica: true,
    all: true
};
    
search_language();
    
function search_language() {
    
    var word = document.getElementById('search-language');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-language').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-language').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var id = resp[num]['id'];
                    var people_group = resp[num]['people_group'];
                    var region = resp[num]['region'];
                    var continent = resp[num]['continent'];
                    var num_speakers = resp[num]['number_of_speakers'];
                    var publish_date = resp[num]['publish_date'];
                    var project_description = resp[num]['project_description'];
                    var pdf_url = resp[num]['pdf_url'];
                    
                    var cont = continent;
                    
                    switch(cont) {
                        case "Asia":
                            cont = "asia";
                            break;
                        case "Africa":
                            cont = "africa";
                            break;
                        case "Europe":
                            cont = "europe";
                            break;
                        case "North America":
                            cont = "north_america";
                            break;
                        case "South America":
                            cont = "south_america";
                            break;
                        case "Australia/Oceania":
                            cont = "australia";
                            break;
                        case "Antarctica":
                            cont = "antarctica";
                            break;
                        default:
                            break;
                    }
                    
                    languages[id] = {};
                    languages[id]['people_group'] = people_group;
                    languages[id]['region'] = region;
                    languages[id]['continent'] = continent;
                    languages[id]['num_speakers'] = num_speakers;
                    languages[id]['publish_date'] = publish_date;
                    languages[id]['project_description'] = project_description;
                    languages[id]['pdf_url'] = pdf_url;
                    
                    if (language_continent[cont]) {

                        document.getElementById('list-language').innerHTML += '<div class="list-item col-language" onclick="select_language(\''+id+'\')"><div class="col-language-id">'+id+'</div><div class="col-language-name">'+people_group+'</div><div class="col-language-region">'+region+'</div><div class="col-language-continent">'+continent+'</div></div>';
                        
                    }
                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-languages.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
function select_language(id) {
    
    if (id == "") {
        
    } else {
        language_id = id;
        window.location.href = "admin.php#language-info";
    }
    
}
    
    
    
var user_id = "";
var users = {};
var user_role = {
    user: true,
    church_admin: true,
    wycliffe_admin: true,
    all: true
};
    
search_user();
    
function search_user() {
    
    var word = document.getElementById('search-user');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-user').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-user').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var id = resp[num]['id'];
                    var first_name = resp[num]['first_name'];
                    var last_name = resp[num]['last_name'];
                    var phone = resp[num]['phone'];
                    var email = resp[num]['email'];
                    var role = resp[num]['role'];
                    var register_date = resp[num]['register_date'];
                    
                    users[id] = {};
                    users[id]['first_name'] = first_name;
                    users[id]['last_name'] = last_name;
                    users[id]['email'] = email;
                    users[id]['phone'] = phone;
                    users[id]['role'] = role;
                    users[id]['register_date'] = register_date;
                    
                    var admin = "";
                    
                    if (role == "campaign_admin" && user_role.church_admin) {
                        admin = "<img alt='' src='../img/church_admin.svg'>";
                        document.getElementById('list-user').innerHTML += '<div class="list-item col-user" onclick="select_user(\''+id+'\')"><div class="col-user-name">'+first_name+' '+last_name+'</div><div class="col-user-email">'+email+'</div><div class="col-user-role">'+admin+'</div></div>';
                    } else if (role == "wycliffe_admin" && user_role.wycliffe_admin) {
                        admin = "<img alt='' src='../img/wycliffe_admin.svg'>";
                        document.getElementById('list-user').innerHTML += '<div class="list-item col-user" onclick="select_user(\''+id+'\')"><div class="col-user-name">'+first_name+' '+last_name+'</div><div class="col-user-email">'+email+'</div><div class="col-user-role">'+admin+'</div></div>';
                    } else if (role == "user" && user_role.user) {
                        admin = "<img alt='' src='../img/not_admin.png'>";
                        document.getElementById('list-user').innerHTML += '<div class="list-item col-user" onclick="select_user(\''+id+'\')"><div class="col-user-name">'+first_name+' '+last_name+'</div><div class="col-user-email">'+email+'</div><div class="col-user-role">'+admin+'</div></div>';
                    }

                    
                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-users.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
function select_user(id) {
    
    if (id == "") {

    } else {
        user_id = id;
        window.location.href = "admin.php#user-info";
    }
    
}


    
var transactions = {};
var transaction_status = {
    pending: true,
    canceled: true,
    completed: true,
    all: true
};
    
search_transaction();
    
function search_transaction() {
    
    var word = document.getElementById('search-transaction');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    
    var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            document.getElementById('list-transaction').innerHTML = "";
            
            if (ajaxObj.responseText == "no\n") {
                document.getElementById('list-transaction').innerHTML += '<div class="list-group">No search result.</div>';
            } else {
                var resp = JSON.parse(ajaxObj.responseText);
                
                console.log(resp);

                for (var i = 0; i < Object.keys(resp).length; i++) {

                    var num = Object.keys(resp)[i];
                    var id = Object.keys(resp[num])[0];
                    var campaign = resp[num][id]['campaign'];
                    var name = resp[num][id]['name'];
                    var verses = resp[num][id]['verses'];
                    var amount = resp[num][id]['amount'];
                    var date = resp[num][id]['date'];
                    var status = resp[num][id]['status'];
                    
                    transactions[id] = {};
                    transactions[id]['campaign'] = campaign;
                    transactions[id]['name'] = name;
                    transactions[id]['verses'] = verses;
                    transactions[id]['amount'] = amount;
                    transactions[id]['date'] = date;
                    transactions[id]['status'] = status;
                    
                    
                    var num_amount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    var num_verses = verses.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    
                    var p_date = new Date(date);
                    var year = (""+p_date.getFullYear()).slice(-2);
                    var month = p_date.getMonth() + 1;
                    var purchase_date = month+"/"+p_date.getDate()+"/"+year;
                    
                    if (status == "pending" && transaction_status.pending) {
                        document.getElementById('list-transaction').innerHTML += '<div class="list-item col-transaction"><div class="col-transaction-tid">'+id+'</div><div class="col-transaction-cid">'+campaign+'</div><div class="col-transaction-name">'+name+'</div><div class="col-transaction-verses">'+num_verses+'</div><div class="col-transaction-amount">&#36;'+num_amount+'</div><div class="col-transaction-date">'+purchase_date+'</div><div class="col-transaction-buttons"><button type="button" onclick="confirm_transaction(\''+id+'\')"><img alt="Confirm" src="../img/error_valid.png"></button><button type="button" onclick="cancel_transaction(\''+id+'\')"><img alt="Cancel" src="../img/error_invalid.png"></button></div></div>';
                    } else if (status == "complete" && transaction_status.completed) {
                        document.getElementById('list-transaction').innerHTML += '<div class="list-item col-transaction"><div class="col-transaction-tid">'+id+'</div><div class="col-transaction-cid">'+campaign+'</div><div class="col-transaction-name">'+name+'</div><div class="col-transaction-verses">'+num_verses+'</div><div class="col-transaction-amount">&#36;'+num_amount+'</div><div class="col-transaction-date">'+purchase_date+'</div><div class="col-transaction-buttons"></div></div>';
                    } else if (status == "denied" && transaction_status.canceled) {
                        document.getElementById('list-transaction').innerHTML += '<div class="list-item col-transaction transaction-denied"><div class="col-transaction-tid">'+id+'</div><div class="col-transaction-cid">'+campaign+'</div><div class="col-transaction-name">'+name+'</div><div class="col-transaction-verses">'+num_verses+'</div><div class="col-transaction-amount">&#36;'+num_amount+'</div><div class="col-transaction-date">'+purchase_date+'</div><div class="col-transaction-buttons"></div></div>';
                    }

                }
            }
            
        }}}
        ajaxObj.open("GET", "sql-transactions.php?keyword="+word.value);
        ajaxObj.send();
        
}
    
    
    
    
    
function logout() {
    if (window.confirm("Would you like to log out?")) {
        window.location.href = "logout.php";
    }
}
    
    
function landing_tab(evt, tabName) {

    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("landing-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("landing-tabs");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" landing-tabs-now", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " landing-tabs-now";
    

}
    
    
    
    
    
    
// ADD CHURCH
    
var church_data = "";
    
function search_add_church() {
    
    var word = document.getElementById('add-church');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    document.getElementById('drop-add-church').style.visibility = "visible";
    
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        document.getElementById('drop-add-church').innerHTML = "";

        if (ajaxObj.responseText == "no\n") {
            document.getElementById('drop-add-church').innerHTML += '<div class="drop-group church-group">No search result.</div>';
        } else {
            var resp = JSON.parse(ajaxObj.responseText);

            for (var i = 0; i < Object.keys(resp).length; i++) {

                var num = Object.keys(resp)[i];
                var id = resp[num]['id'];
                var state = resp[num]['state'];
                var name = resp[num]['name'];
                var contact = resp[num]['contact'];
                var status = resp[num]['status'];

                if (status == "added") {
                    document.getElementById('drop-add-church').innerHTML += '<div class="drop-item church-item added">'+name+'<span class="church-tag">'+state+'</span></div>';
                } else {
                    var pass_name = name.replace(/'/g, "\\'");
                    document.getElementById('drop-add-church').innerHTML += '<div class="drop-item church-item" onclick="select_add_church(\''+id+'\',\''+pass_name+'\')">'+name+'<span class="church-tag">'+state+'</span></div>';
                }

            }
        }

    }}}
    ajaxObj.open("GET", "sql-sf-churches.php?keyword="+word.value);
    ajaxObj.send();
        
}
    
function select_add_church(id,name) {
    church_data = id;
    document.getElementById('add-church').value = name;
    
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

    document.getElementById('drop-add-church').style.visibility = "hidden";
}

$( "#add-church" ).focusout(function() {
    select_add_church("","");
});  
    
$("#select-profile-picture").click(function(){
    $("#input-profile-picture").click();
});
    
var formdata = new FormData();
var form_profile = false;
var profile_type = "";
    
function select_profile_picture(prof) {
    
    document.getElementById('error-profile-picture').style.visibility = "visible";
            
    var file = prof.files[0];
    var imagefile = file.type;
    profile_type = file.type.split("/")[1];
        
    var match = ["image/jpeg","image/png","image/jpg","image/gif"];
    
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]))) {
        form_profile = false;
        imageNotLoaded();
        $('#input-profile-picture').val('');
        document.getElementById('error-profile-picture').className = "error red";
        document.getElementById('error-profile-picture').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Invalid file type (jpg, gif, png)';
    } else {
        if (file.size > 2000000) {
            form_profile = false;
            imageNotLoaded();
            $('#input-profile-picture').val('');
            document.getElementById('error-profile-picture').className = "error red";
            document.getElementById('error-profile-picture').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Invalid file size (Max: 2 MB)';
        } else {
            form_profile = true;
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(file);
            document.getElementById('error-profile-picture').className = "error green";
            document.getElementById('error-profile-picture').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Valid image';
            
            formdata.append("input_profile_picture", file);
        }
    }
    
}
function imageIsLoaded(e) {
    $('img[alt="preview"]').attr('src', e.target.result);
    $('#preview-profile-picture').css({backgroundImage: 'url("'+$('img[alt="preview"]').attr('src')+'")'});
}  
function imageNotLoaded() {
    $('#preview-preview-picture').css({backgroundImage: 'url("../../img/choose_image.png")'});
}

function add_church () {
    
    var valid = true;
    
    document.getElementById('add-church').style.borderColor = "#d1d1d1";
    
    if (church_data == '') {
        document.getElementById('add-church').style.borderColor = "#db5353";
        document.getElementById('add-church').focus();
        valid = false;
    }
    
    if (valid) {
        
        console.log(church_data);
        
        $.ajax({
            url: "sql-add-church.php?id="+church_data,
            type: "POST",
            data:  formdata,
            contentType: false,
            processData:false,
            success: function(data) {
                console.log(data);
                if (data == "yes") {
                    window.location.href = "admin.php#";
                    search_church();
                } else {
                    alert("Error: "+data);
                }
            },
            error: function(data) {
                console.log(data);
                alert("Error: Edit Profile Picture");
            } 	        
        });
        
    }
    
}

    
    
    
    
    
    
// ADD LANGUAGE
    
var add_project_description = "";
var language_add_description = "";
var language_add_data = {
    language: "",
    pdf_url: ""
}
    
function search_add_language() {
    
    var word = document.getElementById('add-language');
    word.value = word.value.replace(/[^a-zA-Z0-9\s]+/, '');
    
    document.getElementById('drop-add-language').style.visibility = "visible";
    
    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

        document.getElementById('drop-add-language').innerHTML = "";

        if (ajaxObj.responseText == "no\n") {
            document.getElementById('drop-add-language').innerHTML += '<div class="drop-group language-group">No search result.</div>';
        } else {
            var resp = JSON.parse(ajaxObj.responseText);

            for (var i = 0; i < Object.keys(resp).length; i++) {

                var num = Object.keys(resp)[i];
                var id = resp[num]['id'];
                var language = resp[num]['people_group'];
                var region = resp[num]['region'];
                var continent = resp[num]['continent'];
                var publish_date = resp[num]['publish_date'];
                var num_speakers = resp[num]['number_of_speakers'];
                var status = resp[num]['status'];

                if (status == "added") {
                    document.getElementById('drop-add-language').innerHTML += '<div class="drop-item language-item added"><span class="language-tag tag-id">'+id+'</span>'+language+'<span class="language-tag">'+region+'</span></div>';
                } else {
                    var pass_language = language.replace(/'/g, "\\'");
                    var pass_region = region.replace(/'/g, "\\'");
                    document.getElementById('drop-add-language').innerHTML += '<div class="drop-item language-item" onclick="select_add_language(\''+id+'\',\''+pass_language+'\',\''+pass_region+'\',\''+continent+'\',\''+num_speakers+'\',\''+publish_date+'\')"><span class="language-tag tag-id">'+id+'</span>'+language+'<span class="language-tag">'+region+'</span></div>';
                }

            }
        }

    }}}
    ajaxObj.open("GET", "sql-sf-languages.php?keyword="+word.value);
    ajaxObj.send();
        
}
    
function select_add_language(id,name,region,continent,speakers,publish) {
    language_add_data['language'] = id;
    document.getElementById('add-language').value = name;
    
    if (id == "") {
        $('#language-info').slideUp();
    } else {
        $('#language-info').slideDown();
        document.getElementById('add-id').innerHTML = id;
        document.getElementById('add-region').innerHTML = region;
        document.getElementById('add-continent').innerHTML = continent;
        var num_speakers = speakers.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById('add-number-speakers').innerHTML = num_speakers;
        var p_date = new Date(publish);
        var p_month = p_date.getMonth() + 1;
        var publish_date = p_month+"/"+p_date.getDate()+"/"+p_date.getFullYear();
        document.getElementById('add-publish-date').innerHTML = publish_date;
    }
    
    
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

    document.getElementById('drop-add-language').style.visibility = "hidden";
}

$( "#add-language" ).focusout(function() {
    select_add_language("","","");
});  

$( "#add-pdf-url" ).focusout(function() {
    input_url();
});
    
function input_url() {
    var word = document.getElementById('add-pdf-url');
    language_add_data.pdf_url = word.value;
}

function add_language () {
    
    console.log(language_add_data);
    
    var edits = document.getElementById('add-project-description').getElementsByClassName("ql-editor");
    for(var i = 0; i < edits.length; i++) {
        language_add_description = edits[i].innerHTML;
        console.log(language_add_description);
    }
    
    var valid = true;
    
    document.getElementById('add-language').style.borderColor = "#d1d1d1";
    document.getElementById('add-pdf-url').style.borderColor = "#d1d1d1";
    $( "#add-project-description.ql-container" ).css( "border-color", "#d1d1d1" );
    
    if (language_add_data.language == '') {
        document.getElementById('add-language').style.borderColor = "#db5353";
        document.getElementById('add-language').focus();
        valid = false;
    } else if (add_project_description.getLength() <= 1) {
        $( "#add-project-description.ql-container" ).css( "border-color", "#db5353" );
        add_project_description.focus();
        valid = false;
    } else if (language_add_data.pdf_url == '') {
        document.getElementById('add-pdf-url').style.borderColor = "#db5353";
        document.getElementById('add-pdf-url').focus();
        valid = false;
    }
    
    
    
    if (valid) {
        
        var params = 'id='+language_add_data.language+'&project_description='+language_add_description+'&pdf_url='+language_add_data.pdf_url;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {
                
                window.location.href = "admin.php#";
                search_language();
            }
            
        }}}
        ajaxObj.open("GET", "sql-add-language.php?"+params);
        ajaxObj.send();
        
        
    }
    
}
    
    
    
    
    
    
// ADD WYCLIFFE ADMIN 
    
var admin_data = {
    first_name: "",
    last_name: "",
    phone: "",
    email: ""
}
    
function search_admin_email() {
    
    var email = document.getElementById('admin-email');
    
    document.getElementById('error-email').style.visibility = "visible";

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        var valid = true;
        admin_data.email = "";
        
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Email is invalid';
            valid = false;
        }
        
        if (ajaxObj.responseText == "yes\n") {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Email already exists';
            valid = false;
        } 
        
        if (valid) {
            admin_data.email = email.value;
            document.getElementById('error-email').className = "error green";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Email is valid';
        }

    }}}
    ajaxObj.open("GET", "sql-check-new-email.php?email="+email.value);
    ajaxObj.send();
}
    
$( "#admin-email" ).focusout(function() {
    search_admin_email();
});

function input_admin_form(title) {
    
    var word = document.getElementById('admin-'+title);
    
    switch(title) {
        case 'first-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            admin_data.first_name = document.getElementById('admin-first-name').value;
            break;
        case 'last-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            admin_data.last_name = document.getElementById('admin-last-name').value;
            break;
        case 'phone':
            word.value = word.value.replace(/[^0-9\)-\.\+\s]+/, '');
            admin_data.phone = document.getElementById('admin-phone').value;
            break;
        default:
            break;
    }
}
    
function add_admin() {
    
    var valid = true;
    
    document.getElementById('admin-first-name').style.borderColor = "#d1d1d1";
    document.getElementById('admin-last-name').style.borderColor = "#d1d1d1";
    document.getElementById('admin-email').style.borderColor = "#d1d1d1";
    document.getElementById('admin-phone').style.borderColor = "#d1d1d1";

    if (admin_data.first_name == "") {
        document.getElementById('admin-first-name').style.borderColor = "#db5353";
        document.getElementById('admin-first-name').focus();
        valid = false;
    } else if (admin_data.last_name == "") {
        document.getElementById('admin-last-name').style.borderColor = "#db5353";
        document.getElementById('admin-last-name').focus();
        valid = false;
    } else if (admin_data.new_email == "") {
        document.getElementById('admin-email').style.borderColor = "#db5353";
        document.getElementById('admin-email').focus();
        valid = false;
    } else if (admin_data.phone == "") {
        document.getElementById('admin-phone').style.borderColor = "#db5353";
        document.getElementById('admin-phone').focus();
        valid = false;
    }

    
    if (valid) {
        
        var params = 'first_name='+admin_data.first_name+'&last_name='+admin_data.last_name+'&email='+admin_data.email+'&phone='+admin_data.phone;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
            
            console.log(ajaxObj.responseText);

            if (ajaxObj.responseText == "yes\n\n\n") {
                window.location.href = "admin.php#";
                search_user();
            } else {
                alert("Error occurred");
            }
            
        }}}
        ajaxObj.open("GET", "sql-insert-wycliffe-admin.php?"+params);
        ajaxObj.send();
        
    }
}


    
    
    
    
// VIEW/EDIT LANGUAGE
    
var details_project_description = "";
var language_details_description = "";
var language_details_data = {
    language: "",
    pdf_url: ""
}


$( "#language-pdf-url" ).focusout(function() {
    input_url_2();
});
    
function input_url_2() {
    var word = document.getElementById('language-pdf-url');
    language_details_data.pdf_url = word.value;
}

function edit_language () {
    
    console.log(language_details_data);
    
    var edits = document.getElementById('language-project-description').getElementsByClassName("ql-editor");
    for(var i = 0; i < edits.length; i++) {
        language_details_description = edits[i].innerHTML;
        console.log(language_details_description);
    }
    
    var valid = true;
    
    document.getElementById('language-pdf-url').style.borderColor = "#d1d1d1";
    $( "#language-project-description.ql-container" ).css( "border-color", "#d1d1d1" );
    
    if (details_project_description.getLength() <= 1) {
        $( "#language-project-description.ql-container" ).css( "border-color", "#db5353" );
        details_project_description.focus();
        valid = false;
    } else if (language_details_data.pdf_url == '') {
        document.getElementById('language-pdf-url').style.borderColor = "#db5353";
        document.getElementById('language-pdf-url').focus();
        valid = false;
    }
    
    
    
    if (valid) {
        
        var params = 'id='+language_details_data.language+'&project_description='+language_details_description+'&pdf_url='+language_details_data.pdf_url;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {
                
                window.location.href = "admin.php#";
                search_language();
            }
            
        }}}
        ajaxObj.open("GET", "sql-update-language.php?"+params);
        ajaxObj.send();
        
        
    }
    
}





    
    
// VIEW/EDIT CAMPAIGN

var details_goal_description = "";     // text editor
    
var details_description = "";
var details_data = {
    start_date: "",
    end_date: ""
    
    // goal description = form_description
}

function edit_start_date(e) {
    var start_now = new Date(e.value);
    var start_day = ("0" + start_now.getDate()).slice(-2);
    var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);
    var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
    
    var today = new Date();
    if (start_now < today) {
        e.style.borderColor = "#db5353";
        details_data.start_date = "";
        alert("Invalid duration");
    } else {
        e.style.borderColor = "#d1d1d1";
        details_data.start_date = e.value;
        document.getElementById('details-end-date').focus();
    }
    
}
function edit_end_date(e) {
    
    var start_now = new Date(details_data.start_date);
    var start_day = ("0" + start_now.getDate()).slice(-2);
    var start_month = ("0" + (start_now.getMonth() + 1)).slice(-2);

    var end_now = new Date(e.value);
    var end_day = ("0" + end_now.getDate()).slice(-2);
    var end_month = ("0" + (end_now.getMonth() + 1)).slice(-2);

    var start_date = start_now.getFullYear()+"-"+(start_month)+"-"+(start_day);
    var end_date = end_now.getFullYear()+"-"+(end_month)+"-"+(end_day);

    var today = new Date();
    if (start_date >= end_date || today > end_date) {
        e.style.borderColor = "#db5353";
        details_data.end_date = "";
        alert("Invalid duration");
    } else {
        e.style.borderColor = "#d1d1d1";
        details_data.end_date = e.value;
    }
    
}
    
function edit_campaign(campaign) {
    
    var edits = document.getElementById('details-goal-description').getElementsByClassName("ql-editor");
    for(var i = 0; i < edits.length; i++) {
        details_description = edits[i].innerHTML;
        console.log(details_description);
    }
    
    var valid = true;
    
    if ( $( "#details-start-date" ).length ) {
        document.getElementById('details-start-date').style.borderColor = "#d1d1d1";
    }
    document.getElementById('details-end-date').style.borderColor = "#d1d1d1";
    $( "#details-goal-description.ql-container" ).css( "border-color", "#d1d1d1" );
    

    if (details_data.start_date == "") {
        document.getElementById('details-start-date').style.borderColor = "#db5353";
        document.getElementById('details-start-date').focus();
        valid = false;
    } else if (details_data.end_date == "") {
        document.getElementById('details-end-date').style.borderColor = "#db5353";
        document.getElementById('details-end-date').focus();
        valid = false;
    } else if (details_goal_description.getLength() <= 1) {
        $( "#details-goal-description.ql-container" ).css( "border-color", "#db5353" );
        details_goal_description.focus();
        valid = false;
    } 
    
    
    if (valid) {
        
        var params = 'id='+campaign+'&goal_description='+details_description+'&start_date='+details_data.start_date+'&end_date='+details_data.end_date;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {
                
                window.location.href = "admin.php#";
                search_campaign();
            }
            
        }}}
        ajaxObj.open("GET", "sql-update-church-campaign.php?"+params);
        ajaxObj.send();
        
        
        
    }
}
        
    
    
    
// EDIT USER
    
var user_data = {
    first_name: "",
    last_name: "",
    phone: "",
    email: "",
    initial_email: ""
}

function search_email() {
    
    var email = document.getElementById('user-email');
    
    document.getElementById('error-email').style.visibility = "visible";

    var ajaxObj = new XMLHttpRequest();
    ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {
        
        
        var valid = true;
        user_data.email = email.value;
        
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value))) {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Email is invalid';
            valid = false;
        }
        
        console.log(user_data.email+" --- "+user_data.initial_email);
        if (user_data.email != user_data.initial_email && ajaxObj.responseText == "yes\n") {
            document.getElementById('error-email').className = "error red";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_invalid.png">Email already exists';
            valid = false;
        } 
        
        if (valid) {
            user_data.email = email.value;
            document.getElementById('error-email').className = "error green";
            document.getElementById('error-email').innerHTML = '<img class="error-icon" alt="" src="../img/error_valid.png">Email is valid';
        } else {
            user_data.email = "";
        }

    }}}
    ajaxObj.open("GET", "sql-check-new-email.php?email="+email.value);
    ajaxObj.send();
}

$( "#user-email" ).focusout(function() {
    search_email();
});
    
function input_form(title) {
    
    var word = document.getElementById('user-'+title);
    
    switch(title) {
        case 'first-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            user_data.first_name = document.getElementById('user-first-name').value;
            break;
        case 'last-name':
            word.value = word.value.replace(/[^a-zA-Z\.\s]+/, '');
            user_data.last_name = document.getElementById('user-last-name').value;
            break;
        case 'phone':
            word.value = word.value.replace(/[^0-9\)-\.\+\s]+/, '');
            user_data.phone = document.getElementById('user-phone').value;
            break;
        default:
            break;
    }
}
    
function edit_user() {
    
    document.getElementById('user-first-name').style.borderColor = "#d1d1d1";
    document.getElementById('user-last-name').style.borderColor = "#d1d1d1";
    document.getElementById('user-phone').style.borderColor = "#d1d1d1";
    document.getElementById('user-email').style.borderColor = "#d1d1d1";
    
    var valid = true;
    
    if (user_data.first_name == "") {
        document.getElementById('user-first-name').style.borderColor = "#db5353";
        document.getElementById('user-first-name').focus();
        valid = false;
    } else if (user_data.last_name == "") {
        document.getElementById('user-last-name').style.borderColor = "#db5353";
        document.getElementById('user-last-name').focus();
        valid = false;
    } else if (user_data.phone == "") {
        document.getElementById('user-phone').style.borderColor = "#db5353";
        document.getElementById('user-phone').focus();
        valid = false;
    } else if (user_data.email == "") {
        document.getElementById('user-email').style.borderColor = "#db5353";
        document.getElementById('user-email').focus();
        valid = false;
    } 
    
    
    if (valid) {
        
        var params = 'id='+user_id+'&first_name='+user_data.first_name+'&last_name='+user_data.last_name+'&phone='+user_data.phone+'&email='+user_data.email;
        
        console.log(params);
        
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {
                
                window.location.href = "admin.php#";
                search_user();
            }
            
        }}}
        ajaxObj.open("GET", "sql-update-user.php?"+params);
        ajaxObj.send();
    }
    
}
    
    
    
// TRANSACTION
    
function confirm_transaction(id) {
    if (window.confirm("[Confirm Transaction]\r\nAre you sure?")) {
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {

                search_transaction();
            }
            
        }}}
        ajaxObj.open("GET", "sql-confirm-transaction.php?id="+id);
        ajaxObj.send();
    }
}
    
function cancel_transaction(id) {
    if (window.confirm("[Cancel Transaction]\r\nAre you sure?")) {
        var ajaxObj = new XMLHttpRequest();
        ajaxObj.onreadystatechange= function() { if(ajaxObj.readyState == 4) { if(ajaxObj.status == 200) {

            if (ajaxObj.responseText == "no\n") {
                
                alert("Error occurred");
                
            } else {

                search_transaction();
            }
            
        }}}
        ajaxObj.open("GET", "sql-cancel-transaction.php?id="+id);
        ajaxObj.send();
    }
}
    
    
    
    
</script>
    
    
</body>
    
<footer>
</footer>
    
</html>