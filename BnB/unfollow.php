<?php 
    require 'includes/connect.php';
    if (!isset($_SESSION['id'])) { 
        header('location: index.php');
    }

    if (isset($_GET['id'])) {
        $uid = $_GET['id'];
        $query = "delete from follows where uid = {$_SESSION['id']} and fid = {$uid}";
        mysqli_query($con, $query) or die(mysqli_error($con));
        header("location: profile.php?id={$uid}");
    }
?>
