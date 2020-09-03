<?php
session_start();
require_once('db.php');


$keypass = isset($_SESSION['keypass']) ? $_SESSION['keypass'] : null;
$password = isset($_SESSION['password']) ? $_SESSION['password'] : null;
$conpwdReg = isset($_SESSION['conpwdReg']) ? $_SESSION['conpwdReg'] : null;


?>




<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <?php require_once('parts/headLinks.php'); ?>

    <title>Sign-up Password</title>
</head>

<body>
    <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
                <?php require "parts/header.php"; ?>
                <div class="d-flex justify-content-end">

                    <a href="login.php"><button class=" btn btn-default">Login</button></a>

                </div>
        </div>
        </nav>
        </div>
    </header>
    <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">
        <div class="py-3 px-3 shadow main" id="password">
            <?php
            if (isset($_GET["status"]) && $_GET["status"] == "nopswrd") :
                $MSG = "<strong>Insert password in order to continue</strong>";


            
            ?>

            
                <div class="alert alert-danger" role="alert">
                    <?= $MSG ?>
                </div>

            <?php endif; ?>
            <h2><b>Reset Password</b></h2>
            <p>reset your password</p>
            <form class="align-middle" id="passwordRegFrm" method="POST" action="updatePassword.php">
                <div class="form-group col-md-12">


                <div class="form-row">
                        <label for="keypass" class="">Enter Key: </label>
                        <input type="text" class="form-control" id="keypass" name="keypass" placeholder="keypass" required>
                    </div>

                <br>
                    <div class="form-row ">

                        <label for="password" class="">Enter Password: </label>

                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>

                    <br>
                    <div class="form-row">
                        <label for="conpwdReg" class="">Confirm Password: </label>
                        <input type="password" class="form-control" id="conpwdReg" name="conpwdReg" placeholder=" Confirm Password" required>
                    </div>

                    <br>
                    <?php
                    //if (isset($_GET["status"]) && ($_GET["status"] == "misMatch" || $_GET["status"] == "shortPass" || $_GET["status"]=="requirelostKey")) :
                     //  $MSG = ($_GET["status"] == "misMatch") ?  "Inserted Passwords are not identical" : "<strong>Password too short.</strong> <br>It must contain at lest 5 characters";
                    
                       if (isset($_GET["status"]) && ($_GET["status"] == "misMatch" || $_GET["status"] == "shortPass" || $_GET["status"]=="requirelostKey")) :
                        $MSG = ($_GET["status"] == "misMatch") ?  "Inserted Passwords are not identical" :(($_GET["status"] == "shortPass") ? "<strong>Password too short.</strong> <br>It must contain at lest 5 characters" : "please enter lost keypass!");
                     
                       
                  ?>

                    

                   
                        <div class="alert alert-danger" role="alert">
                            <?= $MSG ?>
                        </div>

                    <?php endif; ?>
                    <div class="d-flex justify-content-end my-2">
                        <input type="submit"    class="btn btn-default" value="Set Password">
                    </div>
                </div>
            </form>
        </div>

    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">


        

        
    </script>








    <?php require "parts/footer.php"; ?>





    


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="scripts/general.js"></script>
</body>

</html>