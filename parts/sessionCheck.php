<?php

if(isset($_SESSION['userId'])){
   $userId= $_SESSION['userId'];

    $sql = "SELECT `familyId` 
    FROM `users` 
    WHERE `id`=$userId";
    
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
         
          $_SESSION['familyId'] = $row['familyId'];
      }else{
          unset($_SESSION['familyId']);
        echo ("error finding user's family or user doesn't have family");
      }
    }else{
      //TODO user id not set in session??
    }

    $_SESSION['isAdmin']=FALSE;
    $sql = "SELECT `id` FROM `fadmin` WHERE `id`=$userId";
    $result = $conn->query($sql);
if ($result->num_rows >0) {
    $_SESSION['isAdmin']=TRUE;
}
   

$familyId = isset($_SESSION['familyId']) ? $_SESSION['familyId'] : null;
$isAdmin=isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : null;
$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$familyId = isset($_SESSION['familyId']) ? $_SESSION['familyId'] : null;

?>