<?php include('partials/menu.php'); ?>

<!-- Main content section starts-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session msg
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //displaying session message
            unset($_SESSION['delete']); //removing session msg
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //displaying session message
            unset($_SESSION['update']); //removing session msg
        }
        ?>
        <br><br>

        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            // query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            // execute the query
            $res = mysqli_query($conn, $sql);

            // check whether the query is executed or not
            if ($res == TRUE) {
                // count rows to check whether we have data in the database or not
                $count = mysqli_num_rows($res);

                $sn = 1; // create variable and assign the value

                if ($count > 0) {
                    // we have data in the database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        // get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // display the values in our table
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                   class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    // no data in the database
                    ?>
                    <tr>
                        <td colspan="4">No Admins Found</td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- Main content section Ends-->

<?php include('partials/footer.php'); ?>
