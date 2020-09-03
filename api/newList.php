<?php
session_start();
require_once("../db.php");
// require_once("../parts/sessionCheck.php");


if (isset($_SESSION['userId'])  && isset($_POST['listName'])) {
    
    $userId = $_SESSION['userId'];
    if( isset($_SESSION['familyId'])){
    $familyId = $_SESSION['familyId'];
    }
    $listName = htmlspecialchars($_POST['listName']);
    
    if (isset($_POST['oldListChkBox'])) {
        $listChkBox = $_POST['oldListChkBox'];
    }
    if (isset($_POST['oldListSelect'])) {
        $copyListId = htmlspecialchars($_POST['oldListSelect']);
    }

    $privacy = 'P';
    if(isset($_POST['privacy'])){
        $privacy = htmlspecialchars($_POST['privacy']);
        $privacy = strcmp($privacy,"private")=== 0? 'P':'F';
    }
    

    //1- create new list in DB
    $sql = "INSERT INTO `list`(`name`,`privacy`) VALUES ('$listName','$privacy')";
    if ($conn->query($sql) === TRUE) {
        $listId = $conn->insert_id;

        //if the list is private for user
        if(strcmp($privacy,"P")===0){
        //2a- insert list for user in db
        $sql = "INSERT INTO `userlists` (`listId`, `userId`) VALUES ('$listId', '$userId')";
        }
        // if list is shared with family
        if(strcmp($privacy,"F")===0){
            //2b- insert list for family in db
        $sql = "INSERT INTO `familyLists` (`listId`, `familyId`) VALUES ('$listId', '$familyId')";
        }
        if ($conn->query($sql) === TRUE) {
            //if user chose to import products from list

            if (strcmp($listChkBox, "on") === 0) {
                // 3-get products from the copy list
                $_GET['listId'] = $copyListId;

                require("getListProducts.php");
                require('../db.php');
                if (count($products) !== 0) {
                    //4- add each product to new list in the db
                    foreach ($products as $product) {

                        $pId = $product['id'];
                        $pAmount = $product['amount'];
                        $sql = "INSERT INTO `listproducts` (`ListId`, `ProductId`, `amount`, `done`) 
                        VALUES ('$listId', '$pId','$pAmount','N')";
                        if ($conn->query($sql) === TRUE) {
                        } else {
                            echo $conn->error;
                        }
                    }
                } else {
                    header("Location:../index.php?status=noProducts");
                    exit();
                }
            } else {
                echo $conn->error;
            }
        } else {
            echo $conn->error;
        }
    }
    header("Location:../index.php");
    exit();
}
// end of the file
$conn->close();
