<?php 
session_start();
unset($_SESSION['currentUser']);
header('location:homepage.php');
?>