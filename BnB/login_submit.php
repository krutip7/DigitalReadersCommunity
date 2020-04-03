<?php 

require 'includes/connect.php';
if (isset($_SESSION['username'])) { 
    header('location: feed.php');
}

$uname = $_POST['uname'];

$pwd = $_POST['pwd'];
if (strlen($pwd) < 8) {
  header('location: login.php?perr=true');
}

$uname = mysqli_real_escape_string($con, $uname);
$pwd = md5(mysqli_real_escape_string($con, $pwd));

$query = "select id,username,pwd from users where username='$uname' and pwd='$pwd'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$count = mysqli_num_rows($result);
$record = mysqli_fetch_array($result);

if($count == 0){
	header('location: login.php?err=true');
	exit;
}

$_SESSION['id'] = $record['id'];
$_SESSION['username'] = $uname;
header('location: feed.php');

?>