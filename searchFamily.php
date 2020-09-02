<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <?php require_once 'parts/headLinks.php'; ?>
  <title>Search Family</title>
</head>

<body>
  <header>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <?php require 'parts/header.php'; ?>
        
    </div>
    </nav>
    </div>
  </header>

  <div class="container  my-5 px-4 py-4 d-flex justify-content-center overflow-auto">

    <div class="py-3 px-3 shadow main" id="newUser">
      <h2><b>Choose the family <br>you would like to join</b></h2>

      <form class="align-middle " id="newUserFrm" method="POST" action="api/newInvite.php" >
        <div class="form-group col-md-12">
          <div class="form-row ">

            <label for="familyName" class="">Enter family name : </label>
            <input type="text" class="form-control" id="familyName" name="familyName" title="Family Name" placeholder="Family Name" required>
            <div id="usersByMail" style="position:relative; width: auto;">
             <!--List of suggested users-->
            </div>

            <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
            <input type="hidden" name="familyId" value="<?= $familyId ?>">
            <input type="hidden" id="invitedId" name="invitedId" value="">

          </div>


          <div class="d-flex justify-content-end my-2">
            <input type="submit" class="btn btn-default" id="btnSendReset" value="Send">
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