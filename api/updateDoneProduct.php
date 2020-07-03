<?php
require("..\db.php");

header('Content-Type: application/json');
if(isset($_POST['listId']) && isset($_POST['productId']) && isset($_POST['done'])){
$listId=htmlspecialchars($_POST['listId']);
$productId=htmlspecialchars($_POST['productId']);
$done=htmlspecialchars($_POST['done']);

if(strcmp($done,'Y') || strcmp($done,'N')){
$sql = "UPDATE `listproducts` SET `done` = '$done' 
WHERE `listproducts`.`ListId` = $listId AND `listproducts`.`ProductId` = $productId; ";

if ($conn->query($sql)===TRUE) {
    echo json_encode($conn->insert_id);
}else {
    echo json_encode($conn->error);
}

}else{
    $error=array();
    echo json_encode($error);
}
}

// end of the file
$conn->close();