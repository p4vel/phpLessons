<?php 
	require_once("included_functions.php");
	require_once("validation_functions.php");

	$errors = array();
	$message = "";

	if (isset($_POST['submit'])) {
		// Form was submitted
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		// Validations
		$fields_required = array("username", "password");

		foreach ($fields_required as $field) {
			$value = trim($_POST[$field]);
			if (!has_presence($value)) {
					$errors[$field] = ucfirst($field) . " can't be blank";
				}
		}

		// USing an assoc array
		$fields_with_max_length = array("username" => 30, "password" => 8);
		validate_max_length($fields_with_max_length);

		if (empty($errors)) {
			// try to login
			if ($username == "Kevin" && $password == "secret") {
				// successful login
				redirect_to("floats.php");
			} else {
				$message = "Username/Password do not match.";
			}
		}			
	} else {
		$username = ""	;
		$message = "Please log in.";
	}
?>
<html>
	<head>
		<title>Strings</title>
	</head>
	<body>

	<?php echo $message; ?>
	<?php echo form_errors($errors); ?>
		<form action="form_with_validation.php" method="post">
			Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" />
			Password: <input type="password" name="password" value="" />
			<br />
			<input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>