<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br><br>

        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];

        }
        
        ?>
        <form action="" method="POST">
        <table class="tbl-30">
                    <tr>
                       <td>Current Password:</td>
                       <td>
                        <input type="password" name="current_password" placeholder="current password">
                       </td>
                    </tr>
                    <tr>
                       <td>New Password:</td>
                       <td>
                        <input type="password" name="new_password" placeholder="new password">
                       </td>
                    </tr>
                    <tr>
                       <td>Confirm Password:</td>
                       <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                       </td>
                    </tr>
                    
                    
                   
                    <tr>
                       
                        <td colspan="2">   <!--because we have two col in each row-->
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <br>
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary"> 
                        </td>
                    </tr>

                </table>

        </form>
    </div>
</div>

<?php

//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    // echo "Button clicked";
    //Get all the values from form to update
    
    $id= $_POST['id'];                  //changed name to avoid conflict
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
   

    //Create query to check whether admin exist or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //3. execute query and save data in database
                
    $res = mysqli_query($conn , $sql) ;

    //check whether query is executed successfully or not
    if($res==true){
        //check whether data is available or not
        $count = mysqli_num_rows($res);

        //check whether we have admin data or not
        if($count==1)
        {
            // User exist 
            // echo "User Found";
            // Check whether new password and confirm password is same or not
            if($new_password==$confirm_password){
                //Update password
                //Password match
                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id=$id
                ";

                //Execute the query

                $res2 = mysqli_query($conn, $sql2);

                //check whether query is executed or not
                if($res2==true){
                    //display msg
                    $_SESSION['change-pwd'] = "<div class='success'> Password changed successfully. </div>";
                    //Redirect page to Manage admin page
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
                else{
                    //display error msg
                    $_SESSION['pwd-not-match'] = "<div class='error'> Password updation failed. </div>";
                    //Redirect page to Manage admin page
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                
                $_SESSION['pwd-not-match'] = "<div class='error'> Password did not match. </div>";
                //Redirect page to Manage admin page
                header("location:".SITEURL.'admin/manage-admin.php');

            }
           
        }
        else
        {
            //User does not exist
            $_SESSION['user-not-found'] = "<div class='error'> User Not found. </div>";
            //Redirect page to Manage admin page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
    }   
}
?>


<?php include("partials/footer.php"); ?>
