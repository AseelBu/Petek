<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['userId'])) {
    $userid = $_GET['userId'];
    // get the most recent list for user
    $sql = "SELECT `list`.`id`, `list`.`name` 
FROM `userlists` INNER JOIN `list` on `userlists`.`listId`=`list`.`id`
WHERE `userId`=$userid 
ORDER BY `list`.`name` 
";
    $result = $conn->query($sql);
    $lists = array();

    while ($row = $result->fetch_assoc()) {
        $lists[] = $row;
    }
    echo json_encode($lists);
}
$conn->close();
