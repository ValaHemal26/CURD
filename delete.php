<?php
    require 'conn.php';
    if(isset( $_GET['id'])){
    $id = $_GET['id'];
    $delete= "DELETE FROM users WHERE id=$id";
    $query=mysqli_query($conn,$delete);
    if($query)
    {   
        echo '<script>alert("Data Deleted Successfully");</script>';
    }
    else
    {
        echo '<script>alert("Data Not Deleted");</script>';
    }
    echo "<script>window.location.href='show.php';</script>";
    }
    else
    {
        echo "<script>window.location.href='show.php';</script>";
    }
?>