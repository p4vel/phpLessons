<?php require_once("../..//incl/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php 
	// must have ID
	if (!isset($_GET['id'])) {
		$session->message("No Photogrpahed has been provided.");
		redirect_to("index.php");
	} else {
		$photo = Photograph::find_by_id($_GET['id']);
		if ($photo && $photo->destroy()) {
			$session->message("The photo {$photo->filename} was deleted.");
			redirect_to("list_photos.php");
		} else {
			$session->message("The photo couldn ot be deleted.");
			redirect_to("index.php");
		}
	}
?>
<?php if (isset($database)) { $database->close_connection();} ?>