<?php
    session_start();
    require 'dbconnection.php';
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    $user_id=$_SESSION['id'];
    $products_query="select it.id,it.name,it.price from users_items ut inner join items it on it.id=ut.item_id where ut.user_id='$user_id'";
    $result=mysqli_query($con,$products_query) or die(mysqli_error($con));
    $count_of_products= mysqli_num_rows($result);
    $sum=0;
    if($count_of_products==0){
	?>
		
	<Script>alert('No items in the cart')</script>";
	<?php
	    require 'products.php';
    }else{
        while($row=mysqli_fetch_array($result)){
            $sum=$sum+$row['price']; 
       }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cart</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php 
               require 'header.php';
            ?>
            <br>
            <div class="container">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>Item Number</th><th>Item Name</th><th>Price</th><th></th>
                        </tr>
                       <?php 
					    $products_query="select it.id,it.name,it.price from users_items ut inner join items it on it.id=ut.item_id where ut.user_id='$user_id'";
                        $result=mysqli_query($con,$products_query) or die(mysqli_error($con));
                        $count_of_products= mysqli_num_rows($result);
                        $counter=1;
                       while($row=mysqli_fetch_array($result)){
                           
                         ?>
                        <tr>
                            <th><?php echo $counter ?></th><th><?php echo $row['name']?></th><th><?php echo $row['price']?></th>
                            <th><a href='cart_remove.php?id=<?php echo $row['id'] ?>'>Remove</a></th>
                        </tr>
                       <?php $counter=$counter+1;}?>
                        <tr>
                            <th></th><th>Total</th><th>$ <?php echo $sum;?></th><th><a href="success.php?id=<?php echo $user_id?>" class="btn btn-primary">Place Order</a></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </body>
</html>
