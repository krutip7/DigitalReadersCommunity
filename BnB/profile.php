    <?php 
    require 'includes/connect.php';
    if (!isset($_SESSION['id'])) { 
        header('location: index.php');
    }
    if (isset($_GET['id'])) {
        $uid = $_GET['id'];
    }
    else{
        $uid = $_SESSION['id'];
    }

    if ($uid == $_SESSION['id']) {
        $own = 1;
    }
    else{
        $own = 0;
    }

    $query = "select * from follows where fid={$uid} and uid = {$_SESSION['id']}";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $following = mysqli_num_rows($result);


    $query = "select * from users where id={$uid}";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $record = mysqli_fetch_array($result);


    if (isset($_GET['ulid'])) {
        $pid = $_GET['ulid'];
        $query = "delete from upvotes where uid = {$_SESSION['id']} and pid = {$pid}";
        mysqli_query($con, $query) or die(mysqli_error($con));
    }

    if (isset($_GET['lid'])) {
        $pid = $_GET['lid'];
        $query = "select uid,pid from upvotes where uid={$_SESSION['id']} and pid={$pid}";
        $num = mysqli_num_rows(mysqli_query($con, $query));
        if($num == 0){
        $query = "insert into upvotes(uid,pid) values({$_SESSION['id']},{$pid})";
        mysqli_query($con, $query) or die(mysqli_error($con));}
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>
        <?php if(isset($record['lastname'])){ 
            echo $record['firstname']." ".$record['lastname']; 
        } 
        else{  
            echo $record['firstname']; 
        } ?>
    </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="includes/script.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#panel").slideToggle("slow");
            });
        });
        
    </script>

    <style type="text/css">
        .avatar{
            width: 150px;
            height: 150px;
            border-radius: 50%;
            vertical-align: middle;
        }
    </style>

</head>

<body>

	<?php 
    include 'includes/header.php';
    ?>

    <?php
    include "results.php";
?>

    <div class="container below_nav">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-2 col-xs-6">
                <img class="avatar" src="<?php echo $record['img'] ?>">
            </div>
            <div class="col-sm-7 col-xs-6">
                <h3>
                    <?php if(isset($record['lastname'])){ 
                        echo $record['firstname']." ".$record['lastname']; 
                    } 
                    else{  
                        echo $record['firstname']; 
                    } ?>
                    <small><?php echo "@".$record['username']; ?></small>
                </h3>
                <?php if (isset($record['country'])) { ?>
                    <span class="glyphicon glyphicon-globe"></span> <?php echo $record['country']; ?> <?php
                } ?>
                <?php if (isset($record['city'])) { ?>
                    <span class="glyphicon glyphicon-map-marker"></span> <?php echo $record['city']; ?> <?php
                } ?>
                
                <p><?php echo $record['about']; ?></p>
                <?php
                    if ($own) { ?>
                        <a href="settings.php" class="btn btn-info btn-xs active"><span class="glyphicon glyphicon-edit"></span> Update </a> <?php
                    }
                    elseif ($following) { ?>
                        <a href="unfollow.php?id=<?php echo($uid); ?>" class="btn btn-danger btn-xs active"><span class="glyphicon glyphicon-minus"></span> Unfollow</a> <?php
                    }
                    else {?>
                        <a href="follow.php?id=<?php echo($uid); ?>" class="btn btn-success btn-xs active"><span class="glyphicon glyphicon-plus"></span> Follow</a> <?php
                    }
                ?>
            </div>


        </div>
    </div>


<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197"> 
<ul class="nav navbar-nav" id="myTab">
<li class="active"><a data-toggle="tab" href="#menu0">Uploads</a></li>
<li><a data-toggle="tab" href="#menu1">Posts</a></li>
<li><a data-toggle="tab" href="#menu2">Connections</a></li>
</ul>
</nav>

<div class="tab-content">
<div id="menu0" class="tab-pane fade in active">
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-0 col-xs-8">
                <h3>Uploads</h3><br>
                <ul>
                    <?php
                        $query = "select * from files where uid={$record['id']}";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($files as $file): ?> 
                            <li>
                              
                              <?php echo $file['name'];
                              if (isset($file['author'])) {
                                echo " - ".$file['author']; }?><br>
                              <a href="downloads.php?file_id=<?php echo $file['id'] ?>"><?php echo $file['location']." ";?><span class = "glyphicon glyphicon-download-alt"></span></a>
                              <br><?php echo floor($file['size'] / 1000) . ' KB | '; ?>
                              <?php echo $file['downloads']." " ; ?><span class = "glyphicon glyphicon-arrow-down"></span>
                            </li><br><?php 
                        endforeach;
                    ?>
                </ul>
            </div>
            <?php if ($own) { ?>
            <div class="col-xs-offset-1"><br><br>
                <div class="col-sm-4">
                    <div id="flip"><button class="btn btn-default" >Upload new file <span class = "glyphicon glyphicon-cloud-upload"></span></button></div>
                    
                    <?php if(isset($_GET['ferr'])){ ?>
                        <div class="text-warning">
                            <b><?php echo"File format not supported!"; ?></b>
                        </div><br>
                    <?php }?>
                    <div id="panel" style="background-color: #222222; padding: 15px; display: none;">
                        <h4>FILE INFO: </h4><br>
                        <form action="upload.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text"  class="form-control" name="name"  placeholder="Title of the book/article" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text"  class="form-control" name="author"  placeholder="Author">
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="category" required="required">
                                  <option>book</option>
                                  <option>article</option>
                                  <option>journal</option>
                                  <option>research</option>
                                  <option>presentation</option>
                                  <option>other</option>
                                </select>  
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="sub-category" required="required">
                                  <option>Science & Technology</option>
                                  <option>Fiction & Fantasy</option>
                                  <option>Sports & Travel</option>
                                  <option>Culture & Art</option>
                                  <option>News & Current Affairs</option>
                                  <option>General Knowledge</option>
                                </select>  
                            </div>
                            <div class="form-group">
                                <input type="file" class="btn" name="myfile" required="required"><br>
                            </div>
                            <div class="form-group">
                            <input type="submit" value="UPLOAD" name="save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>


<div id="menu1" class="tab-pane fade">

    <?php
        $query = "select DATE('temp.stamp'),users.username,users.firstname,users.lastname,users.img,temp.id,temp.content,temp.stamp,temp.uid from users inner join (select * from posts where uid= {$uid}) as temp on users.id = temp.uid order by 8 DESC;";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $count = mysqli_num_rows($result);
        include 'posts.php';
    ?>

</div>

<div id="menu2" class="tab-pane fade">
    <div class="container">
        <div class="row">
            <div class="col-xs-5">
                <h3>Followers</h3><br>
                <ul>
                    <?php
                        $query = "select * from users join follows on follows.uid = users.id WHERE follows.fid = {$uid}";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        
                        while($record = mysqli_fetch_array($result)){ 
                            $query = "select uid from follows WHERE uid = {$_SESSION['id']} and fid={$record['id']}";
                            $isfollowing = mysqli_num_rows(mysqli_query($con, $query)); ?>
                            <li style="list-style-type:none; margin-bottom: 30px;" class="row">
                                <div class="col-sm-2 col-xs-12">
                                    <img class="profilepic" src="<?php echo $record['img'] ?>">
                                </div>
                                <div class="col-sm-8 col-xs-6">
                                    <h4>
                                    <?php if(isset($record['lastname'])){ 
                                        echo $record['firstname']." ".$record['lastname']; 
                                    } 
                                    else{  
                                        echo $record['firstname']; 
                                    } ?>
                                    <br><a href="profile.php?id=<?php echo($record['id']) ?>"><small><?php echo "@".$record['username']; ?></small></a>
                                    </h4>
                                </div>
                                <div class="col-xs-6 col-sm-2"><br>
                                    <?php
                                    if($record['id'] != $_SESSION['id']){
                                        if ($isfollowing) { ?>
                                            <a href="unfollow.php?id=<?php echo($record['id']); ?>" class="btn btn-danger btn-xs active"><span class="glyphicon glyphicon-minus"></span> Unfollow</a> <?php
                                        }
                                        else {?>
                                            <a href="follow.php?id=<?php echo($record['id']); ?>" class="btn btn-success btn-xs active"><span class="glyphicon glyphicon-plus"></span> Follow</a> <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </li><?php 
                        }
                    ?>
                </ul>
            </div>
            <div class="col-xs-offset-1 col-xs-5">
                <h3>Following</h3><br>
                <ul>
                    <?php
                        $query = "select * from users join follows on follows.fid = users.id WHERE follows.uid = {$uid}";
                        $result = mysqli_query($con, $query) or die(mysqli_error($con));
                        while($record = mysqli_fetch_array($result)){ 
                            $query = "select uid from follows WHERE uid = {$_SESSION['id']} and fid={$record['id']}";
                            $isfollowing = mysqli_num_rows(mysqli_query($con, $query)); ?>
                            <li style="list-style-type:none; margin-bottom: 30px;" class="row">
                                <div class="col-sm-2 col-xs-12">
                                    <img class="profilepic" src="<?php echo $record['img'] ?>">
                                </div>
                                <div class="col-sm-8 col-xs-6">
                                    <h4>
                                    <?php if(isset($record['lastname'])){ 
                                        echo $record['firstname']." ".$record['lastname']; 
                                    } 
                                    else{  
                                        echo $record['firstname']; 
                                    } ?>
                                    <br><a href="profile.php?id=<?php echo($record['id']) ?>"><small><?php echo "@".$record['username']; ?></small></a>
                                    </h4>
                                </div>
                                <div class="col-sm-2 col-xs-6"><br>
                                    <?php
                                    if($record['id'] != $_SESSION['id']){
                                        if ($isfollowing) { ?>
                                            <a href="unfollow.php?id=<?php echo($record['id']); ?>" class="btn btn-danger btn-xs active"><span class="glyphicon glyphicon-minus"></span> Unfollow</a> <?php
                                        }
                                        else {?>
                                            <a href="follow.php?id=<?php echo($record['id']); ?>" class="btn btn-success btn-xs active"><span class="glyphicon glyphicon-plus"></span> Follow</a> <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </li><?php 
                        }
                    ?>
                </ul>
            </div>
        </div>


</div>

</body>
</html>