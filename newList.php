<?php
require_once("db.php");
session_start();

if (isset($_SESSION['userId']) && isset($_POST['listName']) && isset($_POST['oldListChkBox']) && isset($_POST['oldListSelect'])) {

    $userId = $_SESSION['userId'];
    $listName = htmlspecialchars($_POST['listName']);
    $listChkBox = htmlspecialchars($_POST['oldListChkBox']);
    $copyListId = htmlspecialchars($_POST['oldListSelect']);

    
    //1- create new list in DB
    $sql = "INSERT INTO `list`(`name`) VALUES ('$listName')";
    if ($conn->query($sql) === TRUE) {
        $listId = $conn->insert_id;
        //2- insert list for user in db
        $sql = "INSERT INTO `userlists` (`listId`, `userId`) VALUES ('$listId', '$userId')";
        if ($conn->query($sql) === TRUE) {
            //if user chose to import products from list
            if (strcmp($listChkBox, "on")) {
                // 3-get products from the copy list
                require("api/getListProducts.php?listId=$copyListId");
                $products = json_decode($products);
                require_once("db.php");
                if (count($products) !== 0) {
                    //4- add each product to new list in the db
                    foreach ($products as $product) {
                        $sql = "INSERT INTO `listproducts` (`ListId`, `ProductId`) VALUES ('$listId', '$product->id')";
                        if ($conn->query($sql) === TRUE) {
                        } else {
                            echo $conn->error;
                        }
                    }
                } else {
                    header("Location:index.php?status=noProducts");
                    exit();
                }
            } else {
                echo $conn->error;
            }
        } else {
            echo $conn->error;
        }
    }
    header("Location:index.php");
    exit();
}
// end of the file
$conn->close();
