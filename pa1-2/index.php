<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Bootstrap JS dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDB Movie Database</title>
</head>
<body>
    <div class="container" style="margin-top: 20px;">
        <h1 style="text-align:center">IMDB Movie Database</h1><br>
    </div>
    <div class="container">
		<h3 style="text-align:left">Query Options<span style="font-size: 15px; margin-left: 10px;"><i>Example user for testing: alice.johnson@example.com</i></span></h3><br>

        <form id="ageLimitForm" method="post" action="index.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter user email" name="userEmail" id="userEmail">
				<div class="input-group-append" >
                    <button class="btn btn-outline-secondary" type="submit" name="userLikingMovies" id="button-addon2">User liking movies</button>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="viewAllMovies" id="button-addon2">View all movies</button>
                </div>
				<div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="viewAllActors" id="button-addon2">View all actors</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container">	
		<h3 style="text-align:left">Query Result</h3><br>
		
        <?php
			// we will now create a table from PHP side 
			echo "<table class='table table-md table-bordered'>";
			echo "<thead class='thead-dark' style='text-align: center'>";
	
			if(isset($_POST['userLikingMovies'])){
				$userEmail = $_POST["userEmail"]; 


				if (empty($userEmail)) {
					$userEmail = "";
					$query = "
					SELECT User.email, User.name AS userName, MotionPicture.name
					FROM User
					JOIN Likes ON User.email = Likes.uemail
					JOIN MotionPicture ON Likes.mpid = MotionPicture.id;
					";
				}else{
					$query = "
					SELECT User.email, User.name AS userName, MotionPicture.name
					FROM User
					JOIN Likes ON User.email = Likes.uemail
					JOIN MotionPicture ON Likes.mpid = MotionPicture.id
					WHERE Likes.uemail = '$userEmail';
					";
				}
			

				// initialize table headers for 'view all movies'
				echo "<tr>
				<th class='col-md-2'>user email</th>
				<th class='col-md-2'>user name</th>
				<th class='col-md-2'>movie name</th>
				</tr></thead>";

			}else if(isset($_POST['viewAllMovies'])){

				$query = "
				SELECT MotionPicture.*, Movie.box_office_collection
				FROM Movie
				JOIN MotionPicture ON Movie.mpid = MotionPicture.id;
				";

				// initialize table headers for 'view all movies'
				echo "<tr>
				<th class='col-md-2'>id</th>
				<th class='col-md-2'>name</th>
				<th class='col-md-2'>rating</th>
				<th class='col-md-2'>production</th>
				<th class='col-md-2'>budget</th>
				<th class='col-md-2'>box office collection</th>
				</tr></thead>";
			}else if(isset($_POST['viewAllActors'])){
				$query = "
				SELECT Role.role_name, People.*
				FROM Role
				JOIN People ON Role.pid = People.id
				Where Role.role_name = 'actor'
				";

				// initialize table headers for 'view all movies'
				echo "<tr>
				<th class='col-md-2'>role name</th>
				<th class='col-md-2'>pid</th>
				<th class='col-md-2'>name</th>
				<th class='col-md-2'>nationality</th>
				<th class='col-md-2'>date of birth</th>
				<th class='col-md-2'>gender</th>
				</tr></thead>";
			}

   

			// generic table builder. It will automatically build table data rows irrespective of result
			class TableRows extends RecursiveIteratorIterator {
				function __construct($it) {
					parent::__construct($it, self::LEAVES_ONLY);
				}

				function current() {
					return "<td style='text-align:center'>" . parent::current(). "</td>";
				}

				function beginChildren() {
					echo "<tr>";
				}

				function endChildren() {
					echo "</tr>" . "\n";
				}
			}

			// SQL CONNECTIONS
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "COSI127b";

			try {
				// We will use PDO to connect to MySQL DB. This part need not be 
				// replicated if we are having multiple queries. 
				// initialize connection and set attributes for errors/exceptions
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				// prepare statement for executions. This part needs to change for every query
				$stmt = $conn->prepare($query);

				// execute statement
				$stmt->execute();

				// set the resulting array to associative. 
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

				// for each row that we fetched, use the iterator to build a table row on front-end
				foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
					echo $v;
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			echo "</table>";
			// destroy our connection
			$conn = null;
    
    ?>

    </div>
</body>
</html>
