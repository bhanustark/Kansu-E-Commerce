<?php

class LoginCheckModel
{
	
	function __construct($db)
	{
		try {
			$this->db = $db;
		}
		catch (PDOException $e) {
			exit('Database connection error');
		}
	}

	public function checkLogin($email,$password) 
	{
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
		$query = $this->db->prepare($sql);
		$query->execute();

		if ($query->rowCount() > 0) {
			return true;
		} 
		else {
			return false;
		}
	}

}