<?php
// Include config file
require_once 'functions.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
     if(empty(trim($_POST["email"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE email_address = ? and password = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);
            
            // Set parameters
            $param_username = $username;
            $param_password = $password;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt)>= 1){                    
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['email_address'] = $username;      
                            header("location: employeewelcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'Sorry invalid username or password.';
                        }
                    } else{
                    // Display an error message if username doesn't exist
                    $username_err = '';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt); 
    }
    // Close connection
    mysqli_close($link);
?>
<!DOCTYPE html>
<link rel = "stylesheet" type = "text/css" href="employeelogin.css"/>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <h1 class="text-center login-title"><font color="orange">In</font><font color="black">step Employee Login</font></h1>
                <form class="form-signin"name="formsignin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                 <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
				 <span class="help-block"><?php echo $password_err; ?></span>
				 </div>
               <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
			   <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			   <div class="form-group">
               <button class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">
                 Sign in</button>
				 </div>
				 </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

