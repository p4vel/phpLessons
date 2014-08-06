<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php require_once '../includes/validation_functions.php'; ?>
<?php 
	if (isset($_POST["submit"])) {
		// Process the form
		// Often these are form values in $_POST
		$menu_name = mysql_prep($_POST["menu_name"]);
		$subject_id = (int) $_POST["subject_id"];
		$position = (int) $_POST["position"];
		$visible = (int) $_POST["visible"];
		$content = mysql_prep($_POST["content"]);

		// validations
		$required_fields = array("menu_name", "position", "visible");
		validate_presences($required_fields);

		$fields_with_maxlength = array("menu_name" => 30);
		validate_max_length($fields_with_maxlength);

		if (!empty($errors)) {
			$_SESSION["fehler"] = $errors;
			redirect_to("new_page.php");
		}

		$query  = "INSERT INTO pages (";
		$query .= "menu_name, position, visible, content, subject_id";
		$query .= ") VALUES (";
		$query .= "'{$menu_name}', {$position}, {$visible}, '{$content}', {$subject_id}";
		$query .= ")";

		$result = mysqli_query($connection, $query);

		if ($result) {
			// success
			// redirect_to("somepage.php");
			$_SESSION["message"] = "Page created.";
			redirect_to("manage_content.php");
		} else {
			// Failure
			$_SESSION["message"] = "Page creation failed.";
			redirect_to("new_subject.php");
		}
	} else {
		redirect_to("new_page.php");
	}
?>
<?php if(isset($connection)){ mysqli_close($connection);}?>