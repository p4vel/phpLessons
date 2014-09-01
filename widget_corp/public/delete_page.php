<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php confirm_logged_in(); ?>
<?php
	$current_page = find_page_by_id($_GET["page"], $public=false);
	if (!$current_page) {
		redirect_to("manage_content.php");
	}

	/*
	$pages_set = find_pages_for_subject($current_subject["id"]);
	if (mysqli_num_rows($pages_set) > 0) {
		$_SESSION["message"] = "Cant delete a subject with pages.";
		redirect_to("manage_content.php?subject={$current_subject['id']}");
	}
	*/
	$id = $current_page["id"];
	$query = "DELETE FROM pages WHERE id = {$id} LIMIT 1";

	$result = mysqli_query($connection, $query);

	if ($result && mysqli_affected_rows($connection) == 1) {
		// success
		// redirect_to("somepage.php");
		$_SESSION["message"] = "page deleted.";
		redirect_to("manage_content.php");
	} else {
		// Failure
		$_SESSION["message"] = "page deletion failed.";
		redirect_to("manage_content.php?page={$id}");
	}

?>