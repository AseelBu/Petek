<?php
session_start();
$Email = isset($_SESSION['signupmail']) ? $_SESSION['signupmail'] : "";
$Nickname = isset($_SESSION['signupnickname']) ? $_SESSION['signupnickname'] : "";
$Phone = isset($_SESSION['signupphone']) ? $_SESSION['signupphone'] : "";

if (isset($_GET['status']) && $_GET["status"] == "exists") {
  $Email = "";
}
?>
<!doctype html>
<html lang="en">

<head>
  <?php require_once('parts/headLinks.php'); ?>
  <title>Sign-up !</title>
</head>

<body>
  <header>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <?php require "parts/header.php"; ?>

    </div>
    </nav>
    </div>
  </header>
  <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">
    <div class="py-3 px-3 shadow main" id="signUp">
      <?php
      if (isset($_GET["status"]) && ($_GET["status"] == "requireMail")) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>An Email is required for signing up</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>

      <?php endif; ?>

      <h2><b>Sign-Up</b></h2>
      <?php if (!isset($_SESSION['userId'])) : ?>
        <p>Create new account</p>

        <form id="SignUpFrm" method="POST" action="setPassword.php">
          <div class="form-group col-12">
            <div class="form-row">
              <label for="Email">Email:*</label>
              <input type="email" class="form-control" id="Email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email@Email.com" value="<?= $Email ?>" required>
            </div>

            <div class="form-row">
              <label for="Email-confirm"> Email confirm:*</label>
              <input type="email" class="form-control" id="Email-confirm" name="Email-confirm" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Repeat email" required>
            </div>

            <div class="form-row">
              <label for="Nickname"> Nickname:</label>
              <input type="text" class="form-control" id="Nickname" name="Nickname" placeholder="Enter nickname" value="<?= $Nickname ?>">
            </div>
            <div class="form-row mb-2">
              <label for="Phone">Phone Number:</label>
              <input type="tel" class="form-control" id="Phone" name="Phone" pattern="^\d{10}$" placeholder="Enter your phone number" value="<?= $Phone ?>">
            </div>

            <?php
            if (isset($_GET["status"]) && ($_GET["status"] === "misMatch" || $_GET["status"] == "exists" || $_GET["status"] == "phoneformat")) :

              if ($_GET["status"] === "misMatch") {
                $MSG = "Inserted Emails are not identical";
              } elseif ($_GET["status"] == "exists") {
                $MSG = "This Email already has an account";
              } elseif ($_GET["status"] == "phoneformat") {
                $MSG = "Incorrect phone format";
              }
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $MSG ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>

            <?php endif; ?>

            <div class="form-row my-2 d-flex justify-content-end">
              <button type="submit" class="btn btn-default" id="btnSbmtSign">Set Password</button>

            </div>
          </div>
        </form>
      <?php endif; ?>
      <?php if (isset($_SESSION['userId']) && isset($_SESSION['usermail'])) : ?>
        <div class="loggedIn">
          <div>You are already logged in with Email: <strong><u><?= $_SESSION['usermail'] ?></strong></u>
            <br>
            <strong>Want to logout and create new account?</strong>

          </div>
          <div class="d-flex justify-content-between my-2">
            <a href="logout.php?page=signup"><button class=" btn btn-default">Log Out & Create account</button></a>
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
  <script src="scripts/general.js" type="text/javascript"></script>

</body>

</html>