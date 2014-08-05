<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/validation_functions.php'; ?>
<?php 
	if (isset($_POST["submit"])) {
		// Process the form
		// Often these are form values in $_POST
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];

		// validations
		$required_fields = array("menu_name", "position", "visible");
		validate_presences($required_fields);

		$fields_with_maxlength = array("menu_name" => 30);
		validate_max_length($fields_with_maxlength);

		if (!empty($errors)) {
			$_SESSION["fehler"] = $errors;
			redirect_to("new_subject.php");
		}

		$query  = "INSERT INTO subjects (";
		$query .= "menu_name, position, visible";
		$query .= ") VALUES (";
		$query .= "'{$menu_name}', {$position}, {$visible}";
		$query .= ")";

		$result = mysqli_query($connection, $query);

		if ($result) {
			// success
			// redirect_to("somepage.php");
			$_SESSION["message"] = "Subject created.";
			redirect_to("manage_content.php");
		} else {
			// Failure
			$_SESSION["message"] = "Subject creation failed.";
			redirect_to("new_subject.php");
		}
	} else {
		redirect_to("new_subject.php");
	}
?>
<?php if(isset($connection)){ mysqli_close($connection);}?>