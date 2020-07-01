<?php
require_once('db.php');
// if(isset($_POST['email']) && isset($_POST['password'])){
// $email = htmlspecialchars($_POST['email']);
// $password = htmlspecialchars($_POST['Password']);
$Email="so@j.com";
$password="asdfg";
$Nickname=null;
$Phone="1234567890";
$sql = "INSERT INTO `users`(`Email`,`pswrd`, `Nickname`) 
                    VALUES ('$Email','$password','$Nickname')";
            if ($conn->query($sql) === TRUE) {
               
                header("Location:login.php?status=signUp");
                exit();
            } else {
            
                echo "<br>".$conn->error;
            }
    $conn->close();
// }