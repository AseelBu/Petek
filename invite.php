<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once 'parts/headLinks.php'; ?>
  <title>Invite New User To Family</title>
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
    
    <?php if (isset($_GET['status']) && $_GET['status'] == 'newFamily'): ?>
            <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle"></i> Invite people to join your new family !
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['sent']) && $_GET['sent'] == 'yes'): ?>
            <div class="alert alert-success" role="alert">
            <i class="fas fa-check"></i> Your invitation sent successfully
            </div>
        <?php endif; ?>

      <h2><b>Invite User to your family</b></h2>

      <form class="align-middle " id="invite" method="POST" action="api/newInvite.php" >
        <div class="form-group col-md-12">
          <div class="form-row ">

            <label for="invitedInfo" class="">Who would you like to invite : </label>
            <input type="text" class="form-control" id="invitedInfo" name="invitedInfo" title="Start typing user's mail" placeholder="Email@Email.com" required>
            <div id="usersByMail" style="position:relative; width: auto;">
             <!--List of suggested users-->
            </div>

            <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
            <input type="hidden" name="familyId" value="<?= $familyId ?>">
            <input type="hidden" id="invitedId" name="invitedId" value="">

          </div>

          
          <div class="d-flex justify-content-between my-2">
          <span class="message" id="inviteMsg"></span>
            <input type="button" class="btn btn-default" id="btnSendInvite" value="Send">
            
          </div>
          <input type="submit" class="btn btn-default d-none" id="submitInvite" value="Send">
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