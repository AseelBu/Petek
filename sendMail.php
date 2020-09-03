<?php
   
   session_start();
   require_once('db.php');
  
    use PHPMailer\PHPMailer\PHPMailer;

   $rndm=generateRandomString();
    
    if ( isset($_POST['email'])) {
     
    
   //     $name = $_POST['email'];
        $email = $_POST['email'];
        $subject ='RESET PASSWORD';
        $body = 'Your lost keypass is:<br>';
        


        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "ppetek609@gmail.com";
        $mail->Password = 'Petekmaster';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls
        
        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email);
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body =  $body.$rndm."<br>to reset your password please "."<a href='http://localhost/petek/changePassword.php'>click here </a>";

        


           // for security, check if that lost pass key doesnt belong to another user


    

  
    
    $sql =" UPDATE Users SET lostKeyPass = '$rndm' WHERE Email = '$email'";

    if ($conn->query($sql) === TRUE) {
     echo "Record updated successfully";
     } else {
      echo "Error updating record: " . $conn->error;
    }
    

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));


    }


    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+?><":}{';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
      
        return $randomString;
    }





?>
