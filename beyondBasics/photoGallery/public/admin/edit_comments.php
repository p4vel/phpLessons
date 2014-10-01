<?php require_once("../../incl/initialize.php"); ?>
<?php if (!$session->is_logged_in()) {redirect_to("login.php");} ?>
<?php 
	if (empty($_GET['id'])) {
		$session->message("No photograph ID was provided.");
		redirect_to('index.php');
	}

	$photo = Photograph::find_by_id($_GET['id']);
	if (!photo) {
		$session->message("The photo could not be located.");
		redirect_to('index.php');
	} 

	$comments = $photo->comments();

?>

<?php include_layout_template('admin_header.php'); ?>

<?php // Content  START ?>	
<?php echo output_message($message); ?>

<div id="comments">
<?php foreach ($comments as $comment) { ?>
	<div class="comment" style="margin-bottom: 2em;">
		<div class="author"><?php echo htmlentities($comment->author); ?></div>
		<div class="body"><?php echo strip_tags($comment->body, '<strong><em><p>'); ?></div>
		<div class="meta-info"><?php echo datetime_to_text($comment->created); ?></div>
		<div class="actions"><a href="delete_comment.php?id=<?php echo $comment->id ?>">Delete Comment</a></div>
	</div>
<?php } ?>
	<?php if (empty($comment)) { echo "No Comments."; } ?>
</div>

<?php // Content  END ?>	

<?php include_layout_template('admin_footer.php'); ?>
