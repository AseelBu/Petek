<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['adminId'])) {
    $adminId = $_GET['adminId'];
    // get the most recent list for user
    $sql = "SELECT `request`.`id`, `request`.`userId`,`users`.`Email`,Date_format(`request`.`date`,'%d/%m/%y') as date
    FROM `request` INNER JOIN `users` ON `request`.`userId`=`users`.`id`
    WHERE `approved`='W' AND `adminId`=$adminId
    ORDER BY `request`.`date` DESC";
    $result = $conn->query($sql);
    $requests = array();

    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
    echo json_encode($requests);
}
$conn->close();
