<?php
        //include constants file
        include('../config/constants.php');

    //echo "delete page";
    //check wheather the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the value and delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

         //remove the physical image size is available
         if($image_name !=" "){
             //image is available . so remove it
             $path = "../images/category/". $image_name;
             //remove the image
             $remove = unlink($path);

             if($remove==false){
                 //set the session msg
                 $_SESSION['remove'] = "<div class='error'>Fail to remove category image.</div>";
                 //redirect to manage category page
                header('location:'. SITEURL.'admin/manage-category.php');

                 //stop the process
                 die();
             }
         }

        //delete data from database
        //sql query to delete data from database
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        //Execute the query
        $res= mysqli_query($conn, $sql);

        //check wheather the data is delete from database or not
        if($res==true){
            //set success msg
            $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //set fail msg
            $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category page with messsage
    }
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

       
    } 
?>