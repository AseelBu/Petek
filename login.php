<?php
session_start();

$email = isset($_COOKIE['usermail']) ? $_COOKIE['usermail'] : "";
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : "";

?>
<!DOCTYPE html>
<html lang="en" data-theme="<?=$theme?>">
<head>
  <?php require_once('parts/headLinks.php'); ?>

  <title>Login</title>
</head>

<body>
  <header>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <?php require "parts/header.php"; ?>
        <!-- <div class="d-flex justify-content-end">

          <a href="signup.php"> <button class=" btn btn-default">Sign-up</button></a>

        </div> -->
    </div>
    </nav>
    </div>
  </header>

  <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">

    <div class="py-3 px-3 shadow main" id="Login">
      <!-- the user tried to access pages without logging in -->
      <?php
      if (isset($_GET["status"]) && $_GET["status"] == "showMsg" ) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
          Please Login to view the page
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
      <?php endif; ?> 
      <?php
      if (isset($_GET["status"]) &&  $_GET["status"] == "notSent") : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Error sending password reset email!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
      <?php endif; ?>
      <?php
      if (isset($_GET["status"]) &&  $_GET["status"] == "sent"): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          A link to reset your password was sent to the Email:<br><?= $_GET['email'] ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
      <?php endif; ?>
      <!-- The user finished signing up -->
      <?php
      if (isset($_GET["status"]) && $_GET["status"] == "signUp") : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Thanks for signing up! </strong><br>Login to get started
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
      <?php endif; ?>


      <?php
      if (isset($_GET["status"]) && $_GET["status"] == "passwordChanged") : ?>
        <div class="alert alert-success" role="alert">
          <strong>Password changed successfully! </strong><br>Login to get started
        </div>
      <?php endif; ?>


      <h2><b>Login</b></h2>
      <?php if (!isset($_SESSION['userId']) || !isset($_SESSION['usermail'])) : ?>
        <small> Default Email: admin@admin.com,password:12345</small>
        <form class="align-middle" id="loginFrm" method="POST" action="index.php">
          <div class="form-group col-md-12">
            <div class="form-row">
              <label for="email" class="">Enter Email: </label>
              <input type="email" class="form-control" id="EmailLogin" name="email" placeholder="Email@Email.com" value="<?= $email ?>" required>
            </div>

            <br>
            <div class="form-row">
              <label for="password" class="">Enter Password: </label>
              <input type="password" class="form-control" id="Password" name="password" placeholder=" Enter Password" value="<?= $password ?>" required>
            </div>

            <div class="form-check form-row">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="chkRememberMe" id="chkRememberMe" value="remember" checked>
                Remember Me
              </label>
            </div>
            <br>
            <?php
            if (isset($_GET["status"]) && ($_GET["status"] == "wrongpassword" || $_GET["status"] == "wrongemail")) :
              $MSG = ($_GET["status"] == "wrongpassword") ?  "wrong password" : "wrong email";
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Login Failed</strong>-<?= $MSG ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif; ?>
            <span class="psw"> <a href="resetPassword.php">Forgot password?</a></span>
            <br>
            <span class="signup">Dont have an acount? <a href="signup.php">Sing Up</a></span>

            <div class="d-flex justify-content-end">
              <input type="submit" class="btn btn-default" value="Login">
            </div>

          </div>
        </form>
      <?php endif;
      if (isset($_SESSION['userId']) && isset($_SESSION['usermail']) && isset($_SESSION['password'])) : ?>

        <div class="loggedIn">
          <div>You are already logged in with Email: <strong><u><?= $_SESSION['usermail'] ?></strong></u>
            <br><br>
            <strong>Not you?</strong>
            <span class="mx-2"> <a href="logout.php"><button class=" btn btn-default">Log Out</button></a></span>
          </div>
          <div class="d-flex justify-content-end">
            <a href="index.php"><button class=" btn btn-default">Go back to Lists</button></a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <?php require "parts/footer.php"; ?>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="scripts/general.js"></script>
</body>

</html>