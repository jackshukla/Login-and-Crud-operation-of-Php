<?php  
require_once "functions.php";
?>  
<!DOCTYPE html>
<link rel = "stylesheet" type = "text/css" href="adm.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<body>
<div class="container">
<div class="card card-container">
<p id="profile-name" class="profile-name-card"><font color="orange">In</font><font color="black">step Admin Login</font></p>
            <form class="form-signin" name="formsignin" method="post">
             <?php
                       if(isset($_SESSION["errMsg"])){
                        $error = $_SESSION["errMsg"];
                        echo "<span>$error</span>";
                    }
                ?>  
<span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit" id="submit">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php unset($_SESSION['errMsg']); ?>
<?php
$username =  $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["inputEmail"]))){
       $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["inputEmail"]);
    }
    if(empty(trim($_POST["inputPassword"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["inputPassword"]);
    }
    if(empty($username_err) && empty($password_err)){
      $sql = "SELECT username, password FROM tableadmin WHERE username = ? and password = ?";
	  if($stmt = mysqli_prepare($link, $sql)){
          mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
          $param_username = $username;
		  $param_password = $password;
            if(mysqli_stmt_execute($stmt)){
             mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    session_start();
                    $_SESSION["username"] = $username;  
                    $_SESSION["password"] = $password; 					
                    header("location: welcomepage.php");
                } else{
                    $_SESSION['errMsg'] = "Sorry invalid username or password";
                }
            } 
	  }
	  else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
echo $username_err;
echo $password_err;
?>
