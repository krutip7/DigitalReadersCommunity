<style type="text/css">
	.resultbox{
	background-color: #222222; padding: 15px; top: 50px; height: 200px; width: 15%; margin-top: -25px; margin-right: 30px;  display: block; position: sticky;position: -webkit-sticky;float: right; overflow: auto;}
	
</style>

<?php



if (isset($_GET['search'])) {

	$find = $_GET['query'];
	if($find!=""){
		$query = "SELECT id,username FROM users WHERE username LIKE \"%{$find}%\" UNION SELECT id,firstname FROM users WHERE firstname LIKE \"%{$find}%\" UNION SELECT uid,name FROM files WHERE name LIKE \"%{$find}%\"";
		$found = mysqli_query($con, $query) or die(mysqli_error($con));?>
		<div class="resultbox col-xs-2" ><?php
			while($row = mysqli_fetch_array($found)){ ?>
				<p><a href="profile.php?id=<?php echo($row['id']) ?>"><?php echo($row['username']) ?></a></p><?php
			}?>
		</div><?php
	}
 	else{?>
 		<div class="resultbox col-xs-2" style="height: 50px;">
 			<p>No results</p>
 		</div><?php
	}
}?>