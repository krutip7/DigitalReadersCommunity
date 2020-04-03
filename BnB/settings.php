<?php 
	require 'includes/connect.php';
	if (!isset($_SESSION['id'])) { 
	    header('location: index.php');
	}
	$query = "select * from users where id={$_SESSION['id']}";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $record = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Update Profile
	</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		.nav-pills>li.active{
			width: 175px;
		}
		.nav-pills>li{
			width: 175px;
		}
		.nav-pills>li>a:hover{
			width: 175px;
			color: initial;
		}
		.nav-pills>li.active>a:hover{
			width: auto;
			color: inherit;
		}
	  body {
	    position: relative;
	  }
	  .affix {
	    top: 75px;
	  }
	  
	  @media screen and (max-width: 810px) {
	    #submit, #social, #personal, #qualification, #reset  {
	      margin-left: 150px;
	    }
	  }

.avatar {
  position: relative;
  
  width: 250px;
  height: 250px;
}

.image {
  opacity: 1;
  display: block;
  width: 250px;
  height: 250px;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 67%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.avatar:hover .image {
  opacity: 0.3;
}

.avatar:hover .middle {
  opacity: 1;
}

</style>

</head>


<body data-spy="scroll" data-target="#myScrollspy" data-offset="15">
	<?php 
    include 'includes/header.php';
    ?>

          <?php
    include "results.php";
?>

    <div class="below_nav">

		<div class="container">
		  <div class="row">

    	<h2 id="top"><span class="glyphicon glyphicon-edit"></span> Update Profile </h2><br><br>
		    <nav class="col-sm-3" id="myScrollspy">
		      <ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="50">
		        <li><a href="#top"><span class="glyphicon glyphicon-sunglasses"></span><b> Social Info</b></a></li>
		        <li><a href="#personal"><span class="glyphicon glyphicon-briefcase"></span><b> Personal Info</b></a></li>
		        <li><a href="#reset"><span class="glyphicon glyphicon-lock"></span><b> Reset Password</b></a></li>
		        <li><a href="#qualification"><span class="glyphicon glyphicon-education"></span><b> Qualification</b></a></li>
		        <li><a href="#submit"><span class="glyphicon glyphicon-saved"></span><b> Save Changes</b></a></li>
		       </ul>
		    </nav>
		    <div class="col-sm-7">
				<form action="update.php" method="POST" enctype="multipart/form-data">
					<div id="social">
						<h3>Social Info</h3><br>
						<div class="avatar form-group col-xs-offset-4">
						  <img src="<?php echo("{$record['img']}");?>" class="image img-circle"  style="width:100%">
						  <div class="middle">
						    <input type="file" name="myfile" >
						  </div>
						</div>
						<?php if(isset($_GET['ferr'])){ ?>
                        <div class="text-warning">
                            <b><?php echo"File format not supported!"; ?></b>
                        </div><br>
                    <?php }?>
						<div class="form-group">
							<label for="uname">UserID</label>
							<input type="text" class="form-control" id="uname" name="uname" value=<?php echo($record['username']); ?>>
							<div class="text-danger"><b><?php if(isset($_GET['ex'])){echo"Username already exists!";} ?></b></div>
						</div>
						<div class="form-group">
							<label for="bio">Bio</label>
							<textarea class="form-control" id="bio" rows="4" name="bio" placeholder="Write something about yourself..." style="resize:vertical"><?php echo("{$record['about']}");?></textarea>
						</div>
					</div>
					<div id="personal"><br><br><br>
						<h3>Personal Info</h3><br> 
						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" class="form-control" id="fname" name="fname" value=<?php echo($record['firstname']); ?> disabled>
						</div>
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" class="form-control" id="lname" name="lname" value=<?php echo($record['lastname']); ?>>
						</div>
						<div class="form-group">
							<label for="dob">Date of Birth</label>
							<input type="date" class="form-control" id="dob" name="dob" value=<?php echo($record['dob']); ?>>
						</div>
						<div class="form-group">
							<label for="contact">Mobile Number</label>
							<input type="tel" pattern="[+0-9]{10}" class="form-control" id="contact" placeholder="+91 XXXX-XXXX-XX" name="contact" value=<?php echo($record['contact']); ?>>
						</div>
						<div class="form-group">
							<label for="email">Email address</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="abc123@xyz.com" value=<?php echo($record['email']); ?>>
						</div>
						<div class="form-group">
							<label class="control-label">Address</label><br>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="country" placeholder="Country" value=<?php echo($record['country']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="state" placeholder="State" value=<?php echo($record['province']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="city" placeholder="City" value=<?php echo($record['city']); ?>>
							</div><br><br>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="area" placeholder="Area" value=<?php echo($record['landmark']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="street" placeholder="Street" value=<?php echo($record['street']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" pattern="[0-9]*" class="form-control" name="pincode" placeholder="Zipcode" value=<?php echo($record['pincode']); ?>>
							</div><br>
						</div>
						
                        <div class="form-group">
					</div>

					<div id="reset"><br><br><br>
						<h3>Reset Password </h3><br>
						<div class="form-group">
                            <input type="password"  minlength="8" class="form-control" name="oldpwd" placeholder="Old Password" >
                            <div class="text-danger"><b><?php if(isset($_GET['operr'])){echo"Incorrect Password!";} ?></b></div>
                        </div>
                        <div class="form-group">
                            <input type="password"  minlength="8" class="form-control" name="newpwd" placeholder="New Password (Min. 8 characters)" >
                            <div class="text-danger"><b><?php if(isset($_GET['nperr'])){echo"Password must contain more than 6 characters!";} ?></b></div>
                        </div>
                        <div class="form-group">
                            <input type="password"  minlength="8" class="form-control" name="repwd" placeholder="Re-type New Password" >
                            <div class="text-danger"><b><?php if(isset($_GET['rperr'])){echo"New password and Retyped password do not match!";} ?></b></div>
                        </div>
					</div>

					<div id="qualification"><br><br><br>
						<h3>Qualification </h3><br>
						<div class="form-group">
							<div class="col-sm-4">
								<input type="text" class="form-control" name="school" placeholder="School Name" value=<?php echo($record['sname']); ?>>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="sdeg" placeholder="Degree" value="SSC" disabled="disabled">
							</div>
							<div class="col-sm-2">
								<input type="text" pattern="([1][9][4-9][0-9])|([2][0][012][0-9])" class="form-control" name="sy" placeholder="Year" value=<?php echo($record['sy']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="sboard" placeholder="Board" value=<?php echo("{$record['sboard']}"); ?>>
							</div><br><br><br>

							<div class="col-sm-4">
								<input type="text" class="form-control" name="clg" placeholder="Jr. College Name" value=<?php echo($record['cgname']); ?>>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="cdeg" placeholder="Degree" value="HSC" disabled="disabled">
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="cy" placeholder="Year" value=<?php echo($record['cgy']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="cgboard" placeholder="Board" value=<?php echo($record['cgboard']); ?>>
							</div><br><br><br>

							<div class="col-sm-4">
								<input type="text" class="form-control" name="ug" placeholder="UG Insitiute" value=<?php echo($record['ugname']); ?>>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="ugdeg" placeholder="Degree" value=<?php echo($record['ugdeg']); ?>>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="uy" placeholder="Year" value=<?php echo($record['ugy']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="uguni" placeholder="University" value=<?php echo($record['uguni']); ?>>
							</div><br><br><br>

							<div class="col-sm-4">
								<input type="text" class="form-control" name="pg" placeholder="PG Institute" value=<?php echo($record['pgname']); ?>>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="pgdeg" placeholder="Degree" value=<?php echo($record['pgdeg']); ?>>
							</div>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="py" placeholder="Year" value=<?php echo($record['pgy']); ?>>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="pguni" placeholder="University" value=<?php echo($record['pguni']); ?>>
							</div>
						</div>
					</div>
					<div id="section4"><br><br><br>
					</div>      
					<div id="submit"><br><br><br>
						<div class="form-group">
		                	<input type="submit" value="UPDATE" class="btn btn-success">
		            	</div>
					</div>
				</form>
		    </div>
		  </div>
		</div>
   	
    </div>

</body>
</html>