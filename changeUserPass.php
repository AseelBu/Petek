<?php
session_start();
require_once('db.php');



$password = isset($_SESSION['password']) ? $_SESSION['password'] : null;
$conpwdReg = isset($_SESSION['conpwdReg']) ? $_SESSION['conpwdReg'] : null;
$username =isset($_SESSION['username']) ? $_SESSION['username'] : null;
$userId =isset($_SESSION['userId']) ? $_SESSION['userId'] : null;



if (isset($_POST['keypass'])) {
    $keypass = htmlspecialchars($_POST['keypass']);
}

if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}

if (isset($_POST['conpwdReg'])) {
    $conpwdReg = htmlspecialchars($_POST['conpwdReg']);
}





if (!is_null($password)) {

    // for security, check again that email doesn't exist in db
    $sql = "SELECT  `lostKeyPass`
     FROM `users`";
    $result = $conn->query($sql);
    if ($result->num_rows < 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcmp($row['keypass'], $keypass) === 0) {
                header("Location:signup.php?status=exists");
                exit();
            }
        }
    }

    if (isset($_POST['password']) && isset($_POST['conpwdReg'])) {

        $password = htmlspecialchars($_POST['password']);
        $ConfirmPass = htmlspecialchars($_POST['conpwdReg']);

        //if the password is too short
        if (strlen($password) < 5) {
            header("Location:setPassword.php?status=shortPass&p=$pl");
            exit();
        }

        //passwords are identical-create set new password
        if (strcmp($password, $conpwdReg) === 0) {

            $sql = " UPDATE Users SET pswrd = '$password' WHERE id = $userId";


            if ($conn->query($sql) === TRUE) {
                header("Location:index.php?status=passwordChanged");
                exit();
            } else {
                $conn->error;
            }
        }
        //the paswords don't match
        else {
            header("Location:userChangePass.php?status=misMatch");
        } //no password is submited
    } else {
        header("Location:userChangePass.php?status=nopswrd");
        exit();
    } //no email was submited
} else {
    header("Location:userChangePass.php?status=requirelostKey");
    exit();
}
$conn->close();
