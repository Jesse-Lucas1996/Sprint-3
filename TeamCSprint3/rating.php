<!DOCTYPE html>
<html lang="en" width = "100%" height = "100%">
<head>
	<style>
	h2 {text-align: center;}
	</style>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<title>ACME SPRINT THREE</title>

<body>
  <h1>Home Page</h1>
<div class="topnav" id="myTopnav">
  
    <a href="http://localhost/Project/index.html">Home</a>
    <a href="http://localhost/Project/Display.php">Show Movies</a>
    <a href="http://localhost/Project/search.php">Search</a>
    <a href="http://localhost/Project/member.php">Members</a>
  <a href="http://localhost/Project/Graph.html">Graph</a>
  <a href="http://localhost/Project/rating.php">Rate a Movie</a>  	
<i class ="fa fa-bars"></i>
   
  </div>
  <h2>Rate a Movie</h2>
  </div>  
  <form action="rating.php" method="post">
            <p>Input the movie details below.</p>
				<div class="form-group">
                    <label for="title">Title:</label>
					 
                    <input type="text" id="title" name="title">
                    </div>
</body>
<div id="wrapper">
  <form action="" method="post">
    <p class="clasificacion">
       <input id="radio1" type="radio" name="estrellas" value="5"><!--
      --><label for="radio1">&#9733;</label><!--
      --><input id="radio2" type="radio" name="estrellas" value="4"><!--
      --><label for="radio2">&#9733;</label><!--
      --><input id="radio3" type="radio" name="estrellas" value="3"><!--
      --><label for="radio3">&#9733;</label><!--
      --><input id="radio4" type="radio" name="estrellas" value="2"><!--
      --><label for="radio4">&#9733;</label><!--
      --><input id="radio5" type="radio" name="estrellas" value="1"><!--
      --><label for="radio5">&#9733;</label>
    </p>
    <p>
    <button type="submit" name="submit" id = "submit"
                    class="btn btn-default" value="Search">Search</button>
  
    </p>
  </form>
</div>
<div>

	<img src = "ratinggraph.php" alt = "Chart of top 10 movies" width = "100%" height = "700"/>

</div>
</html>
<?php
if (isset($_POST['submit'])) 
{	
    $found = false;
    $error_msg = "";
    $title = $_POST['title'];
    $rating = $_POST['estrellas'];
    
    $sql = "SELECT Title FROM `movies` WHERE Title = '$title'";
    
    $servername = "localhost";
    $dbname = "movie";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare($sql);
        $stmt->execute();
       
        $result = $stmt->fetchAll();
        
        if($result = $title)
        {
        $found = true;
			echo "found";
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    if($found = true)
    {
        
        $sql1 = "UPDATE `movies` SET `Star Rating` = '$rating' WHERE `Title` = '$title'";
		echo $rating;

    try {
        $conn = new PDO("mysql:host=localhost;dbname=movie", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
        $stmt2 = $conn->prepare($sql1);

        $stmt2->execute();
		

        
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
	
    }

	
}
?>
	<meta http-equiv="refresh" content="20">
