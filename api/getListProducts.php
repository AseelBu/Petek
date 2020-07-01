<?php
require("..\db.php");

header('Content-Type: application/json');

if (isset($_GET['listid'])) {
    $listid = $_GET['listid'];
    // get the most recent list for user
    $sql = "SELECT `product`.`id`, `product`.`name` 
    FROM `listproducts` INNER JOIN `product` on `listproducts`.`ProductId`=`product`.`id`
    WHERE `listproducts`.`ListId`=$listid
    ORDER BY `product`.`name`
";
    $result = $conn->query($sql);
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $lists[] = $row;
    }
    echo json_encode($products);
}
$conn->close();