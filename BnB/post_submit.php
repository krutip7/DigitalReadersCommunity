<?php 
require 'includes/connect.php';
if (!isset($_SESSION['username'])) { 
    header('location: index.php');
}

$content = $_POST['content'];
$content = mysqli_real_escape_string($con, $content);
$query = "insert into posts(content,uid) values('{$content}',{$_SESSION['id']})";
$submit = mysqli_query($con, $query) or die(mysqli_error($con));

header('location: feed.php');