<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
      <h1>Update category</h1>

      <br><br>

      <?php
      
            //check wheather the id is set or not
            if(isset($_GET['id'])){
                //get the ID and all other details
                //echo 'Getting data';
                $id = $_GET['id'];
                //create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //execute the query

                $res = mysqli_query($conn, $sql);

                //count the rows to check wheather the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1){
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    //redirect to message category with session msg
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                    header('location:'.SITEURL. 'admin/manage-category.php');
                }
            }
            else{
                //rediret the manage category
                header('location:'. SITEURL.'admin/manage-category.php');

            }
      ?>

        <form action = "" method = "POST" enctype="multipart/form-data">
      <table class = "tbl-30">
            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name = "title" value="<?php  echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>
                    Current Image:
                </td>

                <td>
                    <?php
                        if($current_image!=""){
                            //display the image
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px" >
                            <?php
                        }
                        else{
                            //display msg
                            echo "<div class='error'>Image not added</div>";
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>New Image: </td>
                <td>
                <input type = "file" name = "image">
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?>type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value = "Yes">Yes

                    <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value = "No">No
                </td>
            </tr>

            <tr>
                <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                <input type="hidden" name="id" value = "<?php  echo $id;?>">
                <input type="submit" name="submit" value="update category" class = "btn-secondary">
                </td>
            </tr>
      </table>
      </form>

      <?php
            if(isset($_POST['submit'])){
                //echo "clicked";
                //get all the values from our from

                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured=$_POST['featured'];
                $active = $_POST['active'];

                //updating new image if selected

                //check whether the image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name = $_FILES['image']['name'];

                    //check wheather the image is avsilable or not
                    if($image_name !=""){
                        //image available
                        //upload the new image

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
                          header('location:'. SITEURL.'admin/manage-category.php');

                          //stop the process
                          die();
                      
                       }
                        //remove the current image
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
    
                            //check wheather the imge is removed or not
                            //if failed to remove then display message and stop the process
                            if($remove==false){
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                header("location:". SITEURL."admin/manage-category.php");
                                die(); //stop the process
                            }
                        }
                      
                    }
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

               

                //update the database

                $sql2 = "UPDATE tbl_category SET 
                title = '$title',
                image_name = '$image_name', 
                featured = '$featured',
                active = '$active'
                WHERE id = $id
    ";

                    //Execute the query
                    $res2 = mysqli_query($conn,$sql2);

                //redirect to manage category with message
                //check wheather executed or not
                if($res2 == true){
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Ctegory updated successfully</div>";
                    header("location:". SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to update category 
                    $_SESSION['update'] = "<div class='error'>Ctegory updated Failed</div>";
                    header("location:". SITEURL.'admin/manage-category.php');
                }

            }
      ?>
    </div>
</div>




<?php
  include('partials/footer.php');
?>