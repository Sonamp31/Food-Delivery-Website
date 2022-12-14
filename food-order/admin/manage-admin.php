<?php include("partials/menu.php"); ?>

        <!--main content section starts-->
        <div class="main-content">
            
            <div class="wrapper">
            <h1>Manage Admin</h1>
            <br/><br/>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];      //Displaying session message

                    unset($_SESSION['add']);   //Removing session message
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];      //Displaying session message

                    unset($_SESSION['delete']);   //Removing session message
                }

                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];      //Displaying session message

                    unset($_SESSION['update']);   //Removing session message
                }

                if(isset($_SESSION['user-not-found']))
                {
                    echo $_SESSION['user-not-found'];      //Displaying session message

                    unset($_SESSION['user-not-found']);   //Removing session message
                }

                if(isset($_SESSION['pwd-not-match']))
                {
                    echo $_SESSION['pwd-not-match'];      //Displaying session message

                    unset($_SESSION['pwd-not-match']);   //Removing session message
                }

                
                if(isset($_SESSION['change-pwd']))
                {
                    echo $_SESSION['change-pwd'];      //Displaying session message

                    unset($_SESSION['change-pwd']);   //Removing session message
                }





            ?>
            <br><br>
            <!--Button to add admin-->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            
            <br/> <br/> <br/>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 

                   //Query to get all admin
                   $sql= "SELECT * FROM tbl_admin";
                   //execute query
                   $res = mysqli_query($conn, $sql);
                   //check whether query is executed or not
                   if($res==TRUE)
                   {
                    // Count rows to check we have data in database or not
                    $count = mysqli_num_rows($res);
                    $sn = 1;   //create a variable and assign it value

                    //check number of rows
                    if($count > 0)
                    {
                        //we have data in database
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            //Using while loop to get all data from database
                            //and while loop will run as long as we have data in database
                            
                            //get individual data
                            $id=$rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            //display value in our table
                            ?>
                            
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $full_name ?></td>
                                <td><?php echo $username ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>"class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>"class="btn-danger">Delete Admin</a>
                                    
                                </td>
                                
                            </tr>
                            <?php
                            

                        }

                    }
                    else{
                        //no data is present in database
                    }
                   }
                
                
                ?>
              
                
            </table>

               
               
            <div class="clearfix"></div>
               
            </div>
            
        </div>
        <!--main content section ends-->

   
<?php include("partials/footer.php"); ?>