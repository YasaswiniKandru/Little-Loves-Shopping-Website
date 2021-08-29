<?php
    require 'dbconnection.php';
    session_start();
    if(isset($_SESSION['email'])){
        header('location: products.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
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
            <br><br>
            <div class="container">
                <div class="row">
                    <div class="col-xs-4 col-xs-offset-4">
                        <h1><b>REGISTER</b></h1>
                        <form method="post" action="signup.php">
                            <div class="form-group">
                                <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required="true">
                            </div>
							 <div class="form-group">
                                <input type="text" class="form-control" name="lname" placeholder="Enter Last Name" required="true">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter Email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                            </div> 
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Choose Password(min. 7 characters)" required="true" pattern=".{7,}">
                            </div>
                            <div class="form-group"> 
                                <input type="tel" class="form-control" name="contact" placeholder="Enter Contact" required="true">
                            </div>
                     
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Enter Address" required="true">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="Signup" value="Signup" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    if (isset($_POST["Signup"])){
		$fname= mysqli_real_escape_string($con,$_POST['fname']);
		$lname= mysqli_real_escape_string($con,$_POST['lname']);
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$regex="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
		if(!preg_match($regex,$email)){
			echo "Kindly re-check the entered email id.";
			?>
			<meta http-equiv="refresh" content="2;url=signup.php" />
			<?php
		}
		$password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));
		if(strlen($password)<6){
			echo "Your password should be atleast 7 characters.";
			?>
			<meta http-equiv="refresh" content="2;url=signup.php" />
			<?php
		}
		$contact=$_POST['contact'];
		
		$address=mysqli_real_escape_string($con,$_POST['address']);
		$redundant_user_query="select id from users where email='$email'";
		$redundant_user_result=mysqli_query($con,$redundant_user_query) or die(mysqli_error($con));
		$result=mysqli_num_rows($redundant_user_result);
		if($result>0){
			?>
			<script>
				window.alert("This email id has already registered!");
			</script>
			<meta http-equiv="refresh" content="1;url=signup.php" />
			<?php
		}else{
			$user_registration_query="insert into users(fname,lname,email,password,contact,address) values ('$fname','$lname','$email','$password','$contact','$address')";
			$user_registration_result=mysqli_query($con,$user_registration_query) or die(mysqli_error($con));
			?>
			<script>
				window.alert("Registered Successfully"):
			</script>
			<?php
			
			$_SESSION['email']=$email;
			$_SESSION['id']=mysqli_insert_id($con); 
			?>
			<meta http-equiv="refresh" content="3;url=products.php" />
			<?php
		}
	}	
?>
