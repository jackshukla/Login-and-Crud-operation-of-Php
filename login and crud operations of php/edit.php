<?php
require_once "functions.php";
check_session();
$error = "";
function valid($username,$email,$password)
{
}


if (isset($_POST['submit']))
{
	if (is_numeric($_POST['id']))
	{
		$id = $_POST['id'];
		$username = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
		$email = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
		$password= mysql_real_escape_string(htmlspecialchars($_POST['contact_no']));
		$email_address= mysql_real_escape_string(htmlspecialchars($_POST['email_address']));
		$pass_word= mysql_real_escape_string(htmlspecialchars($_POST['password']));

		if ($username == '' || $email == '' || $password == '' || $email_address == '' || $pass_word == '' )
		{
			$error = 'ERROR: Please fill in all required fields!';
			valid($id, $username, $email,$password,$email_address,$pass_word);
		}
		else
		{
			mysql_query("UPDATE users SET first_name='$username', last_name='$email', contact_no='$password', email_address='$email_address', password='$pass_word' WHERE id='$id'")
			or die(mysql_error());
			header("Location: view user.php");
		}
	}
	else
	{
		echo 'Error!';
	}
}
else
{
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
	{
		$id = $_GET['id'];
		
		$res = mysql_query("SELECT * FROM users WHERE id=$id") or die(mysql_error());
		
		$row = mysql_fetch_array($res);
		if($row)
		{
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$contact_no = $row['contact_no'];
			$email_address = $row['email_address'];
			$password = $row['password'];
        }
		else
		{
			echo "No results!";
		}
	}
	else
	{
		echo 'Error!';
	}
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel = "stylesheet" type = "text/css" href="registeration.css"/>
<head>
<title>Edit Records</title>
</head>
<body>
<?php 
	nav_menu(); 
?>

<?php
if ($error != '')
{
echo $error;
}
?>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h2 class="panel-title"><center>Edit User Data</center></h2>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post">
							<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" value="<?php echo $first_name; ?>">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" value="<?php echo $last_name; ?>">
			    					
							</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="contact_no" name="contact_no" id="contact_no" class="form-control input-sm" placeholder="Contact No" value="<?php echo $contact_no; ?>">
			    			</div>
                            <div class="form-group">
			    				<input type="email_address" name="email_address" id="email_address" class="form-control input-sm" placeholder="email_address" value="<?php echo $email_address; ?>">
			    			</div>
							<div class="form-group">
			    				<input type="password" name="password" id="password" class="form-control input-sm" placeholder="password" value="<?php echo $password; ?>">
			    			</div>
			    			<div class="row">
			    			</div>
			    			
			    			<input type="submit" name="submit" value="Submit" class="btn btn-info btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
  </body>
</html>