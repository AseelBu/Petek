<?php
require_once("../db.php");

header('Content-Type: application/json');


   
    // get the most recent list for user
    $sql = "SELECT * 
    FROM `product` 
    ORDER BY `name`";
    $result = $conn->query($sql);
    $requests = array();

    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
    echo json_encode($requests);

$conn->close();