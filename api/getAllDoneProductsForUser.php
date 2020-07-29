<?php
require_once("../db.php");

header('Content-Type: application/json');
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
// get user lists
// from each list get the done items

$sql= "SELECT DISTINCT `product`.`name` 
        FROM `userlists` INNER JOIN `listproducts` ON `userlists`.`listId`=`listproducts`.`ListId` 
                INNER JOIN `product` ON `listproducts`.`ProductId`=`product`.`id`
        WHERE `userlists`.`userId`=$userId AND  `listproducts`.`done`='Y'";
 $result = $conn->query($sql);
 $products = array();

 while ($row = $result->fetch_assoc()) {
     $products[] = $row;
 }
 echo json_encode($products);
}
$conn->close();