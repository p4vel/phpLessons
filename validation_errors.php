<!DOCTYPE html>
<html>
<head>
	<title>Validation Errors</title>
</head>
<body>
	<?php 
		require_once('validation_functions.php'); 

		$errors = array();

		$username = trim("Kevin");

		if (!has_presence($username)) {
			$errors['username'] = "Username can't be blank";
		}
	?>

	<?php 
		echo form_errors($errors);
	?>	
</body>
</html>