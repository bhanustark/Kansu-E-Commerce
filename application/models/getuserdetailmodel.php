<?php

class GetUserDetailModel
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


	public function getUserDetail($email)
	{
		$sql = "SELECT * FROM users WHERE email = '$email'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

}