<?php
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

        $password = $_POST['pwdReg'];
        $ConfirmPass = $_POST['conpwdReg'];


        //if the password is too short
        if (strlen($password < 5)) {
            header("Location:setPassword.php?status=shortPass");
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
    }
    header("Location:setpassword.php?s=error");
    exit();
}
header("Location:signup.php");
exit();

$conn->close();
