<?php
session_start();
$db_connect = mysqli_connect("localhost","root","1iSHgdIKGGYD","mithu");
if(isset($_SESSION["key"]) && !empty($_SESSION["key"])) {
$key = $_SESSION["key"];
$query = "SELECT * FROM admin_login WHERE login_key = '$key'";
$result = mysqli_query($db_connect,$query);

if(mysqli_num_rows($result) > 0){
}
else
{
echo "Not logged in ";
session_destroy();
header("Location:index.php");
die;
}

}
else
{
echo "Not logged in ";
//session_destroy();
header("Location:index.php");
die;
}


