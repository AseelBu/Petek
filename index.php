<?php
session_start();
require_once('db.php');

$usermail = isset($_SESSION['usermail']) ? $_SESSION['usermail'] :
    isset($_COOKIE['usermail']) ? $_COOKIE['usermail'] : null;

$password = isset($_SESSION['password']) ? $_SESSION['password'] :
    isset($_COOKIE['password']) ? $_COOKIE['password'] : null;

$id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if (isset($_POST["email"])) {
    $usermail = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['Password']);

    $sql = "SELECT  `id`,`pswrd` FROM `users` where `email` like '$usermail'";
    $result = $conn->query($sql);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        //login successfull
        if (strcmp($row['pswrd'], $password) === 0) {
            $_SESSION['usermail'] = $usermail;
            $_SESSION['password'] = $password;
            $_SESSION['id'] = $row['id'];
            if ($_POST['chkRememberMe'] == 'remember') {
                setcookie('usermail', $usermail, time() + (60 * 60 * 24 * 15));
                setcookie('password', $password, time() + (60 * 60 * 24 * 15));
            }
        } else { //failed to login- wrong password
            header("Location:login.php?status=wrongpassword");
            exit();
        }
    } else { //failed to login-wrong email
        header("Location:login.php?status=wrongemail");
        exit();
    }
}
if (is_null($usermail)) {
    header("Location:login.php?status=showMsg");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grocery Lists</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <!--font-->
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/stylesheet.css">

</head>

<body>
    <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top">
                <?php require "header.php"; ?>
                <div class="d-flex justify-content-end">

                    <a href="logout.php"><button class=" btn btn-default">Log Out</button></a>

                </div>
        </div>
        </nav>
        </div>
    </header>

    <div class="container my-5 px-4 py-4 overflow-auto">

        <div class="container row d-flex justify-content-between">
            <!-- <span class="col-sm-6" >
                <h2 id="List-Name"><!--List Name-for Later</h2>-->
            <!-- </span> -->
            <div class="container d-flex justify-content-end col-sm-12 ">
                <button type="button" data-toggle="modal" data-target="#modalNewProduct" id="btnNP" class="btn btn-default mx-1 col-sm-3 my-1"><i class="fas fa-plus"></i> New
                    Product </button>
                <!-- <button type="button" data-toggle="modal" data-target="#modalNewList" id="btnNewList"
                    class="btn btn-default mx-1 my-1  col-sm-3"><i class="fas fa-folder-plus"></i> New List
                </button> -->
                <button type="button" id="btnNewList" class="btn btn-default mx-1 my-1  col-sm-3">
                    <i class="fas fa-folder-plus"></i> New List
                </button>
            </div>
            <!--<button type="button" id="btnNP" class="btn btn-outline-warning"><i class="fas fa-plus"> New
                    Product</i></button>-->
        </div>
        <br>

        <div class="table-responsive">

            <table class="table table-hover text-center shadow rounded" id="products">
                <thead>
                    <tr>
                        <th scope="col">Done</th>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="uncheckedRows">
                    <!--unchecked products will go here-->
                </tbody>
                <tbody id="checkedRows">
                    <!--checked products will go here-->
                </tbody>


            </table>
        </div>

    </div>

    <?php require "footer.php"; ?>

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
                    <p>You are about to delete </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnRemoveConfirm btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="modalNewProduct">
        <div class="modal-dialog " role="document">
            <div class="modal-content main">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addProduct" >
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="prdctName" class="">Name*: </label><br>
                                    <input type="text" name="prdctName" id="prdctName" class="form-control" placeholder="Product Name" aria-describedby="helpId" required>
                                    <div id="menu-container" style="position:relative; width: auto;">
                                        <!--List of suggested products-->
                                    </div>

                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-check">
                                        <input type="checkbox" id="amountChkBox" class="form-check-input " name="amountChkBox" aria-describedby="helpId">
                                        <label for="amountChkBox" class="form-check-label">Choose Product Amount
                                        </label><br>
                                    </div>
                                </div>

                                <div class="col-md-12 amount">
                                    <br>
                                    <label for="prdctAmount" class="">Amount: </label><br>
                                    <input type="number" id="prdctAmount" class="form-control" name="prdctAmount" min="1" max="100" value="1" aria-describedby="helpId" />

                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col">
                                    <button type="submit" class="btn btn-default d-none" id="submitProduct">Add
                                        Product</button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
                <div class="d-flex justify-content-between modal-footer">
                    <span class="message" id="modalMsg"></span>
                    <span class="goodMessage" id="modalGoodMsg"></span>
                    <span>
                        <button type="button" class="btn btn-default" id="modalAddProduct">Add Product</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </span>
                </div>
            </div>
        </div>

    </div>

    <!--new List modal-for later-->
    <!-- <div class="modal fade" tabindex="-1" role="dialog" id="modalNewList">
        <div class="modal-dialog " role="document">
            <div class="modal-content main">
                <div class="modal-header">
                    <h5 class="modal-title">New List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addList">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="listName" class="">List Name: </label><br>
                                    <input type="text" name="listName" id="listName" class="form-control"
                                        placeholder="List Name" aria-describedby="helpId" required>
                                </div>
                            </div>
                            <div class="row my-3">
                                <button type="submit" class="btn btn-default d-none" id="submitList"></button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="d-flex justify-content-end modal-footer">


                    <button type="button" class="btn btn-default" id="btnAddList">Add List</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>

    </div> -->



    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="scripts/list_script.js"></script>
    <script src="scripts/general.js"></script>

    <?php $conn->close(); ?>
</body>

</html>