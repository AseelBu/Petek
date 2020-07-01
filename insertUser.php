<?php
require_once('db.php');

if (isset($_POST['email'])) {
    var_dump($_POST['email']);
    if (isset($_POST['pwdReg']) && isset($_POST['conpwdReg'])) {
        $Email = $_POST['email'];
        $password = $_POST['pwdReg'];
        $ConfirmPass = $_POST['conpwdReg'];
        $Nickname = $_POST['nickname'];
        $Phone = $_POST['phone'];

        // for security, check again that email doesn't exist in db
        $sql = "SELECT  `Email`
    FROM `users`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcmp($row['Email'], $Email) === 0) {
                header("Location:signup.php?status=exists");
                exit();
            }
        }
    }
        //if the password is too short
        if(strlen($password<5)){
            header("Location:login.php?status=shortPass");
                exit();
        }
        //passwords are identical-create new user
        if (strcmp($password, $ConfirmPass) === 0) {
            $sql = "INSERT INTO `users`(`Email`,`pswrd`, `Nickname`, `phone`) 
            VALUES ('$Email','$password',$Nickname','$Phone')";
            if ($conn->query($sql) === TRUE) {
                header("Location:login.php?status=signUp");
                exit();
            } else {
                $conn->error;
            }
        }
        //the paswords don't match
        else {
            header("Location:setPassword.php?status=misMatch");
        }
    }header("Location:setpassword.php");
    exit();
}header("Location:signup.php");
exit();

$conn->close();
