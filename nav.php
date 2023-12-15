<?php
    if(isset($_SESSION['loggedin'])){
         echo "<li class='nav-item'><a class='nav-link login-link'href='#'> hi, ".$_SESSION['staffname']."</a></li>";
         echo "<li class='nav-item'><a class='nav-link login-link' href='logout.php'>logout</a></li>";
    }else{
        echo "<li class='nav-item'><a class='nav-link login-link' href='loginpage.php'>Login</a></li>";
             }

?>