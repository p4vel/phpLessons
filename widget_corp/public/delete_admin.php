<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db_connection.php'; ?>
<?php require_once '../includes/functions.php'; ?>
<?php
	$admin = find_admin_by_id($_GET["id"], $public=false);
	if (!$admin) {
		redirect_to("manage_admins.php");
	}

	/*
	$pages_set = find_pages_for_subject($current_subject["id"]);
	if (mysqli_num_rows($pages_set) > 0) {
		$_SESSION["message"] = "Cant delete a subject with pages.";
		redirect_to("manage_content.php?subject={$current_subject['id']}");
	}
	*/
	$id = $admin["id"];
	$query = "DELETE FROM admins WHERE id = {$id} LIMIT 1";

	$result = mysqli_query($connection, $query);

	if ($result && mysqli_affected_rows($connection) == 1) {
		// success
		// redirect_to("somepage.php");
		$_SESSION["message"] = "admin deleted.";
		redirect_to("manage_admins.php");
	} else {
		// Failure
		$_SESSION["message"] = "admin deletion failed.";
		redirect_to("manage_admins.php");
	}

?>