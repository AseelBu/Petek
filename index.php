<?php
session_start();
require_once 'db.php';

$usermail = null;
if (isset($_SESSION['usermail'])) {
    $usermail = $_SESSION['usermail'];
} elseif (isset($_COOKIE['usermail'])) {
    $usermail = $_COOKIE['usermail'];
}

$password = null;
if (isset($_SESSION['password'])) {
    $password = $_SESSION['password'];
} elseif (isset($_COOKIE['password'])) {
    $password = $_COOKIE['password'];
}

$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;

$listId = null;

if (isset($_POST['email'])) {
    $usermail = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT  `id`,`pswrd` FROM `users` where `email` like '$usermail'";
    $result = $conn->query($sql);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        //login successfull
        if (strcmp($row['pswrd'], $password) === 0) {
            $_SESSION['usermail'] = $usermail;
            $_SESSION['password'] = $password;
            // setcookie('id', $row['id'], time() + (60 * 60 * 24 * 15));
            $_SESSION['userId'] = $row['id'];

            $userId = $row['id'];
            if ($_POST['chkRememberMe'] == 'remember') {
                //stay logged in for 15 days
                setcookie('usermail', $usermail, time() + 60 * 60 * 24 * 15);
                setcookie('password', $password, time() + 60 * 60 * 24 * 15);
            } else {
                if (isset($_COOKIE['usermail'])) {
                    unset($_COOKIE['usermail']);
                    setcookie('usermail', $usermail, time() - 60 * 60 * 24);
                }
                if (isset($_COOKIE['password'])) {
                    unset($_COOKIE['password']);
                    setcookie('password', $password, time() - 60 * 60 * 24);
                }
            }
        } else {
            //failed to login- wrong password
            header('Location:login.php?status=wrongpassword');
            exit();
        }
    } else {
        //failed to login-wrong email
        header('Location:login.php?status=wrongemail');
        exit();
    }

    // update login date
    $sql="UPDATE `users` SET `lastLogin`=now()  WHERE `id`= $userId ";
    $conn->query($sql);

    
}
require_once('parts/sessionCheck.php');
if (
    is_null($userId) ||
    !isset($_SESSION['usermail']) ||
    !isset($_SESSION['password'])
) {
    header('Location:login.php?status=showMsg');
    exit();
} else {
    if (isset($_GET['listId'])) {

      require_once 'parts/isList4User.php';

    } elseif (
        isset($_COOKIE['listId']) &&
        isset($_GET['status']) &&
        $_GET['status'] == 'noAccess'
    ) {
        $listId = $_COOKIE['listId'];
    } else {
       require_once 'parts/getMostRecentList.php';
    }
}

if (is_null($listId)) {
    $listName = "You don't have lists yet!";
}
//user chose to view old list
else {
    $sql = "SELECT `name` FROM `list` where `id`=$listId";
    $result = $conn->query($sql);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $listName = $row['name'];
    }
}

?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <?php require_once 'parts/headLinks.php'; ?>
    <title>Grocery Lists</title>

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


  

    <div id="app">
    <div class="container my-5 px-4 py-4 overflow-auto">
        <?php if (isset($_GET['status']) && $_GET['status'] == 'noAccess'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                You are not authorized to access the requested page!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php
      if (isset($_GET["status"]) && $_GET["status"] == "passwordChanged") : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          password changed succefully :)
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
      <?php endif; ?>
        <?php if (isset($_GET['status']) && $_GET['status'] == 'noProducts'): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                The List you chose doesn't have any products
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="container row d-flex justify-content-between">

            <span class="col-sm-6">
                <?php if (isset($listName)): ?>
                <h2 id="id=" listName><?= $listName ?></h2>
                <?php endif; ?>
            </span>
            <div class="container d-flex justify-content-end col-sm-12 ">
                <?php if (!is_null($listId)): ?>
                    <button type="button" data-toggle="modal" data-target="#modalNewProduct" id="btnNP" class="btn btn-default mx-1 col-sm-3 my-1"><i class="fas fa-plus"></i> New
                        Product </button>
                <?php endif; ?>
                <button type="button" data-toggle="modal" data-target="#modalNewList" id="btnNewList" class="btn btn-default mx-1 my-1  col-sm-3"><i class="fas fa-folder-plus"></i> New List
                </button>

            </div>

        </div>
        <br>
        <div id="listTable">
        <div class="table-responsive">
            <?php if (!is_null($listId)): ?>
                <table class="table table-hover text-center shadow rounded" id="products">
                    <thead>
                        <tr>
                            <th v-for="title in titles" scope="col">{{title}}</th>
                            
                        </tr>
                    </thead>
                    <tbody id="uncheckedRows">
                        <!--unchecked products will go here-->
                        <!-- <tr v-for="product in uncheckedrows" class="unchecked" v-bind:data-id="product.id"> 
                            <td class="btnDone">
                            <input type="checkbox" class="btnDone"></td>
                            <td class="name"> {{product.name}}</td>
                            <td class="amount">{{product.amount}}</td>
                            <td>
                                <a href="#" class="btnRemove">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                            </tr> -->
                            <tr v-if="productName" class="unchecked" > 
                            <td class="btnDone">
                            <input type="checkbox" class="btnDone"></td>
                            <td class="name"> {{productName}}</td>
                            <td class="amount">{{productAmount}}</td>
                            <td>
                                <a href="#" class="btnRemove">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                            </tr>
                    </tbody>

                    <tbody id="checkedRows">
                        <!--checked products will go here-->
                        <!-- <tr v-for="product in checkedrows" class="checked" v-bind:data-id="product.id"> 
                            <td class="btnDone">
                            <input type="checkbox" class="btnDone"></td>
                            <td class="name"> {{product.name}}</td>
                            <td class="amount">{{product.amount}}</td>
                            <td>
                                <a href="#" class="btnRemove">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                            </tr> -->
                    </tbody>

                </table>
            <?php endif; ?>
        </div>
            </div>
    </div>
    <!-- hidden input -->
    <input  type="hidden" id="userId" name="userId" value="<?= $userId ?>">
    <input  type="hidden" id="familyId" name="familyId" value="<?= $familyId ?>">
    <input  type="hidden" id="listIdIndex" name="listIdIndex" value="<?= $listId ?>">

    <?php require 'parts/footer.php'; ?>

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


    <!-- new product modal -->
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
                    <form id="addProduct">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="prdctName" class="">Name*: </label><br>
                                    <input  v-model="productName" type="text" name="prdctName" id="prdctName" class="form-control" placeholder="Product Name" aria-describedby="helpId" required>
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
                                        </label>
                                        <br>
                                    </div>
                                </div>

                                <div class="col-md-12 amount">
                                    <br>
                                    <label for="prdctAmount" class="">Amount: </label><br>
                                    <input v-model="productAmount" type="number" id="prdctAmount" class="form-control" name="prdctAmount" min="1" max="100" value="1" aria-describedby="helpId" />

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


    <!--new List modal-->
    <div class="modal fade " tabindex="-1" role="dialog" id="modalNewList">
        <div class="modal-dialog " role="document">
            <div class="modal-content main">
                <div class="modal-header">
                    <h5 class="modal-title">New List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addList" method="POST" action="api/newList.php">
                        <div class="form-group">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="listName" class="">List Name*: </label>
                                    <input type="text" name="listName" id="listName" class="form-control " placeholder="List Name" aria-describedby="helpId" required>
                                </div>
                            </div>
                            <?php if(isset($familyId)&& !is_null($familyId)): ?>
                            <div  class="form-group ">
                                <div class="col-md-12">
                                <div class="form-check form-check-inline ">
                                    <input type="radio" id="privateChk" class="form-check-input" name="privacy" value="private" title="Choose this if you want to keep list private" checked>
                                    <label for="privateChk" class="form-check-label" >
                                        Private list</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" id="familyChk" class="form-check-input" name="privacy" value="family" title="Choose this if you want to share list with family">
                                    <label for="familyChk" class="form-check-label" >
                                        Family list</label>
                                </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="form-group ">
                                <div class="col-md-12">

                                    <div class="form-check">
                                        <input type="checkbox" id="oldListChkBox" class="form-check-input " name="oldListChkBox" value="on" >
                                        <label for="oldListChkBox" class="form-check-label">Add all Products from old list
                                        </label>
                                        <br>
                                    </div>
                                </div>

                                <div class="col-md-12 form-group" id="oldList">
                                    <br>
                                    <label for="oldListSelect" class="">Choose list to import products: </label><br>
                                    <select class="form-control" id="oldListSelect" name="oldListSelect"></select>
                                </div>
                            </div>

                        </div>
                        <div class="row my-3">
                            <button type="submit" class="btn btn-default d-none" id="submitList">Add List</button>
                        </div>

                    </form>


                </div>
                <div class="d-flex justify-content-end modal-footer">
                    <span class="message" id="modalMsgList"></span>

                    <button type="button" class="btn btn-default" id="btnAddList">Add List</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>

    </div>

            </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="scripts/list_script.js"></script>
    <script src="scripts/general.js"></script>
    <script>
    new Vue({
      el: "#app",
      data() {
       
            productName : "",
            productAmount :  ""
    
            }
    
    });
  </script> 

    <?php $conn->close(); ?>
</body>

</html>