<?php
require_once('db.php');
$productName= $_POST['prdctName'];
$password=_$_POST['pwdReg'];
$ConfirmMail = $_POST['Email-confirm'];
$Nickname = $_POST['Nickname'];
$Phone = $_POST['Phone'];
$sql = "INSERT INTO `users`(`Email`,`pswrd`, `Nickname`, `phone`) 
VALUES ('$Email','$Nickname','$Phone')";

if ($conn->query($sql)===TRUE) {
    echo "User created"
    //header("Location:index.php");
}else {
    $conn->error;
}



//EOF