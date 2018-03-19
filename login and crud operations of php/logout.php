<?php
session_start();  
$_SESSION['username'] = "";
header("location:welcomepage.php");
?>