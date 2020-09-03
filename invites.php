<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <?php require_once 'parts/headLinks.php'; ?>
  <title>Invite New User To Family</title>
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
                $_GET['status'] == 'newFamily'
            ): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle"></i> Invite people to join your new family !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sent']) && $_GET['sent'] == 'yes'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check"></i> Your invitation sent successfully
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['sent']) && $_GET['sent'] == 'no'): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="far fa-times-circle"></i> Your invitation failed to send because the inserted Email was invalid
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <?php endif; ?>

                <!-- tabs  -->
                <!-- <ul class="nav nav-tabs" id="inviteTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="send-tab" data-toggle="tab" href="#sendInvite" role="tab" aria-controls="send" aria-selected="true">
                        New Invite
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="view-tab" data-toggle="tab" href="#viewInvite" role="tab" aria-controls="view" aria-selected="false">
                        View Invites
                        </a>
                    </li>
                    
                </ul> -->
                <!-- <div class="tab-content" id="inviteTabContent">
                    <div class="tab-pane fade show active py-3 px-2 border border-top-0" id="sendInvite" role="tabpanel" aria-labelledby="send-tab"> -->
                   <?php if (!is_null($familyId)): ?>
                    <h2><b>Invite User to your family</b></h2><br>
                        <form class="align-middle " id="invite" method="POST" action="api/newInvite.php" >
                            <div class="form-group col-md-12">
                            <div class="form-row ">

                                <label for="invitedInfo" class="">Who would you like to invite** : </label><br>
                                <input type="text" class="form-control " id="invitedInfo" name="invitedInfo" title="Start typing user's mail" placeholder="Email@Email.com" required>
                                <div id="usersByMail" style="position:relative; width: auto;">
                                <!--List of suggested users-->
                                </div>

                            <span class="mt-2"> **People in: your family/has family/already been invited to your family,<br> can't be invited again</span>
                            <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
                                <input type="hidden" id="familyId" name="familyId" value="<?= $familyId ?>">
                                <input type="hidden" id="invitedId" name="invitedId" value="">

                            </div>

                            
                            <div class="d-flex justify-content-between my-2 ">
                            <span class="message" id="inviteMsg"></span>
                                <input type="button" class="btn btn-default" id="btnSendInvite" value="Send">
                                
                            </div>
                            <input type="submit" class="btn btn-default d-none" id="submitInvite" value="Send">
                            </div>
                        </form>
                    <!-- </div> -->
                    <?php else :?>
                    <!-- View Invites if user doesn't have family-->
                    <!-- <div class="tab-pane fade" id="viewInvite" role="tabpanel" aria-labelledby="view-tab"> -->
                    <h2><b>Family Invitations</b></h2><br>

                    <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
                    
                <input type="hidden" id="familyId" name="familyId" value="<?= $familyId ?>">
                                

                        <div class="table-responsive" id="viewInvites">
                
                            <table class="table table-hover text-center shadow rounded" id="invites">
                                <thead>
                                    <tr>
                                        <th scope="col"><big>Sender</big></th>
                                        <th scope="col" class="ml-3"><big>Family name</big></th>
                                        <th scope="col" class="ml-3"><big>Actions</big></th>
                                        
                                    </tr>
                                </thead>
                                <tbody >
                                    <!--invites will go here-->
                                    
                                </tbody>


                            </table>
                            <div class="d-none" id="msgNoInvites">
                                <h4>You don't have any invitations<h4>
                            </div>
                        </div>
                    
                    <!-- </div> -->

                </div>
                    
                    <?php endif; ?>
                
            
                    
                <!-- <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
                </ul> -->
    
    
        <!-- </div> -->
        
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