<?php
	include("connection.php");
	session_start();
	if(isset($_SESSION['user_login'])) {
		$user = $_SESSION["user_login"];
	}else{
		$user = "";
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no"  />
<link href = "css/bootstrap.css" rel= "stylesheet" />
<link href = "css/bootstrap-responsive.css" rel= "stylesheet" />
<link href = "css/style.css" rel= "stylesheet" />
</head>

<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/main.js" type="text/javascript"></script>

<?php 
if (!$user) {


echo '<div class = "navbar navbar-fixed-top">

	<div class = "navbar-inner">
    
    	<div class = "container">
        
        	<a href = "index.php" class = "brand">UCL Game Hub</a>
        	<a class = "btn btn-navbar" data-toggle = "collapse" data-target = ".nav-collapse">
            	<i class = "icon-th-list"></i>
            </a>
            
            
        	<div class = "nav-collapse collapse">
            <ul class = "nav pull-right">
            	<li class = "active"><a href ="index.php"><i class = "icon-home"></i> Home</a></li>
                <li><a href ="#"><i class = "icon-tags"></i> About</a></li>
                <li><a href ="#"><i class = "icon-envelope"></i> Contact</a></li>
                <li class= "dropdown">
                	<a class = "dropdown-toggle" data-toggle = "dropdown" href ="#"><i class = "icon-wrench"></i> Support <i class = "caret"></i></a>
                    <ul class = "dropdown-menu">
                    	<li><a href = "#">Customer Service</a></li>
                        <li><a href = "#">Privacy Policy</a></li>
                        <li><a href = "#">Terms of Service</a></li>
                    </ul>
                </li>           
            </ul>
            </div>
        </div>  
	</div>        
</div>';
}else{
	
echo '<div class = "navbar navbar-fixed-top">

	<div class = "navbar-inner">
    
    	<div class = "container">
        
        	
        	<a class = "btn btn-navbar" data-toggle = "collapse" data-target = ".nav-collapse">
            	<i class = "icon-th-list"></i>
            </a>
            
        	<div class = "search_box">
				<form action="search.php" method="GET" id="search">
                	<input type="text" id="search_input" name="query" size="100" placeholder="Search..." />
                </form>
            </div>
            
        	<div class = "nav-collapse collapse">
            <ul class = "nav pull-right">
            	<li class = "active"><a href ="home.php"><i class = "icon-home"></i> Home</a></li>
                <li><a href ="profile.php"><i class = "icon-user"></i> Profile</a></li>
                <li class= "dropdown">
                	<a class = "dropdown-toggle" data-toggle = "dropdown" href ="#"><i class = "icon-wrench"></i> Account Setting<i class = "caret"></i></a>
                    <ul class = "dropdown-menu">
						<li><a href = "my_messages.php">Message Center</a></li>
						<li><a href = "friend_requests.php">Friend Requests</a></li>
                    	<li><a href = "account_settings.php">Edit Profile</a></li>
                        <li><a href = "password_change.php">Change Password</a></li>
                    </ul>
                </li>
				<li><a href="logout.php"><i class = "icon-off"></i> Logout</a></li           
            </ul>
            </div>
        </div>  
	</div>        
</div>';	
	
	
}
	
?>
<div id="all">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>