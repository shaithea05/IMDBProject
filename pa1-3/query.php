<?php
// we will now create a table from PHP side 
echo "<table class='table table-md table-bordered'>";
echo "<thead class='thead-dark' style='text-align: center'>";

if (isset ($_POST['userLikingMovies'])) {
	$userEmail = $_POST["userEmail"];
	if (empty ($userEmail)) {
		echo "<script>alert('Please enter a user.');</script>";
	} else {
		$query = "
			SELECT MotionPicture.name, MotionPicture.rating,  MotionPicture.production,  MotionPicture.budget
			FROM MotionPicture
			JOIN Likes ON MotionPicture.id = Likes.mpid
			JOIN User ON User.email = Likes.uemail
			WHERE Likes.uemail = '$userEmail';
			";
	}
	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>name</th>
		<th class='col-md-2'>rating</th>
		<th class='col-md-2'>production</th>
		<th class='col-md-2'>budget</th>
		</tr></thead>";

} else if (isset ($_POST['viewDirectorsFromZipCode'])) {
	$zipCode = $_POST["zipCode"];
	if (empty ($zipCode)) {
		echo "<script>alert('Please enter a zip code');</script>";
	} else {
		// remeber to not have same column names
		$query = "
			SELECT p.name, mp.name as 'TV series'
			FROM MotionPicture mp
			JOIN Location l ON mp.id = l.mpid
			JOIN Series s ON mp.id = s.mpid
			JOIN Role r ON mp.id = r.mpid
			JOIN People p ON r.pid = p.id
			WHERE l.zip = '$zipCode' AND r.role_name = 'Director';
		";

	}
	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Director name</th>
		<th class='col-md-2'>TV series</th>
		</tr></thead>";

} else if (isset ($_POST['viewMoviesFromLocation'])) {
	$shootingLocation = $_POST["shootingLocation"];
	if (empty ($shootingLocation)) {
		echo "<script>alert('Please enter a location');</script>";
	} else {
		$query = "
			SELECT DISTINCT MotionPicture.name
			FROM MotionPicture
			JOIN Location ON MotionPicture.id = Location.mpid
			WHERE Location.country = '$shootingLocation';
			";
	}
	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>name</th>
		</tr></thead>";

} else if (isset ($_POST['viewMovies'])) {
	$motionPicture = $_POST["motionPicture"];
	if (empty ($motionPicture)) {
		echo "<script>alert('Please enter a movie name.');</script>";
	} else {
		$query = "
			SELECT MotionPicture.name, MotionPicture.rating,  MotionPicture.production,  MotionPicture.budget
			FROM MotionPicture
			WHERE MotionPicture.name = '$motionPicture';
			";
	}
	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>name</th>
		<th class='col-md-2'>rating</th>
		<th class='col-md-2'>production</th>
		<th class='col-md-2'>budget</th>
		</tr></thead>";

} else if (isset ($_POST['viewAllMovies'])) {
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
} else if (isset ($_POST['viewAllActors'])) {
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
} else if (isset ($_POST['viewAllTables'])) {
	$query = "
		SHOW TABLES;
		";

	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Tables</th>
		</tr></thead>";
}

include 'db.php';

