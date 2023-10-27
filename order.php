<?php include('config/constants.php')  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style1.css">
</head>
<body>
<br><br>
    <!-- Navbar Section Starts Here -->
    <section class="navbar ">
        <div class="containernavbar">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo"  height=40 class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

<?php
    //check wheather food id is set or not
    if(isset($_GET['food_id'])){
        //get the food id and details of the selected foods
        $food_id = $_GET['food_id'];

        //get the details of selected food
        $sql = "SELECT * FROM  tbl_food WHERE id=$food_id";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check wheather the data is available or not
        if($count==1){
            //we have data
            //get the daya from database
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];


        }
        else{
                //food not available
                //redirect to the homepage
                header('location:'. SITEURL);
        }

    }
    else{
        //redirect to homepage
        header('location:'. SITEURL);
    }
?>

<br><br><br>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-order">
        <div class="container">
            
            <h2 class="text-center text-black">Fill this form to confirm your order.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php
                         //check wheather the image available or not
                        if($image_name==""){
                            //image not available
                            echo "<div class ='error'>Image is not available</div>";
                        }
                        else{
                           // image is available
                            ?>
                                <img src="<?php echo SITEURL?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php

                        }

                        ?>

                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value = "<?php echo $title;?>"

                        <p class="food-price">Rs.<?php echo $price ?></p>
                        <input type="hidden" name="price" value = "<?php echo $price;?>"

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset class="field">
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. John " class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@john.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                    //check wheather submit button clicked or not
                    if(isset($_POST['submit'])){
                        //get all the details from the form
                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];

                        $total = $price *$qty; //total =price*qty

                        $order_date = date("Y-m-d h:i:sa");//order date

                        $status = "Ordered";

                        $customer_name=$_POST["full-name"];
                        $customer_contact=$_POST["contact"];
                        $customer_email=$_POST["email"];
                        $customer_address = $_POST["address"];

                        //save the order in database
                        //create sql to save the data
                        $sql2 = "INSERT INTO tbl_order SET
                            food='$food',
                            price = '$price',
                            qty = '$qty',
                            total = '$total',
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                        ";

                        //echo $sql2; die();
                        //execute the query
                        $res2 = mysqli_query($conn,$sql2);

                        //check whether the query executed successfully o not
                        if($res2==true){
                            //query executed and order saved
                            $_SESSION['order'] = "<div class='success text-center'>Food orderd successfully</div>";
                            header('location:'.SITEURL);
                        }
                        else{
                            //failed to save order
                            $_SESSION['order'] = "<div class = 'error text-center'>Failed to order food</div>";
                            header('location:'.SITEURL);
                        }

                    }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');  ?>