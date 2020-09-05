<?php
session_start();
require_once('db.php');


$keypass = isset($_SESSION['keypass']) ? $_SESSION['keypass'] : null;
$password = isset($_SESSION['password']) ? $_SESSION['password'] : null;
$conpwdReg = isset($_SESSION['conpwdReg']) ? $_SESSION['conpwdReg'] : null;




if (isset($_POST['keypass'])) {
    $keypass = htmlspecialchars($_POST['keypass']);
}




if (isset($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
}

if (isset($_POST['conpwdReg'])) {
    $conpwdReg = htmlspecialchars($_POST['conpwdReg']);
}





if (!is_null($keypass)) {


    $sql = "SELECT  `lostKeyPass`
     FROM `users` where lostKeyPass='$keypass'";
    $result = $conn->query($sql);


    //this list doesn't belong to user
    if ($result->num_rows <= 0) {
        var_dump($result);
        // header("Location:changePassword.php?status=requirelostKey");
        // exit();
    }

    

    if (isset($_POST['password']) && isset($_POST['conpwdReg'])) {

        $password = htmlspecialchars($_POST['password']);
        $ConfirmPass = htmlspecialchars($_POST['conpwdReg']);

        //if the password is too short
        if (strlen($password) < 5) {
            header("Location:changePassword.php?status=shortPass");
            exit();
        }

        //passwords are identical-create set new password
        if (strcmp($password, $conpwdReg) === 0) {

            $sql = " UPDATE Users SET pswrd = '$password' WHERE lostKeyPass = '$keypass'";


            if ($conn->query($sql) === TRUE) {
                header("Location:login.php?status=passwordChanged");
                exit();
            } else {
                $conn->error;
            }
        }
        //the paswords don't match
        else {
            header("Location:changePassword.php?status=misMatch");
        } //no password is submited
    } else {
        header("Location:changePassword.php?status=nopswrd");
        exit();
    } //no email was submited
} else {
    header("Location:changePassword.php?status=requirelostKey");
    exit();
}
$conn->close();
