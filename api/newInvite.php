<?php
require_once("../db.php");

if (isset($_POST['senderId']) && isset($_POST['familyId']) && isset($_POST['invitedId'])) {
    $senderId=htmlspecialchars($_POST['senderId']);
    $familyId=htmlspecialchars($_POST['familyId']);
    $invitedId=htmlspecialchars($_POST['invitedId']);
    

$sql="INSERT INTO `invites`(`senderId`, `sendedToId`, `familyId`) 
VALUES ('$senderId','$invitedId','$familyId')";
 if ($conn->query($sql) === TRUE) {
    header("Location:../invite.php?sent=yes");
    exit();
} else {
    $conn->error;
}

}
// end of the file
$conn->close();