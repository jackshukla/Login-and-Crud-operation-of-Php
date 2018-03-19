<?php
require_once "functions.php";

if(isset($_GET['id']) && is_numeric($_GET['id']))
{
$id = $_GET['id'];

$result = mysql_query("DELETE FROM users WHERE id=$id")
or die(mysql_error());

header("Location: view user.php");
}
else

{
header("Location: view user.php");
}
?> 