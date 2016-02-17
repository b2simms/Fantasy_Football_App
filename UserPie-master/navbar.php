<?php 

	/*
		UserCake Version: 1.0
		http://usercake.com
		

	*/
	
?>	 <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container clearfix">
        <a class="brand" id="logo" href="index.php">Fantasy Football</a>

        
        <ul class="nav pull-right">
<?php if(isUserLoggedIn()) { ?>
            	<li><a href="account.php">Account Home</a></li>
       			<li><a href="change-password.php">Change password</a></li>
 				<li><a href="logout.php">Logout</a></li>
<?php } else { ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                </li>
<?php } ?>
        </ul>
        
      </div>
    </div>
  </div>