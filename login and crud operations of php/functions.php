<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<link rel = "stylesheet" type = "text/css" href="functions.css"/>
<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$database_name = 'adminform';

$link = mysqli_connect($host, $user, $pass, $database_name);
 
if(!$link){
    die("ERROR: " . mysqli_connect_error());
}

$connection = mysql_connect('localhost', 'root', '');
mysql_select_db('adminform');


function check_session()
{
	if($_SESSION['username']=='')
	{  
		header("Location:admin.php"); 
	}
}

function nav_menu()
{
	echo '
	<a class="btn-clean" href="welcomepage.php">Welcome Page <i class="ion-ios-unlocked-outline"></i></a>
	<a class="btn-clean" href="view user.php">View User <i class="ion-ios-unlocked-outline"></i></a>
	<a class="btn-clean" href="registeration.php">Add User <i class="ion-ios-unlocked-outline"></i></a>
	<a class="btn-clean" href="logout.php">'.$_SESSION['username'].' Logout <i class="ion-ios-unlocked-outline"></i></a>';
}

?>