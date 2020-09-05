<!-- <header>
        <div class="fixed-top">
            <nav class="navbar navbar-expand-lg navbar-light sticky-top"> -->

<a class="navbar-brand" href="index.php">
    <img src="images/post-it.png" class="img-fluid rounded mx-auto" width="30" height="30" alt="Petek">Petek</a>
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
        <?php if (!isset($_SESSION['userId'])): ?>
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
        <?php endif; ?>
        <?php if (isset($usermail) || isset($userId)): ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php active('index.php'); ?>" 
                href="#" id="navbarlists" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Lists
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="listsDrop">
                    <!-- user Lists-->
                    <span class="dropdown-item-text">Your Lists</span>
                    <!-- <h6 class="px-2" ></h6> -->
                    <div id="userLists"> </div>
                    <?php if (!is_null($familyId)): ?>
                    <div class="dropdown-divider"></div>
                    <!-- family lists ---->
                    <span class="dropdown-item-text">Family Lists</span>
                    
                    <div id="familyLists"> </div>
                    <?php endif; ?>
                </div>
            </li>
            <li class="nav-item">
            <a class="nav-link <?php active(
                'productsList.php'
            ); ?>" href="productsList.php">Products</a>
        </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php active(
                    'invites.php'
                ); ?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Family
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="FamilyDrop">
                    <!-- Family Actions-->

                   <?php 
            //if user doesn't belong to family
            
                   if (is_null($familyId)): ?>
                    <a class="dropdown-item" href="createFamily.php">| New family</a>
                    <a class="dropdown-item" href="sendRequest.php">| Request to join family</a>
                    <a class="dropdown-item" href="invites.php">| View family invitations </a>
                   <?php endif;
                   //if user belongs to family
                   if (!is_null($familyId)): ?>
                    <a class="dropdown-item <?php active('familyMembers.php'); ?>" href="familyMembers.php">| View members</a>
                    <a class="dropdown-item <?php active('invites.php'); ?>" href="invites.php">| Invite user to family</a>
                    <?php //if user is admin to family
                     if (!is_null($isAdmin) && $isAdmin===TRUE): ?>
                    <a class="dropdown-item <?php active('requests.php'); ?>" href="requests.php">| Join requests</a>
                   <?php endif;endif;
                   ?>
                    
                </div>
            </li>
        <?php endif; ?>
    </ul>

    <div class="container d-flex justify-content-end">
    <div class="toggle-container mx-2">
        <h10><i class="fas fa-adjust" title="Light/Dark"></i></h10>
        <input type="checkbox" id="switch" name="theme" title="Light/Dark"/><label for="switch">Toggle</label>
    </div>

    
    <?php if (isset($_SESSION['userId'])): ?>
        <span class="px-3">
            <a href="userChangePass.php"> <?=  $_SESSION['usermail'] ; ?> </a>
        </span>
                
       
            <a href="logout.php"><button class=" btn btn-default">Log Out</button></a>

       
    <?php else: ?>
           
            <span class=""><a href="login.php"> 
            <button class=" btn btn-default">Login</button></a></span>
            <span class="ml-2 "><a href="signup.php"> 
            <button class=" btn btn-default">Sign-up</button></a></span>
             
    <?php endif; ?>
    </div>

    <script>

function getCookie(name) {
    //alert('getting '+name)
     var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
     return v ? v[2] : null;
   // return 'dark';
}
    
function setCookie(name, value, days) {
        //alert('setting '+name+' with value: '+value)
    var d = new Date;
    d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
    document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
}

var checkbox = document.querySelector('input[name=theme]');
loadTheme();
checkbox.addEventListener('change', function() {
    trans()
    if (this.checked) {
        changeTheme('dark')
    } else {
        changeTheme( 'light')
    }
})


let trans = () => {
    document.documentElement.classList.add('transition');
    window.setTimeout(() => {
        document.documentElement.classList.remove('transition')
    }, 500)
}

function changeTheme(theme)
{
    document.documentElement.setAttribute('data-theme', theme)
    var checkbox = document.querySelector('input[name=theme]');
    checkbox.checked = 'dark'==theme;
    setCookie('Theme',theme,100);
}

function loadTheme()
{
    currentTheme = getCookie('Theme');
    changeTheme(currentTheme)
}


</script>

<!-- <script>
        // dark mode switch 2
        var setTheme = function(theme) {
            if (theme === 'dark') {
                // dark
                $("body").removeClass("standard");
                $("body").addClass("dark");
                $(".inner-switch").text("ON");
                setCookie('Theme', 'dark', 30);
            } else {
                $("body").removeClass("dark");
                $("body").addClass("standard");
                $(".inner-switch").text("OFF");
                setCookie('Theme', 'standard', 30);
            }
        };

        // if (isset($_COOKIE['Theme'])){
        //     currentTheme=$_COOKIE['Theme'];
        // }else{
        //     //current theme =light
        // }
        currentTheme = getCookie('Theme');
        setTheme(currentTheme);

        $(".inner-switch").on("click", function() {
            if ($("body").hasClass("dark")) {
                // standard
                setTheme('standard');
            } else {
                // dark mode
                setTheme('dark');
            }
        })
    </script> -->