<?php
session_start();
require_once 'db.php';

$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$familyId = null;

if (!is_null($userId)) {
    $sql = "SELECT `familyId` 
  FROM `users` 
  WHERE `id`=$userId";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $familyId = $row['familyId'];
    }else{
      console.log("error finding user's family or user doesn't have family");
    }
}
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
      <nav class="navbar navbar-expand-lg navbar-light">
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
      <h2><b>Invite User to your family</b></h2>

      <form class="align-middle " id="newUserFrm" method="POST" action="api/newInvite.php" >
        <div class="form-group col-md-12">
          <div class="form-row ">

            <label for="invitedInfo" class="">Who would you like to invite : </label>
            <input type="invitedInfo" class="form-control" id="invitedInfo" name="invitedInfo" title="Start typing user's mail" placeholder="Email@Email.com" required>
            <div id="usersByMail" style="position:relative; width: auto;">
             <!--List of suggested users-->
            </div>

            <input type="hidden" id="userIdIndex" name="senderId" value="<?= $userId ?>">
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