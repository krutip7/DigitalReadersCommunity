<?php

require 'includes/connect.php';
if (!isset($_SESSION['username'])) { 
    header('location: index.php');
}

if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    $sql = "SELECT location FROM files WHERE id=$id";
    $result = mysqli_query($con, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/'.$file['location'];
    $name = basename($filepath);

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=\"${name}\"");
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '.filesize('uploads/'.$file['location']));
        readfile('uploads/'.$file['location']);

        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($con, $updateQuery) or die(mysqli_error($con));
        header('location: profile.php');
    }
    else{
        echo "file does not exist!";
    }

}
?>