<?php 
require 'includes/connect.php';
if (!isset($_SESSION['username'])) { 
    header('location: index.php');
}
$own=1;

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
	<title>My feed</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
        jQuery(function($) {
          $('.like').on('click', function() {
            var $el = $(this),
              textNode = this.lastChild;
            $el.find('span').toggleClass('glyphicon-heart-empty glyphicon-heart');
          });
        });
    </script>


</head>

<body>
      <?php
    include "results.php";
?>
	<?php 
        include 'includes/header.php';
        $query = "select DATE(temp.stamp),users.username,users.firstname,users.lastname,users.img,temp.id,temp.content,temp.stamp,temp.uid from users inner join (select * from ((select posts.id,posts.content,posts.stamp,posts.uid from posts inner join follows on follows.fid = posts.uid where follows.uid = {$_SESSION['id']}) union (select * from posts where uid= {$_SESSION['id']})) as p) as temp on users.id = temp.uid order by 8 DESC";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $count = mysqli_num_rows($result);
        include 'posts.php';
    ?>
</body>
</html>