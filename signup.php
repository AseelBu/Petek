<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
  <!--font-->
  <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/stylesheet.css">
  <title>Sign-up !</title>
</head>

<body>
  <header>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light">
        <?php require "header.php"; ?>
        <div class="d-flex justify-content-end">

          <a href="login.php"><button class=" btn btn-default">Login</button></a>

        </div>
    </div>
    </nav>
    </div>
  </header>
  <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">
    <div class="py-3 px-3 shadow main" id="signUp">

      <h2><b>Sign-Up</b></h2>
      <p>Create new account</p>

      <form id="SignUpFrm" method="POST" action="insertUser.php">
        <div class="form-group col-12">
          <div class="form-row">
            <label for="Email">Email:*</label>
            <input type="email" class="form-control" id="Email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email@Email.com" required>
          </div>

          <div class="form-row">
            <label for="Email-confirm"> Email confirm:*</label>
            <input type="email" class="form-control" id="Email-confirm" name="Email-confirm" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Repeat email" required>
          </div>

          <div class="form-row">
            <label for="Nickname"> Nickname:</label>
            <input type="text" class="form-control" id="Nickname" name="Nickname" placeholder="Enter nickname">
          </div>
          <div class="form-row mb-2">
            <label for="Phone">Phone Number:</label>
            <input type="tel" class="form-control" id="Phone" name="Phone" pattern="^\d{10}$" placeholder="Enter your phone number">
          </div>
          <span id="signUpValditionMsg" class="message "></span>
          <div class="form-row my-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-default" id="btnSbmtSign">Next</button>
            <a href="setPassword.php" id="toPasswordLink"></a>
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
  <script src="scripts/general.js" type="text/javascript"></script>

</body>

</html>