<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';

// $isAdmin = false;
if (is_null($familyId)) {
    header('Location:../index.php?status=noFamily');
    exit();
}
// $sql = "SELECT `id` FROM `fadmin` WHERE `id`=$userId";
// if ($conn->query($sql)) {
//     $isAdmin = true;
// }
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

    <head>
        <?php require_once 'parts/headLinks.php'; ?>
        <title>Family Members</title>

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

    <div id="v-members">
        <div class="container my-5 px-4 py-4 overflow-auto">
            <div class="my-5"><h2>Family Members</h2></div>

            
                <div v-if="empty===false" class="table-responsive mt-4">
                    <table class="table table-hover  text-center shadow rounded" id="members">
                        <thead>
                            <tr>
                                <th scope="col">Email</th>
                                <th scope="col">Nickname</th>
                                <!-- <th scope="col">Joining Date</th> -->
                               <?php if (!is_null($isAdmin) && $isAdmin): ?>
                                <th scope="col">Actions</th>
                               <?php endif;?>
                            </tr>
                        </thead>
                        <tbody>
                            <!--members will show here-->
                            <tr v-for="m in members" v-bind:data-id="m.id">
                                <td class="email"><b>{{m.email}}</b></td>
                                <td class="nickname ml-3" ><b>{{m.nickname}}</b></td>
                            <?php if (!is_null($isAdmin) && $isAdmin): ?>
                                <td class="actions ml-3">
                            
                                    <span v-if="m.isAdmin === false">
                                        <a @click="showRemoveModal">
                                        <button  type="button" class="btn btn-danger btnRemoveMember"> <i class="fas fa-user-times"></i> Remove from family</button>
                                        </a>
                                    </span>
                                </td>
                            <?php endif;?>
                            </tr>
                                
                        </tbody>
                    </table>
                </div>
                <div v-else-if="empty === true" class="" id="msgNoMembers">
                    <h4>Your family doesn't have any members yet<h4>
                </div>
                    
                    <input type="hidden" id="userId" name="userId" value="<?= $userId ?>">
                    <input type="hidden" id="isAdmin" name="isAdmin" value="<?= $isAdmin ?>">
                    <input type="hidden" id="familyId" name="familyId" value="<?= $familyId ?>">
            
                                
            </div>
        </div>
                <!-- modal confirm removal -->
                <div class="modal fade remove " tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content main">
                            <div class="modal-header">
                                <h5 class="modal-title">Are you sure?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p > <!--warning msg--></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn  btn-danger" id="removeMember">Delete</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
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