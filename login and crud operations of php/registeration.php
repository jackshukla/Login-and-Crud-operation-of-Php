<?php
require_once "functions.php";
check_session();
$error = "";
if (isset($_POST['submit']))
{
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$contact_no = $_POST['contact_no'];
	$email_address = $_POST['email_address'];
	$password = $_POST['password'];
		
	if ($first_name == '' || $last_name == '' || $contact_no == ''||$email_address == ''||$password == '' )
		{
			$error = 'ERROR: Please fill in all required fields!';
		}
		else
		{
			$sql = "INSERT INTO users (first_name, last_name,contact_no,email_address,password) VALUES ('$first_name', '$last_name', '$contact_no','$email_address','$password')";
			mysql_query($sql) or die(mysql_error());;
			header("Location: view user.php");
		}
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
<link rel = "stylesheet" type = "text/css" href="registeration.css"/>
<?php 
	nav_menu(); 
	echo $error;
?>
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h2 class="panel-title"><center>Add User Registeration</center></h2>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form" method="post">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="contact_no" name="contact_no" id="contact_no" class="form-control input-sm" placeholder="Contact No">
			    			</div>
							<div class="form-group">
			    				<input type="email_address" name="email_address" id="email_address" class="form-control input-sm" placeholder="Email Address">
			    			</div>
							<div class="form-group">
			    				<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    			</div>
			    			<div class="row">
			    			</div>
                           <input type="submit" name="submit" value="Register" class="btn btn-info btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
</html>