<?php

    $sql = "DELETE FROM `invites` WHERE `sendedToId`=$userId AND `familyId`=$familyId ";
   
    if ($conn->query($sql) === TRUE) {
        echo json_encode('updated');
    } else {
        echo json_encode($conn->error);
    }

