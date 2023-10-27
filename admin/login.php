
<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food order system</title>
        <link rel="stylesheet" href="../css/admin.css">

    </head>
    <body>
    <style>
body {
  background-image: url('../images/bg5.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>

        <div class="login" >
        <h1 class="text-center">Login</h1>

        <?php
            if(isset($_SESSION['login'])) 
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']); 
            }
        ?>
        <br><br>
    <!-- login start from here -->
    <center>
    <form class="form" action="login.php" method="post" >
        Username: 
        <input type="text" name="username" placeholder="Enter Username"> <br><br>
        <br>
        Password: 
        <input type="password" name="password" placeholder="Enter your password"> <br><br>
        
        
        <input style = "border-radius:20px; width:60px;" type="submit" name="submit" value="login" class="btn-primary">
        <input style = "border-radius:20px;  width:60px;" type="submit" name="submit" value="cancel" class="btn-primary">
    </form> <br>
    </center>
    <!-- login end from here -->
       <!--  <p class="text-">created by - <a href="www.google.com">yuwantha</a> </p>
        </div> -->

        
    </body>
</html>



<?php 
     /* session_start(); */

    //include('config.php');

    //check whether submit buuton click
    if(isset($_POST['submit'])) {
        // process form data
        // 1. Data for login
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        "Username: " . $username . "<br>";
         "Password: " . $password . "<br>";

         //2. sqql to check whether username or paswword exits
         $sql = "SELECT * from tbl_admin WHERE username= '$username' AND password ='$password'";

         // Establish a database connection
        //$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

         //3.Execute the query
         $res = mysqli_query($conn, $sql);

         //4.count the rows to check whether user available or not
         $count = mysqli_num_rows($res);

         if ($count == 1) {
            // User available and successful login
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; // to check user log in or not and log will unset it
            // Redirect to home page
            header('location: ' . SITEURL . 'admin/index.php');
        } else {
            // User not available or incorrect credentials
            $_SESSION['login'] = "<div class='error text-center</enter>'>Username or password did not match.</div>";
            // Redirect to home page
            header('location: ' . SITEURL . 'admin/login.php');
        }

        // Close the database connection
        mysqli_close($conn);

        
         

    }

?>