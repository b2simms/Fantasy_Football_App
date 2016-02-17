<?php

class Football {
	
	//Gets all football picks based on username
	function getAllUserPicks()
	{
		global $loggedInUser,$db,$db_table_prefix;
		
		if(isUserLoggedIn())
		{  
			$sql = "SELECT * FROM ".$db_table_prefix."pool1
					WHERE
					userId =".$loggedInUser->user_id;
		}

		$picks = $db->sql_query($sql);
		$rows = array();
		while($r = mysql_fetch_assoc($picks)) {
		    $rows[] = $r;
		}
		return $rows;
	}
	//Gets specific (ONE) football picks based on user, round, and pool
	function getSpecificUserPick($pool=NULL)
	{
		global $loggedInUser,$db,$db_table_prefix;
		
		if(isUserLoggedIn()){
			$round = json_decode($this->getCurrentRound())->round;
			$sql = "SELECT pick FROM ".$db_table_prefix."pool".$pool.
					" WHERE
					userId =".$loggedInUser->user_id.
					" AND roundPicked = '".$round."' LIMIT 1";
			
			$picks = $db->sql_query($sql);
			$rows = array();
			while($r = mysql_fetch_assoc($picks)) {
			    $rows[] = $r;
			}
			return '{"pick": ' . json_encode($rows[0]['pick']). '}';
		}
		return false;
		
	}
	//Gets specific (ONE) football picks based on user, round, and pool
	function getUserPick($round=NULL,$pool=NULL)
	{
		global $loggedInUser,$db,$db_table_prefix;
		
		if(isUserLoggedIn()){
			$sql = "SELECT pick FROM ".$db_table_prefix."pool".$pool.
					" WHERE
					userId =".$loggedInUser->user_id.
					" AND roundPicked = '".$round."' LIMIT 1";
			
			$picks = $db->sql_query($sql);
			$rows = array();
			while($r = mysql_fetch_assoc($picks)) {
			    $rows[] = $r;
			}
			return '{"pick": ' . json_encode($rows[0]['pick']). '}';
		}
		return false;
		
	}
	//Gets update user pick
	function updateUserPick($pick=NULL, $pool=NULL)
	{
		global $loggedInUser,$db,$db_table_prefix;
		
		if(isUserLoggedIn()){
			$round = json_decode($this->getCurrentRound())->round;

			$sql = "UPDATE ".$db_table_prefix."pool".$pool. " SET pick = '".$pick."' WHERE 
			userId = ".$loggedInUser->user_id. " AND
			roundPicked = '".$round."'";
			
			$picks = $db->sql_query($sql);
			var_dump($picks);
			return '{"success":  '. json_encode($picks). '}';
		}
		return false;
		
	}
	//Gets current round
	function getAllTeams()
	{
		global $db,$db_table_prefix;
		
		$sql = "SELECT teamName FROM ".$db_table_prefix."officialgamescores 
				LIMIT 22";
		
		$picks = $db->sql_query($sql);
		$rows = array();
		while($r = mysql_fetch_assoc($picks)) {
		    $rows[] = $r;
		}
		return $rows;
	}
	//Gets current round
	function getCurrentRound()
	{
		global $db,$db_table_prefix;
		
		$sql = "SELECT round FROM ".$db_table_prefix."status
			WHERE
			statusId = 1 LIMIT 1";
		
		$picks = $db->sql_query($sql);
		$rows = array();
		while($r = mysql_fetch_assoc($picks)) {
		    $rows[] = $r;
		}
		return $rows;
	}

	function isUserEliminated(){
		return false;
	}
}
?>