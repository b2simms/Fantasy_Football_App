<?php

	/*
		UserPie Version: 1.0
		http://userpie.com
	
	*/

require_once("models/config.php");
//require_once("models/slim-config.php");

if(!isUserLoggedIn())
{ 
 include('landing-page.php');
	
 } else { 
 	if(isUserAdmin()){
 		header("Location: admin.php");
 	}
 	else{
		header("Location: football_playoff_grid.php"); 
	}
}
?>
