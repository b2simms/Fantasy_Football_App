<?php 
	/*
		UserPie Version: 1.0
		http://userpie.com

		
	*/
	require_once("models/config.php");
	//require_once("models/slim-config.php");

	/*
	* Uncomment the "else" clause below if e.g. userpie is not at the root of your site.
	*/
	if (!isset($loggedInUser))
		header('Location: login.php');
//	else
//		header('Location: /');
	//exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Brent - Playoffs </title>
<?php require_once("head_inc.php"); ?>
<?php include_once 'models/funcs.football.php'; ?>

</head>
<body>
<?php require_once("navbar.php"); ?>
<?php require_once("football_picks.php"); ?>

<?php 
	$website = "http://localhost/UserPie-master/";

	$grid = array("1","2","3","4","5","6","7","8","9","10","11","12","13",
		"14","15","16","17","18","19","20","21","22");
	
	//Get User picks
	$view = new Football();

	$currRound = $view->getCurrentRound()[0]['round'];

	$allTeams = $view->getAllTeams();

	$userPicks = $view->getAllUserPicks();

	$wildcardPick = null;
	$divisionalPick = null;
	$conferencePick = null;
	$superbowlPick = null;

	$forUserPickLoop = count($userPicks);
	for($x = 0; $x < $forUserPickLoop; $x++){
		if(!strcmp('wildcard',$userPicks[$x]['roundPicked'])){
			$wildcardPick = $userPicks[$x]['pick'];
		} else if(!strcmp('divisional',$userPicks[$x]['roundPicked'])){
			$divisionalPick = $userPicks[$x]['pick'];
		} else if(!strcmp('conference',$userPicks[$x]['roundPicked'])){
			$conferencePick = $userPicks[$x]['pick'];
		} else if(!strcmp('superbowl',$userPicks[$x]['roundPicked'])){
			$superbowlPick = $userPicks[$x]['pick'];
		}
	}

	//if Round == 'wildcard' - put all unchecked
	if(!strcmp($currRound,'wildcard')){

		//wildcard LEFT
		$grid[0] = readyGridTeam($allTeams,'wild-left-1',0,$website);
		$grid[1] = readyGridTeam($allTeams,'wild-left-2',1,$website);
		$grid[2] = readyGridTeam($allTeams,'wild-left-3',2,$website);
		$grid[3] = readyGridTeam($allTeams,'wild-left-4',3,$website);

		// //divisional LEFT
		// readyGridTeamLocked("div-left-1",5);
		// readyGridNFL("div-left-2","afc_low");
		// readyGridNFL("div-left-3","afc_high");
		// readyGridTeamLocked("div-left-4",8);
		// //conference LEFT
		// readyGridNFL("con-left-1","to_be_determined");
		// readyGridNFL("con-left-2","to_be_determined");
		// //superbowl LEFT
		// readyGridNFL("sup-left-1","to_be_determined");
		// //superbowl RIGHT
		// readyGridNFL("sup-right-1","to_be_determined");
		// //conference RIGHT
		// readyGridNFL("con-right-1","to_be_determined");
		// readyGridNFL("con-right-2","to_be_determined");
		// //divisional RIGHT
		// readyGridTeamLocked("div-right-1",15);
		// readyGridNFL("div-right-2","nfc_low");
		// readyGridNFL("div-right-3","nfc_high");
		// readyGridTeamLocked("div-right-4",18);
		// //wildcard RIGHT
		// readyGridTeam("wild-right-1",19);
		// readyGridTeam("wild-right-2",20);
		// readyGridTeam("wild-right-3",21);
		// readyGridTeam("wild-right-4",22);

	}
	//if Round != 'wildcard' -check User pick and place rest faded

	function readyGridTeam($allTeams,$id,$pos,$website){
		$str = $allTeams[$pos]['teamName'];
		return '<img id="'.$id.'" class="team-image" src="'. strval($website) ."images/logo_". strval($str) .'.gif"> </img>';
	}
?>

<?php
	//check if user is eliminated
	//Do NOT display board if true 
	if(! $view->isUserEliminated() ) {
		require_once("football_playoff_grid_table.php");
	}
?>
</body>

<script src="assets/js/football_grid.js"></script>

</html>



