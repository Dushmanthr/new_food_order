<?php
    include('partials-front/menu.php');
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="containersearch">
            
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../images/bg1.png" class="d-block w-100" alt="...">

          
    </div>
    <div class="carousel-item">
      <img src="../images/bg2.jpg" class="d-block w-200" alt="...">

       
    </div>
    <div class="carousel-item">

      <img src="../images/bg3.jpg" class="d-block w-200" alt="...">
   </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>


        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset ($_SESSION['order']);
    }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
              //create sql query to display categories from database
              $sql = "SELECT * from tbl_category  WHERE active='Yes' AND featured = 'Yes' LIMIT 3";

              //Execute the query
              $res = mysqli_query($conn,$sql);
                // count rows to check wheather the category is available or not
              $count = mysqli_num_rows($res);

              if($count>0){
                  //category available
                  while($row = mysqli_fetch_assoc($res)){
                      //get the values like id,title,image name

                      $id = $row['id'];
                      $title = $row['title'];
                      $image_name = $row['image_name'];
                     
                      ?>
                             <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                    <div class="box-3 float-container">

                                    <?php
                                    //check wheather the image is avaialble or not
                                        if($image_name==""){
                                            //display msg
                                            echo "<div class = 'error'>Image not available</div>";
                                        }
                                        else{
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="Burger" class="img-responsive img-curve">
                                            <?php
                                        }
                                    
                                    ?>
                                        

                                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                                    </div>
                            </a>
                      <?php
                  }
              }
              else{
                  //category is not available

                  echo "<div class = 'error'>Category not added</div>";
              }
            
            ?>

           

         

          

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //getting foods from database that are active and featured
                //sql query
                $sql2 ="SELECT id,title,price,description,image_name FROM tbl_food WHERE active ='yes' AND featured = 'Yes' ";

                //Execute the query
                $res2 = mysqli_query($conn,$sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                //check wheather food available or not
                if($count2>0){
                    //food available
                  while($row = mysqli_fetch_assoc($res2)){
                    //get the values like id,title,image name

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
                        if($image_name ==""){
                            //image not available
                            echo "<div class = 'error'>Image not found!</div>";
                        }
                        else{
                            //Image available
                            ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain burger" class="img-responsive img-curve">
                            <?php
                        }

                    ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                                <?php echo $description;?>
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
                    echo "<div class = 'error'>Food not available!</div>";
                }

            ?>

           
            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php
    include('partials-front/footer.php');
?>