<?php
require("..\db.php");

header('Content-Type: application/json');

if (isset($_GET['listId'])) {
    $listid = $_GET['listId'];
    // get the most recent list for user
    $sql = "SELECT `product`.`id`, `product`.`name`, `listproducts`.`amount`,`listproducts`.`done`
    FROM `listproducts` INNER JOIN `product` on `listproducts`.`ProductId`=`product`.`id`
    WHERE `listproducts`.`ListId`=$listid
    ORDER BY `product`.`name`
";
    $result = $conn->query($sql);
    $products = array();
    while ($row = $result->fetch_assoc()) { 
        $products[] = $row;
        var_dump($result);
        echo ("<br>");
    }
    echo json_encode($products);
}
$conn->close();