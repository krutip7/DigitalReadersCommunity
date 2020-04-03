<?php 
require "includes/connect.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
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
    
<div class="container below_nav">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-8">
                <h2>Live Support</h2>
                <p class="info">A contact page is a standard web page on a website used to allow the visitor to contact the website owner or people who are responsible for the maintenance of the site. The page often contains a mailto link to an e-mail address, a description of personalia, name, address, zip code, residential area, with a map indicating a certain physical location a contact form with entries where the visitor can fill in their name, subject and message and send or reset it. </p>
            </div>
            <div class="col-xs-2">
                <img src="img/contact.png">
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-xs-offset-1 col-xs-6">
                <h2>CONTACT US</h2>
                <form action="sendmail.php" method="POST">
                    <div class="form-group">
                        <input type="text"  class="form-control" name="name"  placeholder="Name" required="required">
                    </div>
                    <div class="form-group">
                        <input type="email"  class="form-control" name="email" placeholder="Email" required="required">
                    </div>
                    <textarea class="form-control" name="message" placeholder="Message" rows="4"></textarea><br>
                    <div class="form-group">
                    <input type="submit" value="SUBMIT" class="btn btn-primary">
                    </div>
                    <div class="text-success"><b><?php if(isset($_GET['fb'])){echo"Thank you for your feedback!";} ?></b></div>
                </form>
            </div>
            <div class="col-xs-5">
                <h3>COMPANY INFORMATION:</h3><br>
                <p>BnB, India - 178023</p><br>
                <p>Phone No.: +91 8164697479</p><br>
                <p>Email: support@bnb.com</p><br>
            </div>
        </div>
    </div>

</body>
</html>