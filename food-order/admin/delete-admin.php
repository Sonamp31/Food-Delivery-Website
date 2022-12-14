<?php
    //Include constants.php file here
    include("../config/constants.php");

    //1. get the id of admin to be deleted
    $id = $_GET['id'];

    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query is executed successfully or not
    if($res==true)
    {
        //Query executed successfully and admin deleted
        //echo "Admin deleted";
         //create a session variable to display message

         $_SESSION['delete'] = "<div class='success'> Admin deleted successfully </div>";
         //Redirect page to manage admin
         header("location:".SITEURL.'admin/manage-admin.php');


    }
    else
    {
        //Failed to delete admin
        // echo "Admin fail to delete";
        $_SESSION['delete'] = "<div class='error' >Failed to delete admin </div>";
        //Redirect page to Add admin page
        header("location:".SITEURL.'admin/manage-admin.php');

    }

    //3. redirect to manage admin page with message (success/error)
    









?>