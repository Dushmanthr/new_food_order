<?php

    include('../config/constants.php');

     //1. get the id of admin to be deleted

     $id = (isset($_GET['id']) ? $_GET['id'] : '');

     //2. create sql query to delete admin

     $sql = "DELETE FROM tbl_admin WHERE id='$id'  ";

     //Execute the query

     $res = mysqli_query($conn, $sql);

     //check wheather the query successfully executed or not
     if($res==TRUE){
         //query executed successfully and admin deleted
         //create session variable to display message

         $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";

         //Redirect to manage admin page
         header('location:'. SITEURL. 'admin/manage-admin.php');

     }
     else{
         //failed to delete admin
         //echo 'failed to delete admin' .  mysqli_error($conn);
         $_SESSION['delete'] = "<div class = 'error'>Failed to delete admin. Try again Later</div>";

         //Redirect to manage admin page
         header('location:'. SITEURL. 'admin/manage-admin.php');
     }

     // 3. redirect to manage admin page with message(success/error)

     

?>