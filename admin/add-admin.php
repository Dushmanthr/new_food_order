<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br/><br/>

        <?php
             if(isset($_SESSION['add'])){
               echo $_SESSION['add']; //displaying session message
               unset($_SESSION['add']); //removing session msg
             }
        ?>
 

        <form action = "" method = "POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value = "Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php
  include('partials/footer.php');
?>

<?php
   // process the value from form and save it uin database
   //check wheather the submit button is clicked or not

   if(isset($_POST['submit'])){
       //button clicked
      /*  echo 'button clicked'; */

      //Get the data from form
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = md5($_POST['password']);  //password encryption with md5

      //sql query to save the data into database

      $sql = "INSERT INTO tbl_admin SET 
      full_name = '$full_name',
      username = '$username',
      password = '$password'
      ";

      //executing query and saving data in to database
      $res = mysqli_query($conn, $sql) or die(mysqli_error());


      //check wheather the (query is executed) data is inserted or not and display appropriate msg

      if($res==TRUE){
          //data inserted
          //echo 'inserted';
          //create session variable to display message
         $_SESSION['add'] = "<div class = 'success'>Admin Added successfully.</div>";
          //redirect page to manage admin
          header("location:" . SITEURL . "admin/manage-admin.php ");
      }
      else{
          //failed to insert
            //echo 'failed to insert';
           //create session variable to display message
           $_SESSION['add'] = "<div class = 'error'>Failed to add admin.</div>";
           //redirect page to manage admin
           header("location:" . SITEURL . "admin/add-admin.php");
      }


   }
  
?>