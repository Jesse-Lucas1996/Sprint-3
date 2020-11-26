<!DOCTYPE HTML>  
<html>
  
<head>
      <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>Staff Login</h1>
<div class="topnav" id="myTopnav">
<a href="http://localhost/AdminLogin/index.html">Home</a> 
<a href="http://localhost/AdminLogin/register.php">Admin Register</a>  	
    <a href="http://localhost/AdminLogin/login.php">Admin Login</a> 	 
    <i class="fa fa-bars"></i>
  </a>
</div>  

<?php
if (isset($_POST['submit'])) 
{
    $error_msg = "";
    $usernames = $_POST['username'];
    $passwords = $_POST['password'];
    
	
    $servername = "localhost";
    $dbname = "movie";
    $username = "root";
    $password = "";
	$sql = "SELECT `Password` FROM `Staff` WHERE Username = '$usernames'";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchColumn();
		echo $result;
        if( $passwords === $result)
		{
            header("Location: http://localhost/AdminLogin/displayAllAdmin.php");
           
		}
		else if($result != $password)
		{
			echo ": Credential not matched";
		}
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }




}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="">
                
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                
            </div>
            <button type="submit" name="submit" 
                    class="btn btn-default" value="Login">Login</button>
        </form>
    </div>    
</body>
</html>