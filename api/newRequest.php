<?php
require_once '../db.php';

if (
    isset($_POST['userId']) &&
    isset($_POST['familyId']) 
) {
    $userId = htmlspecialchars($_POST['userId']);
    $familyId = htmlspecialchars($_POST['familyId']);

    //get the family admin id
    $sql = "SELECT `adminId` FROM `family` WHERE `id`=$familyId";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $adminId= $row ['adminId'];
    
        // create new request
        $sql = "INSERT INTO `request`( `userId`, `adminId`) VALUES ($userId,$adminId)";
        if ($conn->query($sql) === true) {
        header('Location:../invites.php?sent=yes');
        exit();
        } else {
        // header('Location:../invites.php?sent=no');
        // exit();
        echo $conn->error;
         }
    }
    else{
        header('Location:../invites.php?sent=no');
        exit();
        //something wrong there is no admin for the family
        // echo $conn->error;
    }
}
// end of the file
$conn->close();
