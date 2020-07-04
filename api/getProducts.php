<?php 
require_once("..\db.php");

header('Content-Type: application/json');
$sql = "SELECT * FROM Product";
$result = $conn->query($sql);
$products = array();
while($row = $result->fetch_assoc()){
    $products[]=$row;
}
echo json_encode($products);
$conn->close();