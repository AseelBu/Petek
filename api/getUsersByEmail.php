<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['term']) && isset($_GET['userId'])) {
    
    $term = $_GET['term'];
    $userId = $_GET['userId'];
    $sql = "SELECT `Email`,`id` 
            FROM `users` 
            WHERE `Email` like '$term%' AND `familyId` is null AND `id`<>$userId";
    $result = $conn->query($sql);
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
}
$conn->close();