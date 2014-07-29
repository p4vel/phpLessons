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
	// Often these are form values in $_POST
	$id = 6; 

	// 2. Perform database query
	$query  = "DELETE FROM subjects ";
	$query .= "WHERE id = {$id} ";
	$query .= "LIMIT 1";

	$result = mysqli_query($connection, $query);

	// Test if there was a query error
	if ($result && mysqli_affected_rows($connection) == 1) {
		// success
		// redirect_to("somepage.php");
		echo "Success";
	} else {
		// Failure
		// $message = "Subject delete failed"
		die("Database query failed. " . mysqli_error($connection));
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Databases</title>
</head>
<body>
	
</body>
</html>

<?php 
	// 5. Close database connection
	mysqli_close($connection);
?>
