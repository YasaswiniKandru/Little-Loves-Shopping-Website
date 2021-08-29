<?php
    
    function cart_check($item_id){
        require 'dbconnection.php';
        $user_id=$_SESSION['id'];
        $get_products_query="select * from users_items where item_id='$item_id' and user_id='$user_id' and status='Added to cart'";
        $result=mysqli_query($con,$get_products_query) or die(mysqli_error($con));
        $rows=mysqli_num_rows($result);
        if($rows>=1)return 1;
        return 0;
    }
?>