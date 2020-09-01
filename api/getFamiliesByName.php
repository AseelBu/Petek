<?php
require_once("../db.php");

header('Content-Type: application/json');
if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $sql = "SELECT `id`,`name`,`adminId` 
    FROM `family` 
    WHERE `name` like '$term%' 
    ORDER BY `name`";
    $result = $conn->query($sql);
    $families = array();
    while ($row = $result->fetch_assoc()) {
        $families[] = $row;
    }
    echo json_encode($families);
}
$conn->close();
