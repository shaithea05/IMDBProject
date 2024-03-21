<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" type="image/x-icon" href="">
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
		<h3 style="text-align:left">Query Options</h3><br>

		<form id="ageLimitForm" method="post" action="index.php">

			<!-- buttons without parameterized queries -->
			<div class="input-group mb-3">
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="viewAllActors" id="button-addon2">View all actors</button>
				</div>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="viewAllTables" id="button-addon2">View all tables</button>
				</div>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="viewAllMovies" id="button-addon2">View all movies</button>
				</div>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="ViewTwoThrillerMovies" id="button-addon2">View the top 2 rated thriller movies that were shot exclusively in Boston</button>
				</div>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="ViewWarnerBrosandMarvelActors" id="button-addon2">View the actors who have played a role in both “Marvel” and “Warner Bros” productions</button>
				</div>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="ViewMotionPicturesWithHigherAvgRating" id="button-addon2">View motion pictures that have a higher rating than the average rating of all comedy motion pictures</button>
				</div>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="viewTopFiveMovieswithHighestNumberofPeoplePlayingRoles" id="button-addon2">View the top 5 movies with the highest number of people playing a role in that movie</button>
				</div>
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" type="submit" name="viewActorsWithSameBDay" id="button-addon2">View actors who share the same birthday</button>
				</div>

					<button class="btn btn-outline-secondary" type="submit" name="viewYoungestAndOldest" id="button-addon2">View youngest and oldeset actor to win an award</button>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<h6>Filter movies liked by a user</h6>
				</div>
				<div class="col">
					<h6>Search movie details</h6>
				</div>
			</div>

			<!-- buttons with parameterized queries -->
			<div class="row">
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter user email" name="userEmail" id="userEmail">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="userLikingMovies" id="button-addon2">View movies</button>
				</div>
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter movie name" name="motionPicture" id="motionPicture">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="viewMovies" id="button-addon2">View movie details</button>
				</div>
			</div>

			<div style="padding-bottom: 20px;"></div>

			<div class="row">
				<div class="col">
					<h6>Filter movies by shooting location</h6>
				</div>
				<div class="col">
					<h6>Filter directors by shooting location zip</h6>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter country" name="shootingLocation" id="shootingLocation">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="viewMoviesFromLocation" id="button-addon2">View Movies</button>
				</div>
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter zip code" name="zipCode" id="zipCode">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="viewDirectorsFromZipCode" id="button-addon2">View directors</button>
				</div>
			</div>

			<div style="padding-bottom: 20px;"></div>
			
			<div class="row">
				<div class="col">
					<h6>Find people who have received more than k awards in a single motion picture in the same year</h6>
				</div>
				<div class="col">
					<h6>Place holder</h6>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter number of awards" name="awardNum" id="awardNum">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="viewPeopleWithAwards" id="button-addon2">View people</button>
				</div>
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter user email" name="userEmail" id="userEmail">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="viewMoviesToLike" id="button-addon2">View Movies</button>
				</div>
			</div>

			<div style="padding-bottom: 20px;"></div>

			<div class="row">
				<div class="col">
					<h6>Find all the people who have played multiple roles in a motion picture where the rating is more than “X”</h6>
				</div>
				<div class="col">
					<h6>Find all the movies with more than “X” likes by users of age less than “Y”</h6>

			<div class="row">
				<div class="col">
					<h6>American Producers who had a box office collection of more than or equal to “X” with a budget less than or equal to “Y”.</h6>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter rating" name="rating" id="rating">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="viewActorsandMovies" id="button-addon2">View Actors and Movies</button>
				</div>
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter X and Y" name="moviesWithMoreThanXLikesByUsersAgedY" id="moviesWithMoreThanCLikesByUsersAgedY">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="z" id="button-addon2">Find!</button>
				</div>
			</div>

					<input type="text" class="form-control" placeholder="Enter box office collection" name="boxOfficeCollection" id="boxOfficeCollection">
				</div>
				<div class="col">
					<input type="text" class="form-control" placeholder="Enter budget" name="budget" id="budget">
				</div>
				<div class="col">
					<button class="btn btn-outline-secondary" type="submit" name="viewProducers" id="button-addon2">View producers</button>
				</div>
			</div>

			<div style="padding-bottom: 20px;"></div>

		</form>
	</div>
	
	<div class="container">	
		<h3 style="text-align:left">Query Result</h3><br>
		<?php include 'query.php'; ?>
	</div>
</body>
</html>
