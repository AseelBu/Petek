<?php
require_once("../db.php");

header('Content-Type: application/json');
if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $sql = "SELECT `name` FROM Product WHERE `name` like '$term%'";
    $result = $conn->query($sql);
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}
$conn->close();
