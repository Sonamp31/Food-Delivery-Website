<?php include("partials/menu.php") ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
             
            <br> <br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];      //Displaying session message

                    unset($_SESSION['add']);   //Removing session message
                }



            ?>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                       <td>Full name</td>
                       <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                       </td>
                    </tr>
                    <tr>
                       <td>User name</td>
                       <td>
                        <input type="text" name="username" placeholder="Enter Username">
                       </td>
                    </tr>
                    <tr>
                       <td>Password</td>
                       <td>
                        <input type="password" name="password" placeholder="Enter password">
                       </td>
                    </tr>
                    
                   
                    <tr>
                        
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> 
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>




<?php include("partials/footer.php") ?>

<?php
   //process value from form and save in database

   //Check whether the button is clicked or not
   if(isset($_POST['submit'])){
       //button clicked
       
       //1. get the data from form
       //we are accessing value using name property of input tag
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']); //password encryption is md5
         
       
       //2. sql query to save data into database
       $sql="INSERT INTO tbl_admin SET 
           full_name= '$full_name',
           username= '$username',
           password= '$password'
       ";
       
        //3. execute query and save data in database
                
        $res = mysqli_query($conn , $sql) or die(mysqli_error());

        //4. Check whether the(query is executed) data is inserted or not and display appropriate message

        if($res==true){
            // echo "Data inserted";
            //create a session variable to display message

            $_SESSION['add'] = "<div class='success'> Admin Added successfully </div>";
            //Redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');


        }
        else{
            // echo "Failed to insert data";

            //create a session variable to display message

            $_SESSION['add'] = "<div class='error'> Failed to Add admin </div>";
            //Redirect page to Add admin page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
   }
  
   
?>

