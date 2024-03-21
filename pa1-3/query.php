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

} else if (isset ($_POST['viewMoviesToLike'])) {
	$userEmailToLike = $_POST["userEmailToLike"];

	if (empty ($userEmailToLike)) {
		echo "<script>alert('Please enter user email');</script>";
	} else {
		$query = "
		SELECT MotionPicture.name, MotionPicture.rating, MotionPicture.production
		FROM Movie
		JOIN MotionPicture ON Movie.mpid = MotionPicture.id;
		";

		$queryUserLikedMovies = "
			SELECT MotionPicture.name
			FROM MotionPicture
			JOIN Likes ON MotionPicture.id = Likes.mpid
			JOIN User ON User.email = Likes.uemail
			WHERE Likes.uemail = '$userEmail';
		";

	}



	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Name</th>
		<th class='col-md-2'>Rating</th>
		<th class='col-md-2'>Production</th>
		<th class='col-md-2'>Like</th>
		</tr></thead>";

} else if (isset ($_POST['viewProducers'])) {
	$boxOfficeCollection = $_POST["boxOfficeCollection"];
	$budget = $_POST["budget"];

	if (empty ($boxOfficeCollection)) {
		echo "<script>alert('Please enter box office collection');</script>";
	} else if (empty ($budget)) {
		echo "<script>alert('Please enter budget');</script>";
	} else {
		$query = "
			SELECT mp.production, mp.name, m.boxoffice_collection, mp.budget
			FROM Movie m
			JOIN MotionPicture mp ON m.mpid = mp.id
			WHERE m.boxoffice_collection >= $boxOfficeCollection AND mp.budget <= $budget
		";
	}
	echo "<tr>
		<th class='col-md-2'>Producer Name</th>
		<th class='col-md-2'>Movie Name</th>
		<th class='col-md-2'>Box Office Collection</th>
		<th class='col-md-2'>Budget</th>
		</tr></thead>";

} else if (isset ($_POST['viewMoviesToLike'])) {
	$userEmail = $_POST["userEmail"];

	if (empty ($boxOfficeCollection)) {
		echo "<script>alert('Please enter box office collection');</script>";
	} else if (empty ($budget)) {
		echo "<script>alert('Please enter budget');</script>";
	} else {
		$query = "
			SELECT mp.production, mp.name, m.boxoffice_collection, mp.budget
			FROM Movie m
			JOIN MotionPicture mp ON m.mpid = mp.id
			WHERE m.boxoffice_collection >= $boxOfficeCollection AND mp.budget <= $budget
		";
	}
	echo "<tr>
		<th class='col-md-2'>Producer Name</th>
		<th class='col-md-2'>Movie Name</th>
		<th class='col-md-2'>Box Office Collection</th>
		<th class='col-md-2'>Budget</th>
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

} else if (isset ($_POST['viewYoungestAndOldest'])) {
	$query = "
	SELECT name, age
	FROM (
		SELECT 
			p.name,
			YEAR(a.award_year) - YEAR(p.dob) AS age
		FROM 
			People p
			JOIN Award a ON p.id = a.pid
			JOIN MotionPicture mp ON a.mpid = mp.id
	) AS AwardWinners
	WHERE age = (
		SELECT MIN(age) 
		FROM (
			SELECT 
				p.name,
				YEAR(a.award_year) - YEAR(p.dob) AS age
			FROM 
				People p
				JOIN Award a ON p.id = a.pid
				JOIN MotionPicture mp ON a.mpid = mp.id
				JOIN Role r ON p.id = r.pid
				WHERE r.role_name = 'Actor'
		) AS SubQuery
	)
	OR age = (
		SELECT MAX(age) 
		FROM (
			SELECT 
				p.name,
				YEAR(a.award_year) - YEAR(p.dob) AS age
			FROM 
				People p
				JOIN Award a ON p.id = a.pid
				JOIN MotionPicture mp ON a.mpid = mp.id
				JOIN Role r ON p.id = r.pid
				WHERE r.role_name = 'Actor'
		) AS SubQuery
	);
	";



	echo "<tr>
		<th class='col-md-2'>Actor Name</th>
		<th class='col-md-2'>Age</th>
		</tr></thead>";
} else if (isset ($_POST['viewAllMovies'])) {
	$query = "
		SELECT MotionPicture.*, Movie.boxoffice_collection
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

	echo "<tr>
		<th class='col-md-2'>Tables</th>
		</tr></thead>";
} else if (isset ($_POST['ViewTwoThrillerMovies'])) {
	$query = "
	SELECT
    m.name AS movie_name,
    m.rating AS movie_rating
	FROM
		MotionPicture m
	JOIN Movie mo ON 
		m.id = mo.mpid
	JOIN Genre g ON
		m.id = g.mpid
	JOIN Location l ON
		m.id = l.mpid
	WHERE
		g.genre_name = 'Thriller' AND l.city = 'Boston'
	ORDER BY
		m.rating
	DESC
	LIMIT 2;
		";

	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Movie Name</th>
		<th class='col-md-2'>Rating</th>
		</tr></thead>";
} else if (isset ($_POST['ViewWarnerBrosandMarvelActors'])) {
	$query = "
	SELECT
    p.name AS actor_name,
    m.name AS motion_picture_name
	FROM
		People p
	JOIN Role r ON
		p.id = r.pid
	JOIN MotionPicture m ON
		r.mpid = m.id
	JOIN(
		SELECT DISTINCT
			pid
		FROM
			Role
		JOIN MotionPicture ON Role.mpid = MotionPicture.id
		WHERE
			MotionPicture.production = 'Marvel' OR MotionPicture.production =  'Warner Bros'
		GROUP BY
			pid
		HAVING
			COUNT(
				DISTINCT MotionPicture.production
			) = 2
	) AS actor_filter
	ON
		p.id = actor_filter.pid;
		";

	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Actor</th>
		<th class='col-md-2'>Motion Picture</th>
		</tr></thead>";
} else if (isset ($_POST['ViewMotionPicturesWithHigherAvgRating'])) {
	$query = "
	SELECT
    m.name AS movie_name,
    m.rating AS movie_rating
	FROM
		MotionPicture m
	JOIN Genre g ON
		m.id = g.mpid
	WHERE
		g.genre_name = 'comedy' AND m.rating > (
		SELECT
			AVG(m2.rating)
		FROM
			MotionPicture m2
		JOIN Genre g2 ON
			m2.id = g2.mpid
		WHERE
			g2.genre_name = 'comedy')
	ORDER BY
		m.rating
	DESC;

		";

	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Motion Picture</th>
		<th class='col-md-2'>Rating</th>
		</tr></thead>";
} else if (isset ($_POST['viewTopFiveMovieswithHighestNumberofPeoplePlayingRoles'])) {
	$query = "
	SELECT
    m.name AS movie_name,
    COUNT(DISTINCT r.pid) AS people_count,
    COUNT(*) AS role_count
	FROM
		MotionPicture m
	JOIN Role r ON
		m.id = r.mpid
	GROUP BY
		m.id,
		m.name
	ORDER BY
		people_count
	DESC
	LIMIT 5;
		";

	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Movie Name</th>
		<th class='col-md-2'>People Count</th>
		<th class='col-md-2'>Role Count</th>
		</tr></thead>";
} else if (isset ($_POST['viewActorsWithSameBDay'])) {
	$query = "
	SELECT
    p1.name,
    p2.name AS nameTwo,
    p1.dob
	FROM
		People p1
	JOIN People p2 ON
		p1.id > p2.id AND p1.dob = p2.dob
		";

	echo "<tr>
		<th class='col-md-2'>Actor</th>
		<th class='col-md-2'>Actor</th>
		<th class='col-md-2'>Birthday</th>
		</tr></thead>";
} else if (isset ($_POST['viewActorsandMovies'])) {
	$rating = $_POST["rating"];
	if (empty ($rating)) {
		echo "<script>alert('Please enter a rating.');</script>";
	} else {
		$query = "
	SELECT
    p.name AS person_name,
    m.name AS movie_name,
    COUNT(r.role_name) AS role_count
	FROM
		Role r
	JOIN MotionPicture m ON
		r.mpid = m.id
	JOIN People p ON
		r.pid = p.id
	WHERE
		m.rating > $rating
	GROUP BY
		p.name,
		m.name
	HAVING
		COUNT(r.role_name) > 1;
		";
	}
	echo "<tr>
		<th class='col-md-2'>Actor</th>
		<th class='col-md-2'>Motion Picture</th>
		<th class='col-md-2'>Number of Roles</th>
		</tr></thead>";
} else if (isset ($_POST['moviesWithMoreThanXLikesByUsersAgedY'])) {
	$X = $_POST["X"];
	$Y = $_POST["Y"];
	if (empty ($X)) {
		echo "<script>alert('Please enter an X value.');</script>";
	} else if (empty ($Y)) {
		echo "<script>alert('Please enter a Y value.');</script>";
	} else {
		$query = "
	SELECT
    m.name AS movie_name,
    COUNT(l.uemail) AS num_likes
	FROM
		MotionPicture m
	JOIN Likes l ON
		m.id = l.mpid
	JOIN USER u ON
		l.uemail = u.email
	WHERE
		u.age < $Y
	GROUP BY
		m.id,
		m.name
	HAVING
		COUNT(l.uemail) > $X
		";
	}
	// initialize table headers for 'view all movies'
	echo "<tr>
		<th class='col-md-2'>Movie Name</th>
		<th class='col-md-2'>Number of Likes</th>
		</tr></thead>";
}

include 'db.php';

