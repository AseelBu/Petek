<!-- <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top"> -->

<a class="navbar-brand" href="index.php">
    <img src="images/post-it.png" class="img-fluid rounded mx-auto" width="30" height="30" alt="Sticky Note Icon">Petek</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse " id="navbarSupportedContent">
<?php function active($currect_page)
{
    $url_array = explode('/', $_SERVER['REQUEST_URI']);
    $url = end($url_array);
    if (strpos($url, '?')) {
        $url_array = explode('?', $url);
        $url = $url_array[0];
    }
    if ($currect_page == $url) {
        echo 'active'; //class name in css
    }
} ?>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
            <a class="nav-link <?php active(
                'index.php'
            ); ?>" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php active(
                'login.php'
            ); ?>" href="login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php active(
                'signup.php'
            ); ?>" href="signup.php">Sign Up</a>
        </li>
        <?php if (isset($usermail) || isset($userId)): ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php active(
                    'index.php'
                ); ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Lists
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="listsDrop">
                    <!-- user Lists-->
                </div>
            </li>
       
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php active(
                    'invite.php'
                ); ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Family
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="FamilyDrop">
                    <!-- Family Actions-->
                    <!--TODO check if the member is already part of family-->
                    <a class="dropdown-item" href="createFamily.php">| New family</a>
                    <a class="dropdown-item" href="familyMembers.php">| View members</a>
                    <a class="dropdown-item" href="invite.php">| Invite user to family</a>
                    <a class="dropdown-item" href="requests.php">| Join requests</a>
                    
                </div>
            </li>
        <?php endif; ?>
    </ul>


    <!-- <div class="d-flex justify-content-end">

                        <a href="login.php"><button class=" btn btn-default">Log Out</button></a>

                    </div>
                </div>
            </nav>
        </div>
    </header> -->