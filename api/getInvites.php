<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    // get the most recent list for user
    $sql = "SELECT `invites`.`senderId`,`users`.`Email`, `invites`.`familyId`, `family`.`name` 
    FROM `invites` INNER JOIN `users` ON `invites`.`senderId`=`users`.`id` 
            INNER JOIN `family` ON `invites`.`familyId`=`family`.`id` 
    WHERE `invites`.`sendedToId`=$userId AND `invites`.`approved`='W' ";
    // `invites`.`sendedToId` NOT IN (
    // SELECT `request`.`userId`
    // FROM `request`) ";
    
    $result = $conn->query($sql);
    $invites = array();

    while ($row = $result->fetch_assoc()) {
        $invites[] = $row;
    }
    echo json_encode($invites);
}
$conn->close();