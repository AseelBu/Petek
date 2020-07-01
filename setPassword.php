<?php
session_start();
require_once('db.php');

var_dump($_SESSION['signupmail']);

$Email = isset($_SESSION['signupmail']) ? $_SESSION['signupmail'] : null;
$Nickname = isset($_SESSION['signupnickname']) ? $_SESSION['signupnickname'] : null;
$Phone = isset($_SESSION['signupphone']) ? $_SESSION['signupphone'] : null;

if (isset($_POST['Email']) && isset($_POST['Email-confirm'])) {
    $Email = htmlspecialchars($_POST['Email']);
    $ConfirmMail = htmlspecialchars($_POST['Email-confirm']);
    $Nickname = htmlspecialchars($_POST['Nickname']);
    $Phone = htmlspecialchars($_POST['Phone']);

    $_SESSION['signupmail'] = $Email;
    $_SESSION['signupnickname'] = $Nickname;
    $_SESSION['signupphone'] = $Phone;

    //check if the confrmation mail matches the original
    if (strcmp($Email, $ConfirmMail) !== 0) {
        header("Location:signup.php?status=misMatch");
        exit();
    }
    //check if the email already exists in the system
    $sql = "SELECT  `Email`
    FROM `users`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strcmp($row['Email'], $Email) === 0) {
                header("Location:signup.php?status=exists");
                exit();
            }
        }
    }
    //if the phone number doesn't consist onnly of digits or has more than 10 
    if(!is_null($phone)&&(!ctype_digit($phone)|| strlen($phone)!=10)){
        $_SESSION['signupphone']="";
        header("Location:signup.php?status=phoneformat");
        exit();
    }
}
if (is_null($Email)) {
    header("Location:signup.php?status=requireMail");
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <link rel="stylesheet" href="styles/stylesheet.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@500&display=swap" rel="stylesheet">

    <title>Sign-up Password</title>
</head>

<body>
    <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top">
                <?php require "header.php"; ?>
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
            <h2><b>Sign-Up</b></h2>
            <p>Set your password</p>
            <form class="align-middle" id="passwordRegFrm" method="POST" action="insertUser.php">
                <div class="form-group col-md-12">
                    <div class="form-row ">

                        <label for="pwdReg" class="">Enter Password: </label>

                        <input type="password" class="form-control" id="pwdReg" name="pwdReg" placeholder="Password" required>
                    </div>

                    <br>
                    <div class="form-row">
                        <label for="conpwdReg" class="">Confirm Password: </label>
                        <input type="password" class="form-control" id="conpwdReg" name="conpwdReg" placeholder=" Confirm Password" required>
                    </div>
                  
                    <br>
                    <?php
                    if (isset($_GET["status"]) && ($_GET["status"] == "misMatch" || $_GET["status"] == "shortPass")) :
                        $MSG = ($_GET["status"] == "misMatch") ?  "Inserted Passwords are not identical" : "<strong>Password too short.</strong> <br>It must contain at lest 5 characters";
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $MSG ?>
                        </div>

                    <?php endif; ?>
                    <div class="d-flex justify-content-end my-2">
                        <input type="submit" class="btn btn-default" value="Set Password">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php require "footer.php"; ?>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="scripts/general.js"></script>
</body>

</html>