<?php

require "includes/connect.php";

if(isset($_SESSION['username'])) { 
	session_destroy();
}

header('location: index.php');

?>