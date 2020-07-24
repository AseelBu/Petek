<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_POST['listId']) && isset($_POST['productName']) ) {

    $listId = htmlspecialchars($_POST['listId']);
    $productName = htmlspecialchars($_POST['productName']);
    $amount=0;
    if(isset($_POST['amount'])){
    $amount = htmlspecialchars($_POST['amount']);
    $amount=$amount>0? $amount:0;
    }

    $productName = strtolower($productName);
    $productName = ucfirst($productName);

    $productId = null;

    // 1- check if product name already exists in DB
    $sql = "SELECT * FROM `product` WHERE `name`like '$productName'";
    $result = $conn->query($sql);

    //product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $productId = $product['id'];
    }
    //product doesn't exist
    else {
        //add product to DB
        $sql = "INSERT INTO `product`(`name`) VALUES ('$productName')";
        if ($conn->query($sql) === TRUE) {
            $productId = $conn->insert_id;
        } else {
            echo json_encode($conn->error);
        }
    }
    //2- add product to user's list
    if (!is_null($productId)) {
        if (is_null($amount)) {
            $sql = "INSERT INTO `listproducts`(`ListId`, `ProductId`, `done`) VALUES ('$listId','$productId','N')";
        } else {
            $sql = "INSERT INTO `listproducts`(`ListId`, `ProductId`, `amount`, `done`) VALUES ('$listId','$productId','$amount','N')";
        }

        if ($conn->query($sql) === TRUE) {

            echo json_encode(TRUE);
        } else {
            echo json_encode($conn->error);
        }
    } else {

        echo json_encode(FALSE);
    }
}
// end of the file
$conn->close();
