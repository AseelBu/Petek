<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['familyId'])) {
    $familyId = $_GET['familyId'];
    // get the most recent list for user
    $sql = "SELECT `id`, `Email`, `Nickname`  FROM `users` WHERE `familyId`=$familyId
    ORDER BY `Email` ";
    $result = $conn->query($sql);
    $members = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
    }
    echo json_encode($members);
}
$conn->close();