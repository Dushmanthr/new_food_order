<?php

//include constant page
include("../config/constants.php");

if(isset($_GET['id']) && isset($_GET['image_name'])){
        //process to delete

       // echo "Process to delete";

      
       //1.Get id and image name

       $id = $_GET['id'];
       $image_name = $_GET['image_name'];


       //2.remove the image if available
       //check whether the image is available or not and delete only if available
       if($image_name != ""){
           //it has image and need to remove from folder
           //get the image path

           $path = "../images/food/".$image_name;

           //remove image file from folder
           $remove = unlink($path);
 
           //check wheather the image is removed or not
           if($remove==false){
               //failed to remove
               $_SESSION['upload'] = "<div class='error'>Failed to remove image file</div>";
            
            //redirect to manage food
            header('location:'. SITEURL.'admin/manage-food.php');

            //stop the process of deleteing food
            die();

        }
       }

       //3.delete food from database
       $sql = "DELETE FROM tbl_food WHERE id = $id";
      //execute the query
       $res = mysqli_query($conn,$sql);

       //check wheather the query executed or not and set the session msg respectively

       //4.redirect to manage food with session msg
       if($res ==true){
           //Food deleted
           echo "Delete successfully";
           $_SESSION['delete'] = "<div class='success'>Food delete successfully</div>";
           header('location:'.SITEURL.'admin/manage-food.php');

       }
       else{
           //failed to delete food
           $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
           header('location:'.SITEURL.'admin/manage-food.php');
       }

        


}
else{
    //redirect to manage food page
   // echo "redirect";

   $_SESSION['unauthorize']= "<div class = 'error'>Unauthorized Access</div>";
   header('location:'.SITEURL.'admin/manage-food.php'); 
}

?>