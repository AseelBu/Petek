<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once('parts/headLinks.php'); ?>

  <title>Reset Password</title>
</head>

<body>
  <header>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <?php require "parts/header.php"; ?>
        <div class="container d-flex justify-content-end">
          <span>
            <span class="col-6 "><a href="login.php"> <button class=" btn btn-default">Login</button></a></span>
            <span class="col-6 "><a href="signup.php"> <button class=" btn btn-default">Sign-up</button></a></span>
          </span>

        </div>
    </div>
    </nav>
    </div>
  </header>

  <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">

    <div class="py-3 px-3 shadow main" id="Login">
      <h2><b>Reset Password</b></h2>

      <form class="align-middle " id="resetPassFrm" action="login.php">
        <div class="form-group col-md-12">
          <div class="form-row ">

            <label for="email" class="">Enter your rigestered Email*: </label>
            <input type="email" class="form-control" id="EmailLogin" name="email" placeholder="Email@Email.com" required>
          </div>


          <div class="d-flex justify-content-end my-2">
            <input type="submit" class="btn btn-default" id="btnSendReset" value="Send">
          </div>




        </div>
      </form>
    </div>
  </div>

  <?php require('parts/footer.php'); ?>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="scripts/general.js"></script>
</body>

</html>