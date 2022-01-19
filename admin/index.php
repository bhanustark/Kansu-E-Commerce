<?php
error_reporting(1);
error_reporting(E_ALL);
$db_connect = mysqli_connect("localhost","root","1iSHgdIKGGYD","mithu");
session_start();

if(isset($_POST["submit"])){
    
$email = $_POST["email"];
$password = $_POST["password"];
if(empty($email)){
    echo "email is empty";
    die;
}
if(empty($password)){
    echo "password is empty";
    die;
}
if($email != "admin@kansu.in"){
echo "please enter valid email";
die;
}
if($password != "Az0912345youy4"){
echo "please enter valid password";
die;
}
$randkey = base64_encode(openssl_random_pseudo_bytes(32));
$_SESSION["key"] = $randkey;
$query = "INSERT INTO admin_login(login_key) VALUES ('$randkey')";
$result = mysqli_query($db_connect,$query);
if($result){
echo "you are now logged in";
}
header("Location:index.php");
exit;
}

if(isset($_SESSION["key"]) && !empty($_SESSION["key"])) {
$key = $_SESSION["key"];
$query = "SELECT * FROM admin_login WHERE login_key = '$key'";
$result = mysqli_query($db_connect,$query);

if(mysqli_num_rows($result) > 0){
    echo "logged in";
header("Location:dash.php");
}
else
{
session_destroy();
die;
header("Location:index.php");
}

}
else {
?>

<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div class="container">
<div class="row">
<div class="col s12 m6 offset-m3 center">  
    <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Login</span>
<form action="" method="POST">
<input type="text" placeholder="Email" name="email"/>
<input type="password" placeholder="Password" name="password" />
</div>
<div class="card-action">
<input type="submit" name="submit" />
</div>
</form>
</div></div></div></div>
</body>
</html>
<?php } ?>
