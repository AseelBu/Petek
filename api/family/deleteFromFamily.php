<?php
require_once '../db.php';

if (isset($_POST['userId'])) {
    // $familyId = htmlspecialchars($_POST['familyId']);
    $userId = htmlspecialchars($_POST['userId']);

    $sql = "UPDATE `users` SET `familyId`=NULL 
            WHERE `id`=$userId";
    if ($conn->query($sql) === true) {
        //TODO header link
        header('Location:../index.php');
        exit();
    } else {
        // echo $conn->error;
    }
}
// end of the file
$conn->close();
