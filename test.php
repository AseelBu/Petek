<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';
$sql = "SELECT `id` FROM `fadmin` WHERE `id`=$userId";
echo ("i'm out\n");
// var_dump($conn->query($sql)===FALSE);
if (!$conn->query($sql)===FALSE) {
    echo ("i got inside");
//     // header('Location:../index.php?status=notAdmin');
//     // exit();
}



?>