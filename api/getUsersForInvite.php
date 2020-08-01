<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['term']) && isset($_GET['userId'])) {
    
    $term = $_GET['term'];
    $userId = $_GET['userId'];
    $sql = "SELECT `users`.`Email`,`users`.`id` 
    FROM `users` LEFT OUTER JOIN `invites` ON `users`.`id`=`invites`.`sendedToId`
    WHERE `users`.`Email` like '$term%' 
    AND `users`.`familyId` is null 
    AND `users`.`id`<>$userId 
    AND `invites`.`sendedToId` is null";
    $result = $conn->query($sql);
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
}
$conn->close();

