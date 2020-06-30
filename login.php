<!DOCTYPE html>
<html lang="en">

</html>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <link rel="stylesheet" href="styles/stylesheet.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

  <!--font-->
  <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@500&display=swap" rel="stylesheet">

  <title>Login</title>
</head>

<body>
  <header>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <?php require "header.php"; ?>
        <div class="d-flex justify-content-end">

          <a href="signup.php"> <button class=" btn btn-default">Sign-up</button></a>

        </div>
    </div>
    </nav>
    </div>
  </header>

  <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">

    <div class="py-3 px-3 shadow main" id="Login">
      <h2><b>Login</b></h2>

      <form class="align-middle " id="loginFrm" novalidate>
        <div class="form-group col-md-12">
          <div class="form-row">
            <label for="email" class="">Enter Email: </label>
            <input type="email" class="form-control" id="EmailLogin" name="email" placeholder="Email@Email.com" required>
          </div>

          <br>
          <div class="form-row">
            <label for="Password" class="">Enter Password: </label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder=" Enter Password" required>
          </div>

          <div class="form-check form-row">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="chkRememberMe" id="chkRememberMe" value="checkedValue" checked>
              Remember Me
            </label>
          </div>



          <br>
          <span class="psw"> <a href="resetPassword.php">Forgot password?</a></span>
          <br>
          <span class="signup">Dont have an acount? <a href="signup.php">Sing Up</a></span>

          <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-default" value="Login">
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