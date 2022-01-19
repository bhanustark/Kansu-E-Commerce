<?php

class MyAddresses extends Controller
{
	public function index()
	{

		$title = "My Address";

		$user_id = isset($_COOKIE["user_id"]) ? $_COOKIE["user_id"] : null;
		$address_model = $this->loadModel('AddressModel');
		$addresses = $address_model->getAddresses($user_id);

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'address' . DS . 'index.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');
	}

	public function editAddress($id)
	{
		
		
	}

	public function selectPinCode()
	{

	//	$title = "Select Pin Code";
		$title = "Update Address";
		$address_model = $this->loadModel('AddressModel');
		$pincodes = $address_model->getPinCodes();

		require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'address' . DS . 'selectpin.php');
		require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');			
	}

	public function addAddress(){

		if (isset($_POST["next"])) {

			$title = "Set Address";

			$address_model = $this->loadModel('AddressModel');
			$cities = $address_model->getCities($_POST["pincode"]);

			require(ROOT . DS . 'application' . DS . 'views' . DS . '_templates' . DS . 'header.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'address' . DS . 'add.php');
			require(ROOT . DS . 'application' . DS . 'views' . DS . 'Jarvis' . DS .'footer.php');

		}

		if (isset($_POST["add"])) {

			$user_id = isset($_COOKIE["user_id"]) ? $_COOKIE["user_id"] : null;	
			$name = isset($_POST["full_name"]) ? $_POST["full_name"] : null ;	
			$city = isset($_POST["city_id"]) ? $_POST["city_id"] : null ;	
			$address = isset($_POST["full_address"]) ? $_POST["full_address"] : null ;	
			$phone = isset($_POST["phone"]) ? $_POST["phone"] : null ;	
			$alt_phone = isset($_POST["alt_phone"]) ? $_POST["alt_phone"] : null ;	
			
			$address_model = $this->loadModel('AddressModel');
			$added = $address_model->addAddress($user_id,$name,$city,$address,$phone,$alt_phone);

			if($added){
				header("Location: /myaddresses/");
			}
			else {
				die("address not added");
			}
		}
	}

	public function deleteAddress($id)
	{
		
	}
}