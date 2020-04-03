<?php 
require 'includes/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Binge oN Books</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <?php 
    include 'includes/header.php';
    ?>

    <div id="banner_image">
        <div class="container"><center>
            <div id="banner_content">
                <h1>Binge oN Books!</h1>
                <p>Get & share ebooks, articles & more <span class="glyphicon glyphicon-transfer"></span></p><br>
                <a href="login.php" class="btn btn-danger btn-lg active">Join Now</a>
            </div></center>
        </div>
    </div>


</body>
</html>