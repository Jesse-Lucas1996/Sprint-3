<!DOCTYPE HTML>  
<html>
  
<head>
      <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<h1>Staff Register</h1>
<div class="topnav" id="myTopnav">
<a href="http://localhost/AdminLogin/index.html">Home</a> 
<a href="http://localhost/AdminLogin/register.php">Admin Register</a>  	
    <a href="http://localhost/AdminLogin/login.php">Admin Login</a> 	
    <i class="fa fa-bars"></i>
  </a>
</div>  
<div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
             
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
    
            </div>
          

            </div>
            <div class="form-group">
                <input type="submit" name = "submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
<?php
if(isset($_POST['submit']))
{
  $root = "root";
  $usernames = $_POST["username"];
  $passwords = $_POST["password"];      
  $dbname = "movie";
  $servername = "localhost";
  $password = '';
   
        try
        {
        $conn = new PDO("mysql:host=localhost;dbname=movie", $root, $password);
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected";    
        $sql = "INSERT INTO `staff`(`Username`, `Password`) VALUES ('$usernames','$passwords')";        
       
           $stmt = $conn->prepare($sql);
           $stmt->bindParam('Name:', $usernames, PDO::PARAM_STR);
           $stmt->bindParam('Password:', $passwords, PDO::PARAM_STR);
           $stmt = $conn->exec($sql);
         


        }
        catch(PDOException $e)
        {
            echo "Did not connect";
        }
        $conn = null;
    
        
      
         
  
         

      
        }
    
  

?>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
    
</body>
</html>