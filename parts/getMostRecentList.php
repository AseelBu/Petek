<?php
// get details of most recent list for user
$sql='';

if( is_null($familyId)){
    echo ('im here');
        $sql = "SELECT `list`.* 
    FROM `userlists` INNER JOIN `list` on `userlists`.`listId`=`list`.`id`
    WHERE `userlists`.`userId`= $userId
    ORDER BY `list`.`creteTime` DESC
    LIMIT 1";
}
else{
    $sql = "SELECT `list`.* 
    FROM `userlists` RIGHT OUTER JOIN `list`  on `userlists`.`listId`=`list`.`id`
    LEFT OUTER JOIN `familylists` on `list`.`id`= `familylists`.`listId`
     WHERE `userlists`.`userId`= $userId OR `familylists`.`familyId`=$familyId
    ORDER BY `list`.`creteTime` DESC 
    LIMIT 1";
}

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $list = $result->fetch_assoc();
            $listId = $list['id'];
            $listName = $list['name'];

            setcookie('listId', $listId);
            setcookie('listName', $listName);
        }