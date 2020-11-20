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
    <title>Display Movies</title>
    <h1>Display Movies</h1>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width = 100%">
   <link rel="stylesheet" href="stylesheet.css">

    <div class="topnav" id="myTopnav">
    <a href="http://localhost/Project/index.html">Home</a>
    <a href="http://localhost/Project/Display.php">Show Movies</a>
    <a href="http://localhost/Project/Search.php">Search</a>
    <a href="http://localhost/Project/member.php">Members</a>
    <a href="http://localhost/Project/displayAllMembers.php">Display Members</a>
    <a href="http://localhost/Project/Graph.html">Graph</a>
  	
    <i class="fa fa-bars"></i>
    </a>
  </div>
</head>
	 

      
       
<?php

echo "<table style='border: solid 2px black;'>";
echo '<table class="table-striped table-bordered table-responsive table">';
echo "<tr><th>ID</th><th>Title</th><th>Studio</th><th>Status</th><th>Sound</th><th>Versions</th><th>RecRetPrice</th><th>Rating</th><th>Year</th><th>Genre</th><th>Aspect</th><th>Frequency</th></tr>";
class TableRows extends RecursiveIteratorIterator {
 

    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
        return "<td style='width:150px;border:1px solid black;'> " . parent::current(). "</td> ";
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
$stmt = $conn->prepare('SELECT * FROM `movies` WHERE 1');
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
