<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['adminId'])) {
    $adminId = $_GET['adminId'];
    // get the most recent list for user
    $sql = "SELECT `request`.`id`, `users`.`Email`,`request`.`date`
    FROM `request` INNER JOIN `users` ON `request`.`userId`=`users`.`id`
    WHERE `approved`='W' AND `adminId`=$adminId  ";
    $result = $conn->query($sql);
    $requests = array();

    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
    echo json_encode($requests);
}
$conn->close();
