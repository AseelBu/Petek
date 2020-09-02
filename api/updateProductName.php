<?php
require_once '../db.php';

if (
    isset($_POST['id']) &&
    isset($_POST['newName']) 
    
) {
    $id=htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['newName']);
   

    $sql = "UPDATE `product` SET `name`='$name' 
    WHERE `id`=$id ";
   
    if ($conn->query($sql) === TRUE) {
        echo json_encode('updated');
    } else {
        echo json_encode($conn->error);
    }

}else{
    
}
// end of the file
$conn->close();