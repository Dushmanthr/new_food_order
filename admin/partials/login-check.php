<?php 
     // auhorization - access control
     //check whether user login or not
     if(!isset($_SESSION['user']))
     {
        //user is not logged in
        //redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error'>please login to access admin panel</div>";
        //redirect to login
        header('location:'.SITEURL.'admin/login.php');
     }
?>