<?php
session_start();
require_once('db.php');

$Email = isset($_SESSION['signupmail']) ? $_SESSION['signupmail'] : null;
$Nickname = isset($_SESSION['signupnickname']) ? $_SESSION['signupnickname'] : null;
$Phone = isset($_SESSION['signupphone']) ? $_SESSION['signupphone'] : null;

if (!is_null($Email)) {

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

    if (isset($_POST['pwdReg']) && isset($_POST['conpwdReg'])) {

        $password = htmlspecialchars($_POST['pwdReg']);
        $ConfirmPass = htmlspecialchars($_POST['conpwdReg']);

        //if the password is too short
        if (strlen($password) < 5) {
            header("Location:setPassword.php?status=shortPass&p=$pl");
            exit();
        }

        //passwords are identical-create new user
        if (strcmp($password, $ConfirmPass) === 0) {

            //create query without the NULL of optinal values
            if (is_null($Nickname) && is_null($Phone)) {
                $sql = "INSERT INTO `users`(`Email`,`pswrd`) 
                    VALUES ('$Email','$password')";
            } elseif (!is_null($Nickname) && !is_null($Phone)) {
                $sql = "INSERT INTO `users`(`Email`,`pswrd`, `Nickname`, `phone`) 
                    VALUES ('$Email','$password','$Nickname','$Phone')";
            } elseif (!is_null($Nickname) && is_null($Phone)) {

                $sql = "INSERT INTO `users`(`Email`,`pswrd`, `Nickname`) 
                    VALUES ('$Email','$password','$Nickname')";
            } else {
                $sql = "INSERT INTO `users`(`Email`,`pswrd`,`phone`) 
                    VALUES ('$Email','$password','$Phone')";
            }


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
        } //no password is submited
    } else {
        header("Location:setpassword.php?status=nopswrd");
        exit();
    } //no email was submited
} else {
    header("Location:signup.php?status=requireMail");
    exit();
}
$conn->close();
