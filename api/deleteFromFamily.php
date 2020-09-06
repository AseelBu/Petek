<?php
require_once '../db.php';

if (isset($_POST['userId'])&& isset($_POST['familyId'])) {
    
    // $familyId = htmlspecialchars($_POST['familyId']);
    $userId = htmlspecialchars($_POST['userId']);
    $familyId = htmlspecialchars($_POST['familyId']);

    $sql = "UPDATE `users` SET `familyId`=NULL 
            WHERE `id`=$userId";
    if ($conn->query($sql) === true) {
        require_once 'deleteInvite.php';
        echo json_encode("updated");
    } else {
        echo json_encode($conn->error);
    }
}
// end of the file
$conn->close();
