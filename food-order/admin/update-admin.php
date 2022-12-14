<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
       
        <br><br>
        <!-- to get the date which is getting updated -->
        <?php
          //1.Get ID of selected admin
          $id=$_GET['id'];


          //2.Create SQL Query to get the detail
          $sql="SELECT * FROM tbl_admin WHERE id=$id";

          //3.Execute the query
          $res=mysqli_query($conn,$sql);

          //Check whether query is executed or not
          if($res==true){
            //check whether data is available or not
            $count = mysqli_num_rows($res);

            //check whether we have admin data or not
            if($count==1)
            {
                //Get the details
                // echo "Admin Available";
                $row= mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];

            }
            else
            {
                 //Redirect page to Manage admin page
                 header("location:".SITEURL.'admin/manage-admin.php');

            }
          }
        
        
        ?>
        <form action="" method="POST">
               <table class="tbl-30">
                    <tr>
                       <td>Full name</td>
                       <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                       </td>
                    </tr>
                    <tr>
                       <td>User name</td>
                       <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
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
    
    $iid= $_POST['id'];                  //changed name to avoid conflict
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //Create query to update admin
    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name' ,
    username = '$username'
    WHERE id = $iid
    ";

    //3. execute query and save data in database
                
    $res = mysqli_query($conn , $sql) ;

    //check whether query is executed successfully or not
    if($res==true){
        // echo "Data inserted";
        //create a session variable to display message

        $_SESSION['update'] = "<div class='success'> Admin Updated successfully </div>";
        //Redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');


    }
    else{
        // echo "Failed to insert data";

        //create a session variable to display message

        $_SESSION['update'] = "<div class='error'> Failed to Update admin </div>";
        //Redirect page to Add admin page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
}


?>
<?php include('partials/footer.php') ;?>


