<?php

unset($_COOKIE['email']);
unset($_COOKIE['password']); 
unset($_COOKIE['user_id']); 
setcookie("email", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/"); 
setcookie("user_id","",time() - 3600, "/");
header("Location: /");