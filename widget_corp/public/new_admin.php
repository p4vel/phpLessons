<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/validation_functions.php'; ?>
<?php 

if (isset($_POST['submit'])) {
	// Process the Form

	// validations
	$required_fields = array("username", "password");
	validate_presences($required_fields);

	$fields_with_max_length = array("username" => 30);
	validate_max_length($fields_with_max_length);

	if(empty($errors)){
		// perform creation

		$username = mysql_prep($_POST["username"]);
		$hashed_password = mysql_prep($_POST["password"]);

		$query 	= "INSERT INTO admins (";
		$query .= " username, hashed_password";
		$query .= ") VALUES (";
		$query .= " '{$username}', '{$hashed_password}'";
		$query .= ")";
		$result = mysqli_query($connection, $query);

		if($result){
			// success
			$_SESSION["message"] = "Admin created";
			redirect_to("manage_admins.php");
		} else {
			// failure
			$_SESSION["message"] = "Admin creation failed!";
		}
	} else {
		// possible get request?
	}
} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include '../includes/layouts/header.php'; ?>
<?php find_selected_page() ?>

<div id="main">
	<div id="navigation">
		<?php  echo navigation($current_subject, $current_page);  ?>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<h2>Create Admin</h2>
		<form action="new_admin.php" method="post">
			<p>
				<input type="text" name="username" value="" />
			</p>
			<p>
				<input type="password" name="password" value="" />
			</p>

			<input type="submit" name="submit" value="Create Admin" />
		</form>
		<br />
		<a href="manage_admins.php">Cancel</a>
	</div>
</div>

<?php include '../includes/layouts/footer.php'; ?>