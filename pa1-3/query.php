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

} else if (isset ($_POST['viewPeopleWithAwards'])) {
	$awardNum = $_POST["awardNum"];
	if (empty ($awardNum)) {
		echo "<script>alert('Please enter an award number');</script>";
	} else {
		// remeber to not have same column names
		$query = "
			SELECT p.name, mp.name as 'Motion Picture Name', a.award_year, COUNT(*) as award_count
			FROM Award a
			JOIN People p ON a.pid = p.id
			JOIN MotionPicture mp ON a.mpid = mp.id
			GROUP BY p.name, mp.name, a.award_year
			HAVING COUNT(*) > $awardNum;
		";
	}
	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Person Name</th>
		<th class='col-md-2'>Motion Picture Name</th>
		<th class='col-md-2'>Award Year</th>
		<th class='col-md-2'>Award Count</th>
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
		<th class='col-md-2'>Director Name</th>
		<th class='col-md-2'>TV Series</th>
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
		<th class='col-md-2'>Name</th>
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
		<th class='col-md-2'>Name</th>
		<th class='col-md-2'>Rating</th>
		<th class='col-md-2'>Production</th>
		<th class='col-md-2'>Budget</th>
		</tr></thead>";

} else if (isset ($_POST['viewAllMovies'])) {
	$query = "
		SELECT MotionPicture.*, Movie.box_office_collection
		FROM Movie
		JOIN MotionPicture ON Movie.mpid = MotionPicture.id;
		";

	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>ID</th>
		<th class='col-md-2'>Name</th>
		<th class='col-md-2'>Rating</th>
		<th class='col-md-2'>Production</th>
		<th class='col-md-2'>Budget</th>
		<th class='col-md-2'>Box Office Collection</th>
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
		<th class='col-md-2'>Role name</th>
		<th class='col-md-2'>Pid</th>
		<th class='col-md-2'>Name</th>
		<th class='col-md-2'>Nationality</th>
		<th class='col-md-2'>Date Of Birth</th>
		<th class='col-md-2'>Gender</th>
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

