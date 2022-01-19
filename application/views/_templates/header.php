<?php

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId("294235027777-k50fro66c556iapl0s8v18vf97edf0h2.apps.googleusercontent.com");

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret("GTPHBRy89C8JDmtp1mflsLFx");

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri("http://localhost/index.php");

//
$google_client->addScope('email');

$google_client->addScope('profile');

$logincheck = false;
$name = null;
$email = null;
$photo = null;

if(isset($_GET['code'])){
	$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

	$google_client->setAccessToken($token['access_token']);
	$google_service = new Google_Service_Oauth2($google_client);
	$user_data = $google_service->userinfo->get();

	function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 16; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
	}
	$user_email = $user_data->email;
	$user_password = randomPassword();
	$user_name = $user_data->name;
	$user_photo = $user_data->picture;

	$createaccount_model = $this->loadModel('CreateAccountModel');
	$createaccount_model->createAccount($user_email,$user_name,$user_password,$user_photo);

	header('Location: /');
}

if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
	if(empty($_COOKIE["email"]) || empty($_COOKIE["password"])){
		$logincheck = false;
	}
	else {
	$logincheck_model = $this->loadModel('LoginCheckModel');
	$logincheck = $logincheck_model->checkLogin($_COOKIE["email"],$_COOKIE["password"]);

	if($logincheck == false){
		unset($_COOKIE['email']);
		unset($_COOKIE['password']); 
		unset($_COOKIE['user_id']); 
		setcookie("email", "", time() - 3600, "/");
		setcookie("password", "", time() - 3600, "/"); 
		setcookie("user_id","",time() - 3600, "/");
	}
	else {
		$getuserdetail_model = $this->loadModel('GetUserDetailModel');
		$users = $getuserdetail_model->getUserDetail($_COOKIE["email"]);

		foreach($users as $user){
			$name = $user->name;
			$email = $user->email;
			$photo = $user->photo;
		}
	}
	
	}
}

if(isset($_COOKIE['user_id'])) {
	$cart_model = $this->loadModel('CartModel');
	$added_products_to_cart = $cart_model->getCartCount($_COOKIE['user_id']);
}

if($photo == null){
	$photo = "/img/user.jpg";
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title><?=$title?></title>
		<link href="/css/font.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link rel="stylesheet" href="/css/materialize.min.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="Kansu">
<meta name="theme-color" content="#2196f3">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
		<link rel="manifest" href="/manifest.json">
<meta name="msapplication-navbutton-color" content="#fff">
<meta name="msapplication-starturl" content="/">
		  <script src="/js/jquery-1.9.1.js"></script>
		  <style>.material-icons{color:#fff;}</style>

		      <!-- Lato Font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

    <!-- Stylesheet -->
    <link href="/css/gallery-materialize.min.css" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<body>
	  <div style="margin:0px;position:fixed;z-index:1000;" id="progress" class="progress">
      <div class="indeterminate"></div>
  	  </div>
		<header>
			  <nav class="blue">
			    <div class="nav-wrapper">
			    	<ul class="left">
			      		<li><a onclick="goBack()" href="javascript:void(0);"><i class="material-icons">arrow_back</i></a></li>
			      		<li><a href="/"><i class="material-icons">home</i></a></li>
						<li><h1 style="font-size: 2rem; margin: 1rem 0 1rem 0;"><?php if (strlen($title) > 10){ $title = substr($title, 0, 7) . '...';} echo $title; ?></h1></li>
			      	</ul>
			      
			      <ul class="right">
			        <?php if($logincheck){ ?><li><a href="/cart"><i class="material-icons left" style="margin-right:5px;">shopping_cart</i><span id="added_item"><?=$added_products_to_cart?></span></a></li><?php } ?>
			        <li><a href="#" id="user-menu" data-target="slide-out" class="sidenav-trigger" style="display:block;margin:0px;"><i class="material-icons">person_outline</i></a></li>
			      </ul>
			    </div>
			  </nav>
		</header>


		<div style="position:absolute;top:65px;bottom:0px;left:0px;right:0px;overflow-y:scroll;overflow-x:hidden;">
		<div id="portfolio" class="section gray">
			<div  class="container">

<!-- Side Navigation Bar -->


  <ul id="slide-out" class="sidenav"><?php if($logincheck == false){ ?>
  	
  	<div style="height:100%;width:100%;" class="valign-wrapper"><?php echo '<a style="margin:auto;" href="'.$google_client->createAuthUrl().'"><img src="' . URL . DS . 'img' . DS . 'btn_google_signin_dark_normal_web.png" /></a>'; ?></div>

  <?php }else{ ?>

    <li><div class="user-view">
      <div class="background">
        <img src="/img/back.jpg">
      </div>
      <a href="#user"><?php echo '<img class="circle" src="' . $photo . '">'; ?></a>
      <a href="#name"><span class="white-text name"><?php echo $name; ?></span></a>
      <a href="#email"><span class="white-text email"><?php echo $email; ?></span></a>
    </div></li>
    <li><a class="waves-effect" href="/orders"><i class="material-icons">shopping_cart</i>My Orders</a></li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Addresses</a></li>
    <li><a class="waves-effect" href="/myaddresses/">My Address</a></li>
    <!-- <li><a class="waves-effect" href="/myaddresses/selectpincode">Add Address</a></li> -->
    <li><div class="divider"></div></li>
    <li><a class="subheader">Account</a></li>
    <li><a class="waves-effect" href="/home/logout">Logout</a></li>

   <?php } ?>
  </ul>
