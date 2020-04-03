<?php 
require 'includes/connect.php';
if (!isset($_SESSION['id'])) { 
    header('location: index.php');
}

$lname = $_POST['lname'];
$uname = $_POST['uname'];
$bio = $_POST['bio'];
$dob = $_POST['dob'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$city = $_POST['city'];
$country = $_POST['country'];
$state = $_POST['state'];
$area = $_POST['area'];
$street = $_POST['street'];
$pincode = $_POST['pincode']==""?'NULL':$_POST['pincode'];
$school = $_POST['school'];
$sy = $_POST['sy']==""?'NULL':$_POST['sy'];
$sboard = $_POST['sboard'];
$cgboard = $_POST['cgboard'];
$clg = $_POST['clg'];
$cy = $_POST['cy']==""?'NULL':$_POST['cy'];
$ug = $_POST['ug'];
$ugdeg = $_POST['ugdeg'];
$uy = $_POST['uy']==""?'NULL':$_POST['uy'];
$uguni = $_POST['uguni'];
$pg = $_POST['pg'];
$pgdeg = $_POST['pgdeg'];
$py = $_POST['py']==""?'NULL':$_POST['py'];
$pguni = $_POST['pguni'];
$oldpwd = $_POST['oldpwd'];
$newpwd = $_POST['newpwd'];
$repwd = $_POST['repwd'];


$id = $_SESSION['id'];
if ($_POST['oldpwd'] !="") {
	# code...
	$oldpwd = md5(mysqli_real_escape_string($con, $oldpwd));

	$query = "select id,pwd from users where id='$id' and pwd='$oldpwd'";
	$result = mysqli_query($con, $query) or die(mysqli_error($con));
	$count = mysqli_num_rows($result);

	if($count == 0){
		header('location: settings.php?operr=!');
		exit();
	}

	if (strlen($newpwd) < 8) {
	  header('location: settings.php?nperr=!');
	  exit();
	}

	$newpwd = md5(mysqli_real_escape_string($con, $newpwd));
	$repwd = md5(mysqli_real_escape_string($con, $repwd));

	if($newpwd == $repwd){
		$query = "update users set pwd='$newpwd' where id='$id'";
		$submit = mysqli_query($con, $query) or die(mysqli_error($con));
	}
	else{
		header('location: settings.php?rperr=!');
	}
}

$area = mysqli_real_escape_string($con, $area);
$street = mysqli_real_escape_string($con, $street);
$uname = mysqli_real_escape_string($con, $uname);
$bio = mysqli_real_escape_string($con, $bio);

if ($_POST['uname']!=$_SESSION['username']) {
	# code...

	$query = "select username from users where username='$uname'";
	$result = mysqli_query($con, $query) or die(mysqli_error($con));
	$rows = mysqli_num_rows($result);

	if ($rows == 0){
		$query = "update users set username='$uname' where id='$id'";
		$submit = mysqli_query($con, $query) or die(mysqli_error($con));
		$_SESSION['username'] = $uname;
	}
	else{
		header('location: settings.php?ex=true');
	}

}


$query = "update users set lastname='$lname', about='$bio', dob='$dob', contact='$contact', email='$email', country='$country', province='$state',city='$city',landmark='$area',street='$street',pincode={$pincode},sname='$school',sboard='$sboard',sy={$sy},cgname='$clg',cgboard='$cgboard',cgy={$cy},ugname='$ug',ugdeg='$ugdeg',uguni='$uguni',ugy={$uy},pgname='$pg',pgdeg='$pgdeg',pguni='$pguni',pgy={$py} where id='$id'";
$submit = mysqli_query($con, $query) or die(mysqli_error($con));


if ($_FILES['myfile']['name']!="") {

$filename = $_FILES['myfile']['name'];
    $destination =__DIR__.'\uploads\\'.$filename;
    $filename = "uploads/".$filename;
    $file = $_FILES['myfile']['tmp_name'];

	if (move_uploaded_file($file, $destination)) {
        $sql = "update users set img='$filename' where id='$id'";
        mysqli_query($con, $sql) or die(mysqli_error($con));
    }
    else{
		header('location: settings.php?ferr=true#menu0');
		exit;    
	}
}

header('location: settings.php?success=1');
exit;