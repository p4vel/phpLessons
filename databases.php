<?php 
	// 1. Create a database connection
	$dbhost = "localhost";
	$dbuser = "mczerny";
	$dbpass = "start123";
	$dbname = "lynda_com";

	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


	if (mysqli_connect_errno()) {
		die("Database connection failed: " .
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ")"
			);
	}
 ?>

<?php  
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE visible = 1 ";
	$query .= "ORDER BY position ASC";


	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Databases</title>
</head>
<body>
	<ul>
		<?php 
			// 3. Use returned data (if any)
		while ($subject = mysqli_fetch_assoc($result)) {
			// var_dump($row);
		?>
			<li><?php echo $subject['menu_name'] . " (" . $subject["id"] . ")"; ?></li>
		<?php 
		}
		?>

		<?php 
			// 4. Release returned data
			mysqli_free_result($result);
		?>
	</ul>
</body>
</html>

<?php 
	// 5. Close database connection
	mysqli_close($connection);
?>
