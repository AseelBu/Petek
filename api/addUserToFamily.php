<?php
require_once '../db.php';

if (isset($_POST['userId']) && isset($_POST['familyId'])) {
    $familyId = htmlspecialchars($_POST['familyId']);
    $userId = htmlspecialchars($_POST['userId']);

    $sql = "UPDATE `users` SET `familyId`=$familyId WHERE `id`=$userId";
    if ($conn->query($sql) === true) {
        //TODO
        header('Location:../index.php');
        exit();
    } else {
        // echo $conn->error;
    }
}
// end of the file
$conn->close();