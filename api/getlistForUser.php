<?php
require_once("..\db.php");
// header('Content-Type: application/json');

$userid=isset($_GET['userId'])? $_GET['userId']:null;
$userIndexList=null;
//creation of list user table
// $sql="CREATE TABLE userLists (userId INT(6) NOT null REFERENCES users(id), 
// listId INT(6) NOT null REFERENCES List(id), 
// PRIMARY KEY(listId,userId))";
if(!is_null($userid)){

// get the most recent list for user
$sql="SELECT `list`.* 
FROM `userlists` INNER JOIN `list` on `userlists`.`listId`=`list`.`id`
WHERE `userlists`.`userId`=$userid
ORDER BY `list`.`creteTime` DESC
LIMIT 1";
$result = $conn->query($sql);

if($result->num_rows>0){
    $userIndexList = $result->fetch_assoc();
    var_dump($userIndexList);
}
//if user has no lists yet 
else{
//TODO move to page with create list
}

//add list to 
// echo json_encode($userIndexList);

}
$conn->close();