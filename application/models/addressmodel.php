<?php

class AddressModel
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


	public function getPinCodes()
	{
		$sql = "SELECT * FROM pincodes";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getCities($id)
	{
		$sql = "SELECT * FROM cities WHERE pincode_id = '$id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getAddresses($user_id){
		$sql = "SELECT addresses.billing_name, addresses.city_id, addresses.address, addresses.phone, addresses.alt_phone, cities.city_name, pincodes.pins FROM addresses INNER JOIN cities ON addresses.city_id=cities.id INNER JOIN pincodes ON cities.pincode_id=pincodes.id WHERE addresses.user_id = '$user_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function getCityDistance($user_id)
	{
		$sql = "SELECT addresses.id, addresses.user_id, addresses.billing_name, addresses.city_id, addresses.address, addresses.phone, addresses.alt_phone, cities.id AS cities_id, cities.pincode_id, cities.city_name, cities.distance, pincodes.pins AS pincode FROM addresses INNER JOIN cities ON addresses.city_id = cities.id INNER JOIN pincodes ON cities.pincode_id = pincodes.id WHERE addresses.user_id = '$user_id'";

		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public function addAddress($user_id,$name,$city_id,$address,$phone,$alt_phone){
		$sql = "SELECT id FROM addresses WHERE user_id = '$user_id'";
		$query = $this->db->prepare($sql);
		$query->execute();

		if($query->rowCount() > 0) {
			$results = $query->fetchAll();
			foreach($results as $result) {
				$address_id = $result->id;
			}

			$sql = "UPDATE addresses SET billing_name = '$name', city_id = '$city_id', address = '$address', phone = '$phone', alt_phone = '$alt_phone' WHERE id = '$address_id'";
			$query = $this->db->prepare($sql);
			return $query->execute();


		} else {

			$sql = "INSERT INTO addresses(user_id,billing_name,city_id,address,phone,alt_phone) VALUES ('$user_id','$name','$city_id','$address','$phone','$alt_phone')";
			$query = $this->db->prepare($sql);
			return $query->execute();

		}

		
	}


}