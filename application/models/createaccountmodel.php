<?php

class CreateAccountModel
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

	public function createAccount($email,$name,$password,$photo) 
	{
		$sql = "SELECT id,email FROM users WHERE email = '$email'";
		$query = $this->db->prepare($sql);
		$query->execute();

		if ($query->rowCount() > 0) {

			$results = $query->fetchAll();
			foreach($results as $result){
				$user_id = $result->id; 
			}

			$sql = "UPDATE users SET password = '$password' WHERE email = '$email'";
			$query = $this->db->prepare($sql);
			if($query->execute()){
				setcookie("email",$email,time()+ (86400 * 30), "/");
				setcookie("password",$password,time() + (86400 * 30), "/");	
				setcookie("user_id",$user_id,time() + (86400 * 30), "/");	
			}
		}
		else {
			$sql = "INSERT INTO users(name,email,password,photo) VALUES ('$name','$email','$password','$photo')";
			$query = $this->db->prepare($sql);
			if($query->execute()){

				$sql = "SELECT id,email FROM users WHERE email = '$email'";
				$query = $this->db->prepare($sql);
				$query->execute();

				$results = $query->fetchAll();
				foreach($results as $result){
					$user_id = $result->id; 
				}

				setcookie("email",$email,time() + (86400 * 30), "/");
				setcookie("password",$password,time() + (86400 * 30), "/");	
				setcookie("user_id",$user_id,time() + (86400 * 30), "/");	
			}

		}
	}

}