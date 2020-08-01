<?php
session_start();
require_once 'db.php';

require_once 'parts/sessionCheck.php';

//is the user an admin
$sql = "SELECT `id` FROM `fadmin` WHERE `id`=$userId";
if (!$conn->query($sql)) {
    header('Location:../index.php?status=notAdmin');
    exit();
} 
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <?php require_once 'parts/headLinks.php'; ?>
    <title>Join Requests</title>

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

    <div class="container my-5 px-4 py-4 overflow-auto">
    <div class="table-responsive">
           
                <table class="table table-hover text-center shadow rounded" id="products">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Request Date</th>
                            <th scope="col">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <!--requests will show here-->

                    </tbody>


                </table>
           
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