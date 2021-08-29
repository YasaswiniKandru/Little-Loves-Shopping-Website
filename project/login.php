<?php
    require 'dbconnection.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
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
            <br><br><br>
           <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3>LOGIN</h3>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="login.php">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password(min. 6 characters)" pattern=".{6,}">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="Login" value="Login" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">Don't have an account yet? <a href="signup.php">Register</a></div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </body>
</html>
<?php
   
	if (isset($_POST["Login"])){
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$regex="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
		if(!preg_match($regex,$email)){
			echo "Incorrect email. Kindly check your details";
			?>
			<meta http-equiv="refresh" content="2;url=login.php" />
			<?php
		}
		$password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));

		$user_authentication_query="select id,email from users where email='$email' and password='$password'";
		$user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
		$result=mysqli_num_rows($user_authentication_result);
		echo "<script>console.log('Results');</script>";
		if($result==0){
			
			?>
			<script>
				window.alert("Wrong username or password");
			</script>
			<meta http-equiv="refresh" content="1;url=login.php" />
			<?php
			
		}else{
			echo "<script>console.log('Successful Login');</script>";
			$row=mysqli_fetch_array($user_authentication_result);
			$_SESSION['email']=$email;
			$_SESSION['id']=$row['id'];  
			header('location: products.php');
		}
    }
 ?>