<?php
session_start();
require_once 'db.php';

$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$familyId = isset($_SESSION['familyId']) ? $_SESSION['familyId'] : null;

//check that the user doesn't have a family already
if(!is_null($familyId)){
    header('Location:index.php?status=hasFamily');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'parts/headLinks.php'; ?>
  <title>Create Family</title>
</head>

<body>
  <header>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <?php require 'parts/header.php'; ?>
        <div class="d-flex justify-content-end">
            <a href="logout.php"><button class=" btn btn-default">Log Out</button></a>
         </div>
    </div>
    </nav>
    </div>
  </header>

  <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">

    <div class="py-3 px-3 shadow main" id="newUser">
      <h2><b>Create new family:</b></h2>

      <form class="align-middle " id="newUserFrm" method="POST" action="api/newFamily.php" >
        <div class="form-group col-md-12">
          <div class="form-row ">

            <label for="familyName" class="">Enter your family Name: </label>
            <input type="text" class="form-control" id="familyName" name="familyName" title="Enter family Name" placeholder="Family name" required>
            <div id="usersByMail" style="position:relative; width: auto;">
             
            </div>

            <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
            <input type="hidden" id="invitedId" name="invitedId" value="">

          </div>


          <div class="d-flex justify-content-end my-2">
            <input type="submit" class="btn btn-default" id="btnSendReset" value="Create Family">
          </div>

        </div>
      </form>
    </div>
  </div>

  <?php require_once 'parts/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="scripts/general.js"></script>
 
</body>
<?php $conn->close(); ?>
</html>