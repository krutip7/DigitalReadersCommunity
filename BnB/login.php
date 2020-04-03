
<?php 
require "includes/connect.php";
if (isset($_SESSION['username'])) { 
    header('location: feed.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log In</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body{
            background-image: url("img/n1.jpg");
        }
    </style>
</head>
<body>

	<?php 
    include 'includes/header.php';
    ?>

	<div class="below_nav">
		<div class="container">
            <div class="row">
                <div class="col-xs-offset-2 col-xs-8 col-sm-offset-3 col-sm-6">
                    <div class="">
                        <div class="panel-heading">
                            <h2>LOGIN</h2>
                        </div>
                        <div class="panel-body">
                            <form action="login_submit.php" method ="POST">
                            	<div class="form-group">
				                    <input type="text" class="form-control" name="uname" placeholder="User Id" required="required">
                                </div>
				                <div class="form-group">
				                    <input type="password" minlength="8" class="form-control" name="pwd" placeholder="Password" required="required">
                                     <div class="text-danger"><b><?php if(isset($_GET['perr'])){echo"Password must contain more than 8 characters!";} ?></b></div>
				                </div>
    	                        <input class="btn btn-primary" type="submit" value="Login">
	                        </form>
	                        <br>
                            <div class="text-warning"><b>
                                <?php
                                    if(isset($_GET['err'])){
                                        echo"Incorrect username or password!";
                                    }?></b>
                            </div>
                            <br>
                        </div>
                        <div class="">
                            <p>Don't have an account? <a href="signup.php">Register <span class = "glyphicon glyphicon-new-window"></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>


</body>
</html>