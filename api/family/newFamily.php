<?php
require_once '../db.php';

if (isset($_POST['userId']) && isset($_POST['familyName'])) {
    $familyName = htmlspecialchars($_POST['familyName']);
    $userId = htmlspecialchars($_POST['userId']);

    $sql = "INSERT INTO `family`( `name`, `adminId`) VALUES ('$familyName','$userId')";
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
