<?php
require_once '../db.php';

if (
    isset($_POST['userId']) &&
    isset($_POST['familyId']) &&
    isset($_POST['invitedId'])
) {
    $userId = htmlspecialchars($_POST['userId']);
    $familyId = htmlspecialchars($_POST['familyId']);
    $invitedId = htmlspecialchars($_POST['invitedId']);
    if(strlen($invitedId)==0){
        header('Location:../invites.php?sent=no');
        exit();
    }

    $sql = "INSERT INTO `invites`(`senderId`, `sendedToId`, `familyId`) 
    VALUES ('$userId','$invitedId','$familyId')";
    if ($conn->query($sql) === true) {
        header('Location:../invites.php?sent=yes');
        exit();
    } else {
        // header('Location:../invites.php?sent=no');
        // exit();
        echo $conn->error;
    }
}
// end of the file
$conn->close();
