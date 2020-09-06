<?php
require_once("../db.php");

header('Content-Type: application/json');
if (isset($_GET['userId']) ) {

    $userId = $_GET['userId'];
    $familyId=NULL;
    if(isset($_GET['familyId']) && $_GET['familyId']!== -1){
        $familyId=$_GET['familyId'];

    }
// get user lists
// from each list get the done items

$sql= "SELECT DISTINCT `product`.`id`,`product`.`name` 
        FROM `userlists` INNER JOIN `listproducts` ON `userlists`.`listId`=`listproducts`.`ListId` 
                INNER JOIN `product` ON `listproducts`.`ProductId`=`product`.`id` 
        WHERE `userlists`.`userId`=$userId AND  `listproducts`.`done`='Y'";

 $result = $conn->query($sql);
 $products = array();

 while ($row = $result->fetch_assoc()) {
     $products[] = $row;
 }

//  if the user have family lists too
 if(!is_null($familyId)){
     
    $sql= "SELECT DISTINCT `product`.`id`,`product`.`name` 
        FROM `familylists` INNER JOIN `listproducts` ON `familylists`.`listId`=`listproducts`.`ListId` 
                INNER JOIN `product` ON `listproducts`.`ProductId`=`product`.`id` 
        WHERE `familylists`.`familyId`=$familyId AND  `listproducts`.`done`='Y'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
           $products[] = $row;
       }
}
 
 echo json_encode($products);
}
$conn->close();