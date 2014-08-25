<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/validation_functions.php'; ?>
<?php confirm_logged_in(); ?>
<?php $admin = find_admin_by_id($_GET["id"]); ?>
<?php 
	if (!$admin) {
		redirect_to("manage_admins.php");
	}
?>
<?php
if (isset($_POST["submit"])) {
		// Process the form
		// Often these are form values in $_POST

		// validations
		$required_fields = array("username", "password");
		validate_presences($required_fields);

		$fields_with_maxlength = array("username" => 30);
		validate_max_length($fields_with_maxlength);

		if (empty($errors)) {
			// Perform Update
			// print_r($_POST);

			$id = $admin["id"];
		
			$username = mysql_prep($_POST["username"]);
			$hashed_password = md5($_POST["password"]);
		

			$query  = "UPDATE admins SET ";
			$query .= "username = '{$username}', ";
			$query .= "hashed_password = '{$hashed_password}' ";
			$query .= "WHERE id = {$id} ";
			$query .= "LIMIT 1";
			// var_dump($query);
			$result = mysqli_query($connection, $query);

			if ($result && mysqli_affected_rows($connection) >= 0) {
				// success
				// redirect_to("somepage.php");
				$_SESSION["message"] = "admin updated.";
				redirect_to("manage_admins.php");
			} else {
				// Failure
				$_SESSION["message"] = "admin update failed.";
			}
		}
	} else {
		// redirect_to("new_subject.php");
	}	// end: if (isset($_POST["submit"]))
 ?>
 <?php $layout_context = 'admin'; ?>
<?php include '../includes/layouts/header.php'; ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php 
			if(!empty($message)){
				echo "<div class=\"message\">" . htmlentities($message) . "</div>";	
			}
		?>
		<?php echo form_errors($errors); ?>
		<h2>Edit Admin</h2>
		<form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
			<p>
				Username:
				<input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" />
			</p>
			<p>
				Password:
				<input type="password" name="password" value=""/>
			</p>
			<input type="submit" name="submit" value="Edit Admin" />
		</form>
		<br />
		<a href="manage_admins.php">Cancel</a>
		
	</div>
</div>

<?php include '../includes/layouts/footer.php'; ?>