<?php include('partials-front/menu.php');  ?>


<?php
    //check wheather id is passed or not
    if(isset($_GET['category_id'])){
        //category is set and get the id
        $category_id = $_GET['category_id'];

        //get the category item based on the category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //get the values from database
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }
    else{
        //category not passes
        //redirect to home page
        header('location:'.SITEURL);
    }
?>

<br><br><br>
<br><br>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="containersearch">
            
            <h1><a href="#" class="text-blue">"<?php $category_title?>"</a></h1>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>



            <?php
                //create sql query to get foods based on selected category
                $sql2 = "SELECT * from tbl_food WHERE category_id";

                $res2 = mysqli_query($conn,$sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);

                //check wheather food is available or not
                if($count2>0){
                    //food is available
                    while($row2=mysqli_fetch_assoc($res2)){
                        //get the values
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">

                        <?php
                                    //check wheather the image available or not
                                    if($image_name==""){
                                        //image not available
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else{
                                        //image available
                                        ?>
                                           <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="Chicke Hawain burger" class="img-responsive img-curve">  
                                        <?php
                                    }
                                ?>
                           
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price?></p>
                            <p class="food-detail">
                                <!-- Made with tomato Sauce, Chicken, and organice vegetables. -->
                                <?php  
                                    echo $description;
                                ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
                else{
                    //food not available
                    echo "<div class='error'>Food not Available</div>";
                }
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');  ?>