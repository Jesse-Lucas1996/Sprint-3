<!DOCTYPE HTML>  
<html>
<style>
  html {
  color:black;
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
  <title>Delete Member</title>
      <link rel="stylesheet" href="stylesheet.css">
<style>
.error {color: #FF0000;}
</style>
</head>
<body>
<h1>Delete Members Page</h1>
<div class="topnav" id="myTopnav">
<a href="http://localhost/Project/index.html">Home</a>
    <a href="http://localhost/Project/Display.php">Show Movies</a>
    <a href="http://localhost/Project/search.php">Search</a>
    <a href="http://localhost/Project/member.php">Members</a>
    <a href="http://localhost/Project/displayAllMembers.php">Display Member</a>
	<a href="http://localhost/Project/Graph.html">Graph</a>  
    <i class="fa fa-bars"></i>
  </a>
</div>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = "";
$name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
}
  

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Delete User</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <br><br>
  <input type="submit" name="delete" value="Delete">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;


$username = 'root';
$password = '';
try 
{
  $conn = new PDO('mysql:host=localhost;dbname=moviesdb', $username, $password); 
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare('DELETE FROM `members` WHERE Name = :Name');
  $stmt->bindParam(':Name', $name, PDO::PARAM_STR);
  
  $stmt->execute();

// set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) 
{
  echo 'ERROR: ' . $e->getMessage();
}
?>

</body>
</html>