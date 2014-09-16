<?php 

	define("DB_SERVER", "db537709704.db.1and1.com");
	define("DB_USER", "dbo537709704");
	define("DB_PASS", "drexakQ2Llr?");
	define("DB_NAME", "db537709704");
	// 1. Create a database connection
	// $dbhost = "db537709704.db.1and1.com";
	// $dbuser = "dbo537709704";
	// $dbpass = "drexakQ2Llr?";
	// $dbname = "db537709704";

	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);


	if (mysqli_connect_errno()) {
		die("Database connection failed: " .
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ")"
			);
	}
 ?>