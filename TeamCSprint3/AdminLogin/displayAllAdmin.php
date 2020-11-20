<!DOCTYPE html>
<html lang="en" width = "100%" height = "100%">
<style>
html {
  color:white;
}

h1 {
  font-family: verdana;
  color: white;
  text-align: center;
}

h2 {
  font-family: verdana;
  color: black;
  text-align: left;
}

h3 {
  font-family: verdana;
  color: black;
  text-align: left;
}

div {
  border-radius: 5px;
  background-color: #add8e6;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  font-family: verdana;
  color: black;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4169E1;
  color: white;
}
</style>

<head>
    <title>Search Page</title>
    <h1>Display Admins</h1>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
   <meta name="viewport" content="width=device-width = 100%">
   <link rel="stylesheet" href="stylesheet.css">

    <div class="topnav" id="myTopnav">
    <a href="http://localhost/AdminLogin/index.html">Home</a> 
<a href="http://localhost/AdminLogin/register.php">Admin Register</a>  	
    <a href="http://localhost/AdminLogin/login.php">Admin Login</a> 
    <a href="logout.php">Sign Out of Your Account</a>	
    <i class="fa fa-bars"></i>
    </a>
  </div>
  
</head>
	 

      
       
<?php

echo "<table style='border: solid 2px black;'>";
echo '<table class="table-striped table-bordered table-responsive table">';
echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>";
class TableRows extends RecursiveIteratorIterator {
 

    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td style='width:100%;border:1px solid black;'> " . parent::current(). "</td> ";
    }
    function beginChildren() {
        echo "<tr> ";
    }
    function endChildren() {
        echo "</tr> " . "\n";
    }
	function responsive(){
	echo '</table> width 100%';
	}
	
} 
$username = 'root';
$password = '';
try 
{
$conn = new PDO('mysql:host=localhost;dbname=moviesdb', $username, $password); 
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare('SELECT * FROM `Staff` WHERE 1');
$stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchall())) as $k=>$v) {
        echo $v;
}
}

catch(PDOException $e) 
{
  echo 'ERROR: ' . $e->getMessage();
}
$conn = null;



?>

      </main>
    </div>

</body>
</html>