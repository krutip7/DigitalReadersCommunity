<?php 
require 'includes/connect.php';
if (isset($_SESSION['id'])) { 
    header('location: feed.php');
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$city = $_POST['city'];
$gender = $_POST['gender'];

if ($gender=="female") {
	$avatar = "img/female.jpg";
}
elseif($gender=="male"){
	$avatar = "img/male.jpg";
}
else{
	$avatar = "img/avatar.jpg";
}

if (strlen($pwd) < 8) {
  header('location: signup.php?perr=true');
  exit;
}

$fname = mysqli_real_escape_string($con, $fname);
$lname = mysqli_real_escape_string($con, $lname);
$uname = mysqli_real_escape_string($con, $uname);
$pwd = md5(mysqli_real_escape_string($con, $pwd));
$city = mysqli_real_escape_string($con, $city);

$query = "select username from users where username='$uname'";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$rows = mysqli_num_rows($result);

if ($rows == 0){
	$query = "insert into users(firstname,lastname,username,pwd,city,img,gender) values('$fname','$lname','$uname','$pwd','$city','$avatar','$gender')";
	$submit = mysqli_query($con, $query) or die(mysqli_error($con));

	$_SESSION['id'] = mysqli_insert_id($con);
	$_SESSION['username'] = $uname;
	header('location: feed.php');
	exit;
}
else{
	header('location: signup.php?ex=true');
	exit;
}

?>