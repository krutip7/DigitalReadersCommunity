


<div class="navbar navbar-inverse navbar-fixed-top" style="padding-right: -40px"> 
	<div class="container"> 
		<div class="navbar-header"> 
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
			</button> 
			<a class="navbar-brand" href="index.php"><img src="img/bnb.jpg" height="50px" width="50px;" style="margin-top: -15px;"> </a> 
		</div> 
		<div class="collapse navbar-collapse" id="myNavbar" style="margin-right: -60px">
			<ul class="nav navbar-nav navbar-right"> 
				<?php 
					if (isset($_SESSION['username'])) { ?>
					
					<li><a href="feed.php"><span class="glyphicon glyphicon-inbox"></span> Feed</a></li>
					<li><a href = "profile.php"><span class = "glyphicon glyphicon-user"></span> My Profile</a></li>
					<li><a href = "logout.php"><span class = "glyphicon glyphicon-log-out"></span> Logout</a></li> 
					<li>
						<?php
							include "search.php";
						?>
					</li>
				<?php
					} else { 
				?>
					<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> 
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <li><a href="contact.php"><span class="glyphicon glyphicon-phone"></span> Contact Us</a></li>
				<?php 
					} 
				?> 
			</ul> 
		</div> 
	</div> 
</div>