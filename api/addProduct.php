<?php
require("..\db.php");

header('Content-Type: application/json');
$listId=htmlspecialchars($_POST['listId']);
$productName=htmlspecialchars($_POST['productName']);
$amount=htmlspecialchars($_POST['amount']);

$sql = "INSERT INTO `Customers`( `first name`, `last name`, `phone`)
 VALUES ('$firstName','$lastName','$phone')";

if ($conn->query($sql)===TRUE) {
    echo json_encode($conn->insert_id);
}else {
    echo json_encode($conn->error);
}




// end of the file
$conn->close();