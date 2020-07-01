<?php
session_start();
$_SESSION = array();
session_destroy();
unset($_COOKIE['usermail']);
unset($_COOKIE['password']);
setcookie('usermail',$usermail, time()-(60*60*24));
setcookie('password',$password, time()-(60*60*24));
header("Location: login.php");
exit();
?>