<?php
require_once('db.php');
// if(isset($_POST['email']) && isset($_POST['password'])){
// $email = htmlspecialchars($_POST['email']);
// $password = htmlspecialchars($_POST['Password']);

$sql = "SELECT  `pswrd`
    FROM `users`
    where `email` like 'aseel_bu@hotmail.com'
   ";
   echo "i got here";
    $result = $conn->query($sql);
   
    // var_dump($result->fetch_assoc());
    if ($result->num_rows === 1) {
        while ($row = $result->fetch_assoc()) {
            var_dump($row['pswrd']);
            echo "yu";
            // if (strcmp($row['Email'], $Email) === 0) {
            //     header("Location:signup.php");
            // }
        }
    }else{//mail does't exist

    }
    $conn->close();
// }