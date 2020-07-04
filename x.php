<?php
require("db.php");
header('Content-Type: application/json');

$productName="Avocado";

$sql = "SELECT * FROM `product` WHERE `name`like '$productName'";

$result = $conn->query($sql);


if ($result->num_rows>0){
//product exists

    $product = $result->fetch_assoc();
    $productId = $product['id'];
    echo json_encode(TRUE);
}

$conn->close();