<?php

require 'includes/connect.php';
if (!isset($_SESSION['username'])) { 
    header('location: index.php');
}

if (isset($_POST['save'])) { 

	$author = $_POST['author'];
	$name = $_POST['name'];
	$category = $_POST['category'];
    $filename = $_FILES['myfile']['name'];
    $destination =__DIR__.'\uploads\\'.$filename;
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];


	if (move_uploaded_file($file, $destination)) {
        $sql = "INSERT INTO files (name,author,category,location,size,downloads,uid) VALUES ('$name','$author','$category','$filename', $size, 0,{$_SESSION['id']})";
        mysqli_query($con, $sql) or die(mysqli_error($con));
    	header('location: profile.php');
    }
    else{
		header('location: profile.php?ferr=true#menu0');
		exit;    
	}
}
?>