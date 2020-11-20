<!DOCTYPE html>
<html lang="en" width = "100%">
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
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width = 100%">
    <link rel="stylesheet" href="stylesheet.css">
    
	</head>


        <main class="col-lg-10">
            <!-- 10 here  -->
            <h1>Put in A Title Or Genre or Year Or Mix and Match</h1>
            <div class="topnav" id="myTopnav">
<a href="http://localhost/Project/index.html">Home</a>
    <a href="http://localhost/Project/Display.php">Show Movies</a>
    <a href="http://localhost/Project/search.php">Search</a>
    <a href="http://localhost/Project/member.php">Members</a>
    <a href="http://localhost/Project/displayAllMembers.php">Display Members</a>
	<a href="http://localhost/Project/Graph.html">Graph</a>  
    <i class="fa fa-bars"></i>
  </a>
</div>  
            <p>Input the movie details below.</p>
            <form action="search.php" method="post">
                
				<div class="form-group">
                    <label for="title">Title:</label>
					 
                    <input type="text" id="title" name="title">
					</div>
					 <div class="form-group">
                    <label for="Rating">Rating:</label>
                    <input type="text" id="rating" name="rating">  
					</div>					
					 <div class="form-group">
                    <label for="genre">Genre:</label>
                    <input type="text" id="genre" name="genre">
					</div>
					 <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year">
					</div>

               
                <button type="submit" name="submit" 
                class="btn btn-default" value="Search">Search</button>
            </form>
            
            
            <?php

            $sql = "";
            $sql2="";
            
            if (isset($_POST['submit'])) 
            {
                $error_msg = "";
                $title = $_POST['title'];
                $genre = $_POST['genre'];
                $year = $_POST['year'];
                $rating = $_POST['rating'];


                if (!empty($_POST['title']) && !empty($_POST['genre']) && !empty($_POST['year']) && empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE 
                    title = '$title' AND genre = '$genre'
                    AND year = '$year'";
                }
				if (empty($_POST['title']) && empty($_POST['genre']) && empty($_POST['year']) && !empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE 
                    Rating = '$rating'";
                }

                if (!empty($_POST['title']) && !empty($_POST['genre']) && empty($_POST['year']) && empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE 
                    title = '$title' AND genre = '$genre'";
                }
                if (!empty($_POST['title']) && !empty($_POST['genre']) && empty($_POST['year']) && !empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE 
                    title = '$title' AND genre = '$genre' AND Rating = '$rating'";
                }

                if (!empty($_POST['title']) && empty($_POST['genre']) && !empty($_POST['year']) && empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE 
                    title = '$title' AND year = '$year'";
                }
                
                if (empty($_POST['title']) && !empty($_POST['genre']) && !empty($_POST['year']) && !empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE 
                    genre = '$genre' AND year = '$year' AND Rating = '$rating'";
                }

                if (!empty($_POST['title']) && empty($_POST['genre']) && empty($_POST['year']) && empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE 
                    title = '$title'";
                }
                

                if (empty($_POST['title']) && !empty($_POST['genre']) && empty($_POST['year']) && empty($_POST['rating']))
                {
                    $sql = "SELECT * FROM `movies` WHERE genre = '$genre'";
                }

                if (empty($_POST['title']) && empty($_POST['genre']) && !empty($_POST['year']) && empty($_POST['rating']))
                {
                    $sql = "SELECT *  FROM `movies` WHERE year = '$year'";
                }
                if (empty($_POST['title']) && !empty($_POST['genre']) && empty($_POST['year']) && !empty($_POST['rating']))
                {
                    $sql = "SELECT *  FROM `movies` WHERE genre = '$genre' AND Rating = '$rating'";
                }
                if (!empty($_POST['title']) && empty($_POST['genre']) && empty($_POST['year']) && !empty($_POST['rating']))
                {
                    $sql = "SELECT *  FROM `movies` WHERE Title = '$title' AND Rating = '$rating'";
                }

                if (empty($_POST['title']) && empty($_POST['genre']) && empty($_POST['year']) && empty($_POST['rating']))
                {
                    $error_msg = "Please Enter Something To Search!";
                }
                if (!empty($_POST['title']))
                {
                    $sql2 = "UPDATE `movies` SET Frequency = `Frequency` + 1 WHERE Title = '$title'";
                }

                if (!empty($error_msg)) 
                {
                    echo "<p>Error: </p>" . $error_msg;
                    echo "<p>Please go <a href='search.php'>back</a> 
                    and try again</p>";
                } 
                else 
                {
                    

                    $submit = $_POST['submit'];

                    if ($submit == "Search") {
                        echo "<table style='border: solid 2px black;'>";
						echo '<table class="table-striped table-bordered table-responsive table">';
                    echo "<tr><th>ID</th><th>Title</th><th>Studio</th><th>Status</th><th>Sound</th><th>Versions</th><th>RecRetPrice</th><th>Rating</th><th>Year</th><th>Genre</th><th>Aspect</th><th>Frequency</th></tr>";

                    class TableRows extends RecursiveIteratorIterator
                    {
                        function __construct($it)
                        {
                            parent::__construct($it, self::LEAVES_ONLY);
                        }

                        function current()
                        {
                            return "<td style='width:300px;border:2px solid black;'>" . parent::current() . "</td>";
                        }

                        function beginChildren()
                        {
                            echo "<tr>";
                        }

                        function endChildren()
                        {
                            echo "</tr>" . "\n";
                        }
						function Responsive()
						{
							echo "</table> width 100%";
						}
                    }

                    $servername = "localhost";
                    $dbname = "moviesdb";
                    $username = "root";
                    $password = "";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        
                        

                        
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                            echo $v;
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                    if (!empty($_POST['title']))
                    {
                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare($sql2);
                            $stmt->execute();
                            
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                    }
                }
            }
            } 
            ?>
        </main>
    </div> 

</body>

</html>
