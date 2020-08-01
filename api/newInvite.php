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
    if($invitedId===0){
        header('Location:../invite.php?sent=no');
        exit();
    }

    $sql = "INSERT INTO `invites`(`senderId`, `sendedToId`, `familyId`) 
    VALUES ('$userId','$invitedId','$familyId')";
    if ($conn->query($sql) === true) {
        header('Location:../invite.php?sent=yes');
        exit();
    } else {
        // header('Location:../invite.php?sent=no');
        // exit();
        echo $conn->error;
    }
}
// end of the file
$conn->close();
