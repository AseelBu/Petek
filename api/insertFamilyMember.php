<?php
require_once '../db.php';

if (isset($_POST['requestId']) && isset($_POST['reqStatus']) 
&& isset($_POST['userId']) && isset($_POST['familyId'])) {
    $requestId = htmlspecialchars($_POST['requestId']);
    $reqStatus = htmlspecialchars($_POST['reqStatus']);
    $userId = htmlspecialchars($_POST['userId']);
    $familyId = htmlspecialchars($_POST['familyId']);

    // update request approval status
    $sql="UPDATE `request` SET `approved`='$reqStatus' WHERE `id`=$requestId";
    
    if ($conn->query($sql) === true) {
        // add user to family if he was approved
        if($reqStatus==='Y'){
            $sql="UPDATE `users` SET `familyId`=$familyId WHERE `id`=$userId ";

            if ($conn->query($sql) === true) {
        }
        //TODO
        header('Location:../index.php');
        exit();
    } else {
        // echo $conn->error;
    }
}
// end of the file
$conn->close();