<?php
    require 'dbconnection.php';
    session_start();
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $insert_query="insert into users_items(user_id,item_id,status) values ('$user_id','$item_id','Added to cart')";
    $result=mysqli_query($con,$insert_query) or die(mysqli_error($con));
	header('location: products.php')

?>