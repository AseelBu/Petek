<?php

require("..\db.php");

if (isset($_POST['listId']) && isset($_POST['productId'])) {
    $listId=$_POST['listId'];
    $productId=$_POST['productId'];

    $sql = "DELETE FROM `listproducts` WHERE `ListId`=$listId AND `ProductId`=$productId";
    
    if ($conn->query($sql)===TRUE) {
        echo json_encode("success");
    }else {
        echo json_encode($conn->error);
    }
    
}
$conn->close();
