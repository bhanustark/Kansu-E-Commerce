<?php

if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
	if(empty($_COOKIE["email"]) || empty($_COOKIE["password"])){
		$logincheck = false;
		die("I am not logged in.");
	}
	else {

		$logincheck_model = $this->loadModel('KadminModel');
		$logincheck = $logincheck_model->checkLoginAdmin($_COOKIE["email"],$_COOKIE["password"]);

		if($logincheck == false){

			unset($_COOKIE['email']);
			unset($_COOKIE['password']); 
			unset($_COOKIE['user_id']); 

			setcookie("email", "", time() - 3600, "/");
			setcookie("password", "", time() - 3600, "/"); 
			setcookie("user_id","",time() - 3600, "/");

			die("You are not logged in.");

		}
		else {

			$getuserdetail_model = $this->loadModel('GetUserDetailModel');
			$users = $getuserdetail_model->getUserDetail($_COOKIE["email"]);

			foreach($users as $user){

				$name = $user->name;
				$email = $user->email;
				$photo = $user->photo;

				if($photo == null){
					$photo = "/img/user.jpg";
				}

			}
		}
	
	}
}

else {
	die("I am not logged in.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?=$title?> - Kansu Administration Portal</title>
	<!--Import bootstrap.css-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

		<!--JavaScript at end of body for optimized loading-->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Kansu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active" id="homeMenuItem">
        <a class="nav-link" href="/kadmin">Home</a>
      </li>
      <li class="nav-item" id="ordersMenuItem">
        <a class="nav-link" href="/kadmin/orders">Orders</a>
      </li>
      <li class="nav-item" id="pricingMenuItem">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item dropdown" id="productsMenuItem">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Products
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Add Product</a>
          <a class="dropdown-item" href="/kadmin/all_products">All Products</a>
          <a class="dropdown-item" href="/kadmin/all_categories">Categories</a>
        </div>
      </li>
      <li class="nav-item" id="gallaryMenuItem">
      	<a class="nav-link" href="/kadmin/gallary">Gallary</a>
      </li>
    </ul>
  </div>
</nav>
