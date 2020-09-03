<?php
require_once("../db.php");

header('Content-Type: application/json');

if (isset($_GET['familyId'])) {
    $familyId = $_GET['familyId'];
    // get the most recent list for user
    $sql = "SELECT `list`.`id`, `list`.`name` 
FROM `familyLists` INNER JOIN `list` on `familyLists`.`listId`=`list`.`id`
WHERE `familyId`=$familyId 
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