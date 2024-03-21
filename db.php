
<?php
session_start();

// generic table builder. It will automatically build table data rows irrespective of result
class TableRows extends RecursiveIteratorIterator
{

	private $showButton = false;
	private $name = "";

	function __construct($it, $showButton)
	{
		parent::__construct($it, self::LEAVES_ONLY);
		$this->showButton = $showButton;
	}

	function current()
	{
		if ($this->key() === "name") {
			$this->name = parent::current();
		}
		return "<td style='text-align:center'>" . parent::current() . "</td>";
	}

	function beginChildren()
	{
		echo "<tr>";
	}

	function endChildren()
	{

		if ($this->showButton) {
			$_SESSION['movieName'] = $this->name;

			echo "<td><button class='btn btn-outline-secondary' onclick='openPopup(\"$this->name\")' style='width:100%;' type='submit' name='likeButton' id='button-addon2'>Like</button></td>";

		}
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
	$showButton = false;

	if ($queryUserLikedMovies) {
		$showButton = true;
	}


	// execute statement
	$stmt->execute();

	// set the resulting array to associative. 
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

	if ($stmt->rowCount() == 0) {
		echo "<h4>No results or already inserted. Please try again.</h4>";
	} else {	// for each row that we fetched, use the iterator to build a table row on front-end
		foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll()), $showButton) as $k => $v) {
			echo $v;
		}
	}

} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
echo "</table>";
// destroy our connection
$conn = null;

?>