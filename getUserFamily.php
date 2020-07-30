<?php
session_start();
require_once('db.php');

if(isset($_SESSION['userId'])){
$sql = "SELECT `familyId` 
FROM `users` 
WHERE `id`=$userId";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['familyId'] = $row['familyId'];
  }else{
    echo ("error finding user's family or user doesn't have family");
  }
}else{
  //TODO user id not set in session??
}
  $conn->close();