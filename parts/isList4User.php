<?php
$listId = $_GET['listId'];
        //check if this list is for this user
        if( is_null($familyId)){
        $sql = "SELECT `userId` FROM `userlists` WHERE `userId`=$userId AND `listId`=$listId";
        }else{
            $sql = "SELECT * 
            FROM `userlists` LEFT OUTER JOIN `familyLists` on `userlists`.`listId`=`familylists`.`listId`
            WHERE (`userId`=1 and `userlists`.`listId`=16) 
            OR ( `familyId`=2 AND `familylists`.`listId`=16 )
            
            UNION
            SELECT * 
            FROM `userlists` RIGHT OUTER JOIN `familyLists` on `userlists`.`listId`=`familylists`.`listId`
            WHERE (`userId`=1 and `userlists`.`listId`=16) 
            OR ( `familyId`=2 AND `familylists`.`listId`=16 ) ";
        }

        $result = $conn->query($sql);
        //this list doesn't belong to user
        if ($result->num_rows <= 0) {
            header('Location:index.php?status=noAccess');
            exit();
        } else {
            setcookie('listId', $listId);
        }