<?php
session_start();
$_SESSION = array();
session_destroy();
unset($_COOKIE['usermail']);
unset($_COOKIE['password']);
unset($_COOKIE['listName']);
unset($_COOKIE['listId']);
setcookie('usermail', $usermail, time() - (60 * 60 * 24));
setcookie('password', $password, time() - (60 * 60 * 24));
setcookie('listName', $password, time() - (60 * 60 * 24));
setcookie('listId', $password, time() - (60 * 60 * 24));
if (isset($_GET['page']) && $_GET['page']=='signup' ) {
    header("Location: signup.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
