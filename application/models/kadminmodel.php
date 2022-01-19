<?php

class KadminModel
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

	public function checkLoginAdmin($email,$password) 
	{
		$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
		$query = $this->db->prepare($sql);
		$query->execute();

		if ($query->rowCount() > 0) {

			$results = $query->fetchAll();
			foreach ($results as $result) {
				$user_id = $result->id;
			}

			$sql = "SELECT * FROM admins WHERE user_id = '$user_id'";
			$query = $this->db->prepare($sql);
			$query->execute();

			if ($query->rowCount() > 0) {
				return true;
			}
			else {
				return false;
			}

		}
		else {
			return false;
		}
	}

}