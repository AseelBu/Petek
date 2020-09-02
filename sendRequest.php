<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <?php require_once 'parts/headLinks.php'; ?>
  <title>Send Request To join Family</title>
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

            <?php if (
                isset($_GET['status']) &&
                $_GET['status'] == 'newUser'
            ): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Request to join family
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sent']) && $_GET['sent'] == 'yes'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check"></i> Your request sent successfully
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['sent']) && $_GET['sent'] == 'no'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="far fa-times-circle"></i> Your request failed to send because the family Name was invalid
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>e
                </button>
                </div>
                <?php endif; ?>

                   <?php if (is_null($familyId)): ?>
                    <h2><b>Request to join family</b></h2><br>
                        <form class="align-middle " id="sendRequest" method="POST" action="api/newRequest.php" >
                            <div class="form-group col-md-12">
                            <div class="form-row">
                                
                                <label for="familyName" class="">Type family name you would like to join : </label>
                                <input type="text" class="form-control " id="familyName" name="familyName" title="Start typing family name" placeholder="Family Name" required>
                                <div id="familySuggest" style="position:relative; width: auto;">
                                <!--List of suggested families-->
                                </div>

                            <!-- <span class="mt-2"> **People in: your family/has family/already been invited to your family,<br> can't be invited again</span> -->
                                <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
                               
                                <input type="hidden" id="familyId" name="familyId" value="">

                            </div>

                            
                            <div class="d-flex justify-content-between my-2 ">
                            <span class="message" id="requestMsg"></span>
                            <span>
                                <input type="button" class="btn btn-default" id="btnSendRequest" value="Send">
                                <?php if(isset($_GET['status']) && $_GET['status'] == 'newUser'): ?>
                           <a class="text-muted ml-3" href="index.php"> Skip </a>
                           <?php endif; ?>
                                </span>
                            </div>                         
                            <input type="submit" class="btn btn-default d-none" id="submitRequest" value="Send">                       
                            </div>
                        </form>
                 </div>
                   <?php else : 
                        header('Location:index.php?status=noAccess');
                        exit();
                    endif; ?>
                
        
        
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