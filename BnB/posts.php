
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript">
    
    function validateForm() {
  var x = document.forms["myform"]["content"].value;
  if (x == "") {
    alert("Field must not be empty!");
    return false;
  }
} 
</script>

<div class="below_nav">
		<div class="container">
            <?php
            if($own){
                if($count == 0){ ?>
                    <div class="jumbotron" style="color: gray;" id="fp">
                        <center><h2>Welcome to BnB Community! Write your first post today</h2></center>
                        <hr width="90%">
                        <center><p>Follow more people to view their contributions too</p></center>
                    </div> <?php
                } 
            ?>

            <div class="row" id="wp">
                <div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8">
                    <form action="post_submit.php" method="POST" name="myform" onsubmit="return(validateForm());">
                        <div class="form-group">
                            <textarea rows="3" class="form-control" name="content" placeholder="Write a new post ... " style="resize:vertical"></textarea>
                        </div>
                       <div class="form-group">
                            <input type="submit" name="submit" value="POST" class="btn btn-primary btn-sm" style="float: right;"><br><br>
                        </div>
                    </form>
                </div>
            </div> <?php
            }
            if($count>0){
                while($record = mysqli_fetch_array($result)){ ?><hr width="80%" id="<?php echo($record['id']);?>"><br><br>
        		    <div class="row" style="color: white;">
        		        <div class="col-sm-offset-2 col-sm-8 col-xs-12">
        		            <div class="">
                                <div class="panel-body">
                                    <h4> 
                                        <img class="small-dp" src="<?php echo $record['img'] ?>">
                                        <?php
                                        if(isset($record['lastname'])){ 
                                            echo $record['firstname']." ".$record['lastname']; 
                                        }
                                        else{  
                                            echo $record['firstname']; 
                                        } ?>
                                        <a href="profile.php?id=<?php echo($record['uid']) ?>"><small><?php echo "@".$record['username']; ?></small></a>
                                        <small style="float: right;"><?php echo $record[0]; ?></small>
                                    </h4><br><br>
                                    <p><?php echo $record['content']; ?></p><br>
                                </div>

                                <div class="">
                                	<?php
                                		$query = "select uid from upvotes where pid={$record['id']}";
                                		$op = mysqli_query($con, $query) or die(mysqli_error($con));
                                		$numrows = mysqli_num_rows($op);
	                            		$query = "select uid from upvotes where pid={$record['id']} and uid={$_SESSION['id']}";
	                            		$op = mysqli_query($con, $query) or die(mysqli_error($con)); ?>
                                        <div class="like" style="border-style: none;"><?php
	                            		if (mysqli_num_rows($op) == 0){ ?>
	                            			<a href="?lid=<?php echo($record['id']); ?>#<?php echo($record['id']); ?>" style="color: gray;"><span class="glyphicon glyphicon-heart-empty" id="like"></span></a> <?php
	                            		}
	                            		else{ ?>
	                            			<a href="?ulid=<?php echo($record['id']); ?>#<?php echo($record['id']); ?>" style="color: #bb0000;"><span class="glyphicon glyphicon-heart" ></span></a> <?php
	                            		}?>
                                        <label style="color: #4F4F4F;"><?php
                                        if($numrows == 1){
                            			     echo $numrows." like";
                                        }
                                        else{
                                            echo $numrows." likes";
                                        }
                                    ?></label></div>
                                    <div class="text-muted" style="float: right;">
                                        <?php
                                            $query = "SELECT HOUR(TIMEDIFF(CURRENT_TIMESTAMP, '{$record['stamp']}')),MINUTE(TIMEDIFF(CURRENT_TIMESTAMP, '{$record['stamp']}')),SECOND(TIMEDIFF(CURRENT_TIMESTAMP, '{$record['stamp']}'))";
                                            $op = mysqli_query($con, $query) or die(mysqli_error($con));
                                            $period = mysqli_fetch_array($op);
                                            if((int)$period[0] > 8640){
                                                echo ($period[0]/8640)." years ago";
                                            }
                                            elseif((int)$period[0] > 720){
                                                if((int)$period[0] < 720*2)
                                                {
                                                echo (int)($period[0]/720)." month ago";
                                                }
                                                else{
                                                    echo (int)($period[0]/720)." months ago";
                                                }

                                            }
                                            elseif((int)$period[0] > 168){
                                                if((int)$period[0] < 168*2)
                                                {
                                                    echo (int)($period[0]/168)." week ago";
                                                }
                                                else{
                                                echo (int)($period[0]/168)." weeks ago";
                                                }
                                            }
                                            elseif((int)$period[0] > 24){
                                                if((int)$period[0] < 48){
                                                    echo (int)($period[0]/24)." day ago";
                                                }
                                                else{
                                                    echo (int)($period[0]/24)." days ago";
                                                }
                                            }
                                            elseif((int)$period[0]> 1){
                                                echo $period[0]." hours ago";
                                            }
                                            elseif((int)$period[1] > 1){
                                                echo $period[1]." minutes ago";
                                            }
                                            else{
                                                echo $period[2]." seconds ago";
                                            }
                                        ?>
                                    </div><br>
                                </div>
                            </div>
		                </div>
                    </div><br><br><?php
                }
            } ?>
		</div>
	</div>