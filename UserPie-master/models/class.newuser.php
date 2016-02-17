<?php
/*
	UserPie Version: 1.0
	http://userpie.com
	
*/


class User 
{
	public $user_active = 0;
	private $clean_email;
	public $status = false;
	private $clean_password;
	private $clean_username;
	private $unclean_username;
	public $sql_failure = false;
	public $mail_failure = false;
	public $email_taken = false;
	public $username_taken = false;
	public $activation_token = 0;
	
	function __construct($user,$pass,$email)
	{
		//Used for display only
		$this->unclean_username = $user;
		
		//Sanitize
		$this->clean_email = sanitize($email);
		$this->clean_password = trim($pass);
		$this->clean_username = sanitize($user);
		
		if(usernameExists($this->clean_username))
		{
			$this->username_taken = true;
		}
		else if(emailExists($this->clean_email))
		{
			$this->email_taken = true;
		}
		else
		{
			//No problems have been found.
			$this->status = true;
		}
	}
	
	public function userPieAddUser()
	{
		global $db,$emailActivation,$websiteUrl,$db_table_prefix;
	
		//Prevent this function being called if there were construction errors
		if($this->status)
		{
			//Construct a secure hash for the plain text password
			$secure_pass = generateHash($this->clean_password);
			
			//Construct a unique activation token
			$this->activation_token = generateactivationtoken();
	
				
	
			if(!$this->mail_failure)
			{
					//Insert the user into the database providing no errors have been found.
					$sql = "INSERT INTO `".$db_table_prefix."users` (
							`username`,
							`username_clean`,
							`password`,
							`email`,
							`activationtoken`,
							`last_activation_request`,
							`LostpasswordRequest`, 
							`active`,
							`group_id`,
							`sign_up_date`,
							`last_sign_in`
							)
					 		VALUES (
							'".$db->sql_escape($this->unclean_username)."',
							'".$db->sql_escape($this->clean_username)."',
							'".$secure_pass."',
							'".$db->sql_escape($this->clean_email)."',
							'".$this->activation_token."',
							'".time()."',
							'0',
							'1',
							'1',
							'".time()."',
							'0'
							)";
					 
				return $db->sql_query($sql);
			}
		}
	}
}

?>
