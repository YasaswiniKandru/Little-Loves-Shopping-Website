<?php
    session_start();
    require 'dbconnection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{
        $user_id=$_GET['id'];
        $product_status_query="update users_items set status='Confirmed' where user_id=$user_id";
        $result=mysqli_query($con,$product_status_query) or die(mysqli_error($con));
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Shipment</title>
        <meta charset="UTF-8">
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
			<center>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
					
                            <div class="panel-body">
                                <p>Your order is confirmed. It will be delivered in a week. Thank you for shopping with us. <a href="products.php">Click here</a> to purchase any other item.</p>
							</div>
                        </div>
                    </div>
                </div>
            </div>
			</center>
        </div>
    </body>
</html>
