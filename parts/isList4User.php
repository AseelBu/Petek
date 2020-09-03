<?php
$listId = $_GET['listId'];
        //check if this list is for this user
        if( is_null($familyId)){
        $sql = "SELECT `userId` FROM `userlists` WHERE `userId`=$userId AND `listId`=$listId";
        }else{
            $sql = "SELECT * 
            FROM `userlists` ,`familyLists` 
            WHERE (`userId`=$userId and `userlists`.`listId`=$listId) 
            OR ( `familyId`=$familyId AND `familylists`.`listId`=$listId ) ";
        }

        $result = $conn->query($sql);
        //this list doesn't belong to user
        if ($result->num_rows <= 0) {
            header('Location:index.php?status=noAccess');
            exit();
        } else {
            setcookie('listId', $listId);
        }