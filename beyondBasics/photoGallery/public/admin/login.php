<?php 
require_once("../../incl/initialize.php");

if ($session->is_logged_in()) {
	redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	// Check database to see if username/password exist
	$found_user = User::authenticate($username, $password);

	if ($found_user) {
		$session->login($found_user);
		redirect_to("index.php");
	} else {
		// username/password comb was not found in the database
		$message = "Username/Password combination incorrect !";
	}
} else { // form has NOT been submitted
	$username = "";
	$password = "";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Photo Gallery</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
	<div id="header">
		<h1>Photo Gallery</h1>
	</div>
	<div id="main">
		<h2>Staff Login</h2>
		<?php echo output_message($message); ?>
		<form action="login.php" method="post">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" maxlength="30" value="<?php echo htmlentities($usernmane)?>" /></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password) ?>" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Login" />				
					</td>
				</tr>
			</table>	
		</form>
	</div>
	<div id="footer">Copyright <?php echo date("Y", time()); ?>, 11plus12</div>

</body>
</html>
<?php if (isset($database)) {$database->close_connection(); } ?>