<?php include('partials/menu.php'); ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>

           <!--  Add category form starts -->

            <form action="" method="POST" enctype="multipart/form-data">
                <table class= "tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type = "text" name="title" placeholder = "Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type = "radio" name = "featured" value = "yes">Yes
                            <input type = "radio" name = "featured" value = "no">No
                        </td>
                    </tr>

                    <tr>
                            <td>Active: </td>
                            <td>
                                <input type="radio" name="active" value = "yes">Yes
                                <input type = "radio" name = "active" value = "no">No
                            </td>
                    </tr>

                    <tr>
                        <td colspan = "2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>


                </table>
            </form>



           <!--  Add category form ernds -->

           <?php
                //check wheather the submit button is clicked
                if(isset($_POST['submit'])){
                    echo "clicked";

                    //get the value from category form
                    $title = $_POST['title'];

                    //for radio input we need to check wheather the button is selected or not

                    if(isset($_POST['featured'])){
                        $featured = $_POST['featured'];
                    }
                    else{
                        //set the default value
                        $featured = "No"; 
                    }

                    if(isset($_POST['active'])){
                        $active = $_POST['active'];
                    }
                    else{
                        $active = "No";
                    }


                    //check wheather the image is selected or not and set the value for image name accordingly

                  
                   // die();//break the code here

                   if(isset($_FILES['image']['name'])){
                       //upload the image
                       //to upload image we need image name,source path and destination path
                       $image_name = $_FILES['image']['name'];

                       //upload the image only if image is selected
                       if($image_name != "")
                       {

                      

                       //Auto rename our image
                       //Get the extension of our image (.jpg,png,gif etc)eg: food1.jpg
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "Food_category_".rand(000, 999).'.'.$ext; //e.g: food_category_834.jpg




                       $source_path = $_FILES['image']['tmp_name'];
                       $destination_path = "../images/category/".$image_name;

                       //finaly upload the image
                       $upload = move_uploaded_file($source_path,$destination_path);

                       //check wheather the image is upload or not
                       //and if the image is not uploaded then we will stop the process and redirect with error msg
                       if($upload==false){
                           //set message
                           $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";

                           //redirect to add category page
                           header('location:'. SITEURL.'admin/add-category.php');

                           //stop the process
                           die();
                       
                        }
                    }
                    }
                   else{
                       //Don't upload image and setthe image_name value as blank
                       $image_name="";
                   }

                    //create sql query to insert category into database

                    $sql = "INSERT INTO tbl_category SET
                      title = '$title',
                      image_name = '$image_name',
                      featured = '$featured',
                      active = '$active'
                    ";

                    //Execute the query and save in database

                    $res = mysqli_query($conn, $sql);

                    //check wheather the query executed or not or data 

                    if($res ==true){
                        //query executed and category added

                        $_SESSION['add'] = "<div class ='success'>Category added successfully</div>";

                        //redirect to manage category page
                        header('location:'. SITEURL.'admin/manage-category.php');
                    }
                    else{
                        //failed to add category
                        $_SESSION['add'] = "<div class ='success'>Failed to add category</div>";

                        //redirect to manage category page
                        header('location:'. SITEURL.'admin/add-category.php');
                        
                    }
                }

           ?>


        </div>
</div>

<?php
  include('partials/footer.php');
?>

