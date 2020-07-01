<?php
require_once("db.php");
$userid;
$listId=null;
//creation of list user table
// $sql="CREATE TABLE userLists (userId INT(6) NOT null REFERENCES users(id), 
// listId INT(6) NOT null REFERENCES List(id), 
// PRIMARY KEY(listId,userId))";


// get the most recent list for user
$sql="SELECT `userlists`.`listId` 
FROM `userlists` INNER JOIN `list` on `userlists`.`listId`=`list`.`id`
WHERE `userlists`.`userId`=$userid
ORDER BY `list`.`creteTime` DESC
LIMIT 1";
$result = $conn->query($sql);

if($result->num_rows>0){
$row = $result->fetch_assoc();
$listId=$row['listId'];
header()
}
//if user has no lists yet 
else{
//TODO move to page with create list
}

//add list to 
echo json_encode($products);

