<?php
include "connect.php";
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
    $navsql = "SELECT `username`,`name` FROM `users` WHERE `username` = '$username'";
    $navresult = $database->query($navsql);
    $navarray = $navresult->fetch_assoc();

}


?>
<nav>
    <div class="nav-wrapper green">
        <img src="img/logo.png" style="width: 200px;height: 55px" class="right">

        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">
            <li><a href="index.php">Home</a></li>
            <li><a href="info.php">Info</a></li>
            <?php if(isset($_SESSION['username'])){?>
                <li><a href="main.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php }
            else{?>
                <li><a href="login.php">Login</a></li>
                <li><a href="Register.php">Registreer</a></li>
            <?php }?>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a id="side-nav-clear"><i class="material-icons">menu</i></a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="info.php">Info</a></li>
            <?php if(isset($_SESSION['username'])){?>
                <li><a href="main.php">Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php }
            else{?>
                <li><a href="login.php">Login</a></li>
                <li><a href="Register.php">Registreer</a></li>
            <?php }?>
        </ul>
    </div>
</nav>


<div class="row">
    <img src="img/blieken01.jpg" style="width:100%">
</div>



<script> $(".button-collapse").sideNav();</script>
<script>$("#side-nav-clear").on("click", function() {
        $("#sidenav-overlay").trigger("click");
        return false;
    });</script>