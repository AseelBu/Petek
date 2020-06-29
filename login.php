<!DOCTYPE html>
<html lang="en">

</html>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


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
        <a class="navbar-brand" href="#"> <img src="images/post-it.png" class="img-fluid rounded mx-auto" width="30"
            height="30" alt="Sticky Note Icon">Petek</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="#">Home </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Sign-up</a>
              </li> -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Lists
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">List 1</a>
                  <a class="dropdown-item" href="#">List 2</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li> -->

          </ul>
          <div class="d-flex justify-content-end">

            <a href="signup.html"> <button class=" btn btn-default">Sign-up</button></a>

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
            <input type="email" class="form-control" id="EmailLogin" name="email" placeholder="Email@Email.com"
              required>
          </div>

          <br>
          <div class="form-row">
            <label for="Password" class="">Enter Password: </label>
            <input type="password" class="form-control" id="Password" name="Password" placeholder=" Enter Password"
              required>
          </div>

          <div class="form-check form-row">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="chkRememberMe" id="chkRememberMe"
                value="checkedValue" checked>
              Remember Me
            </label>
          </div>



          <br>
          <span class="psw"> <a href="resetPassword.html">Forgot password?</a></span>
          <br>
          <span class="signup">Dont have an acount? <a href="signup.html">Sing Up</a></span>

          <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-default" value="Login">
          </div>

        </div>
      </form>
    </div>
  </div>

  <footer class="page-footer">

    <div class="container ">
      <div class="container d-flex justify-content-center row mt-2 pt-2">
        <div class=" col-sm-6 col-md-4 mb-4 ">
          <!--Image-->
          <div class="images">
            <img src="https://www.popsci.com/sites/popsci.com/files/images/2019/07/adobestock_97901962.jpg"
              class="img-fluid" alt="baget image">

          </div>
        </div>
        <div class="d-flex justify-content-center col-sm-6 col-md-4 mb-4 ">
          <div class="images">
            <img src="https://static.bangkokpost.com/media/content/dcx/2019/12/19/3456399.jpg" class="img-fluid"
              alt="phone image">

          </div>
        </div>
        <div class="d-flex justify-content-end col-sm-6 col-md-4 mb-4">
          <!--Image-->

          <div class="images">
            <img
              src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ_6ScpEHpZRH2Owiz2I3h0RxM6RALeQ62AzWntkoG3RBda2BAJ&usqp=CAU"
              class="img-fluid" alt="basket image">

          </div>
        </div>
      </div>
    </div>

    <div class="footer-copyright text-center py-3">©️ 2020 Copyright:Aseel & Amneh</div>

  </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="scripts/general.js"></script>
</body>

</html>