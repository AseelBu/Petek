<?php
require_once '../db.php';

if (
    isset($_POST['senderId']) &&
    isset($_POST['sendedTo']) &&
    isset($_POST['familyId']) &&
    isset($_POST['approved']) 
) {
    $senderId = htmlspecialchars($_POST['senderId']);
    $sendedTo = htmlspecialchars($_POST['sendedTo']);
    $familyId = htmlspecialchars($_POST['familyId']);
    $approved = htmlspecialchars($_POST['approved']);

    $sql = "UPDATE `invites` SET `approved`='$approved' 
    WHERE `senderId`=$senderId AND `sendedToId`=$sendedTo AND`familyId`=$familyId ";
   
    if ($conn->query($sql) === TRUE) {
        echo json_encode('updated');
    } else {
        echo json_encode($conn->error);
    }

}else{
    
}
// end of the file
$conn->close();