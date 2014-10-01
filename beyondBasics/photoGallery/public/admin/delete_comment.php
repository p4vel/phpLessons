<?php require_once("../..//incl/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php 
	// must have ID
	if (!isset($_GET['id'])) {
		$session->message("No Comment has been provided.");
		redirect_to("index.php");
	} else {
		$comment = Comment::find_by_id($_GET['id']);
		if ($comment && $comment->delete()) {
			$session->message("The comment {$comment->body} was deleted.");
			redirect_to("edit_comments.php?id={$comment->photograph_id}");
		} else {
			$session->message("The comment could not be deleted.");
			redirect_to("index.php");
		}
	}
?>
<?php if (isset($database)) { $database->close_connection();} ?>