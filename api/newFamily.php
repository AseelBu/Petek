<?php
require_once '../db.php';

if (isset($_POST['userId']) && isset($_POST['familyName'])) {
    $familyName = htmlspecialchars($_POST['familyName']);
    $userId = htmlspecialchars($_POST['userId']);

    //insert the user to admin table
    $sql = "INSERT INTO `fadmin`(`id`) VALUES ('$userId')";
    if ($conn->query($sql) === true) {
        //insert new family
        $sql = "INSERT INTO `family`( `name`, `adminId`) VALUES ('$familyName','$userId')";
        if ($conn->query($sql) === true) {
            $familyId = $conn->insert_id;
            $sql = "UPDATE `users` SET `familyId`=$familyId WHERE `id`=$userId";
            if ($conn->query($sql) === true) {
            
                header('Location:../invites.php?status=newFamily');
                exit();
            } else {
                // error updating family Id for user
                 echo $conn->error;
            }
        } else {
            //error inserting family 
             echo $conn->error;
        }
        
    } else {
        // error inserting family admin
         echo $conn->error;
    }
}
// end of the file
$conn->close();
