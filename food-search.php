<?php include('partials-front/menu.php');  ?>


<br><br><br>
<br><br>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="containersearch">
            

            <h1>- Burger -</h1>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //get the search keyword
                $search = $_POST['search'];

                //sql query to get for based on search keyword
                $sql = "SELECT * FROM tbl_food WHERE title Like '%$search%' OR description LIKE '%$search%'";

                //execute trhe queryy
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check wheather food avaialble or not
                if($count>0){
                    //food available
                    while($row=mysqli_fetch_assoc($res)){
                        //get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain burger" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                            
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price;?></p>
                            <p class="food-detail">
                                <!-- Made with tomato Sauce, Chicken, and organice vegetables. -->
                                <?php
                                    echo $description;
                                ?>
                            </p>
                            <br>

                            <a href="order.html" class="btn btn-primary">Order Now</a>
                        </div>
                            </div>

                        <?php
                }
                }
                else{
                    //food not avaialble
                    echo "<div class='error'>Food not found</div>";
                }
            
            ?>

           




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');  ?>