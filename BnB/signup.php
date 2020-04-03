<?php 
require 'includes/connect.php';
if (isset($_SESSION['username'])) { 
    header('location: feed.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <style type="text/css">
        body{
            background-image: url("img/n1.jpg");
        }
    </style>
<body>

	<?php 
    include 'includes/header.php';
    ?>

    <div class="below_nav" >
		<div class="container">
		    <div class="row">
		        <div class="col-xs-offset-3 col-xs-6 col-sm-offset-4 col-sm-4">
		            <h1> SIGN UP </h1>
		            <form action="signup_script.php" method="POST">
		                <div class="form-group">
		                    <input type="text"  class="form-control" name="fname"  placeholder="First Name" required="required">
		                </div>
		                <div class="form-group">
		                    <input type="text"  class="form-control" name="lname"  placeholder="Last Name">
		                </div>
		                <div class="form-group">
		                    <input type="text" class="form-control" name="uname" placeholder="Create a unique User Id" required="required">
                            <div class="text-danger"><b><?php if(isset($_GET['ex'])){echo"This username is not available!";} ?></b></div>
		                </div>
		                <div class="form-group">
		                    <input type="password"  minlength="8" pattern=".{8,}" class="form-control" name="pwd" placeholder="Password (Min. 8 characters)" required="required" >
		                    <div class="text-danger"><b><?php if(isset($_GET['perr'])){echo"Password must contain more than 8 characters!";} ?></b></div>
		                </div>
		                <div class="form-group">
							<label class="radio-inline"><input type="radio" name="gender" value="male"> Male </label>
							<label class="radio-inline"><input type="radio" name="gender" value="female"> Female </label>
							<label class="radio-inline"><input type="radio" name="gender" value="other"> Other</label> 
		                </div>
		                <div class="form-group">
		                    <input type="text"  class="form-control" name="city" placeholder="City">
		                </div>
		                <div class="form-group">
		                <input type="submit" value="SUBMIT" class="btn btn-primary">
		            	</div>
		            </form>
		        </div>
		    </div> 
		</div>
	</div>

</body>
</html>