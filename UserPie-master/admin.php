<?php
	/*
		UserPie
		http://userpie.com
	*/
	require_once("models/config.php");
	
	//Prevent the user visiting the logged in page if he/she is already logged in
	if(!isUserLoggedIn()) { header("Location: index.php"); die(); }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login | <?php echo $websiteName; ?> </title>
<?php require_once("head_inc.php"); ?>
</head>
<body>
<?php require_once("navbar.php"); ?>
    
<div class="clear"></div>
<p style="margin-top:130px; text-align:center;">
<a class="btn btn-primary" href="football_playoff_grid.php">Continue</a> | <a class="btn btn-danger btn-primary"href="register.php">Register New User</a></p>
            
</body>
</html>


