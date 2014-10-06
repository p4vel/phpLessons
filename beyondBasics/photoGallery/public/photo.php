<?php require_once("../incl/initialize.php"); ?>
<?php 
	if (empty($_GET['id'])) {
		$session->message("No photograph ID was submitted.");
		redirect_to("index.php");
	}

	$photo = Photograph::find_by_id($_GET['id']);
	if(!$photo){
		$session->message("The photo could not be located.");
		redirect_to("index.php");
	}

	// form processing

	 if(isset($_POST['submit'])){
	 	$author = trim($_POST['author']);
	 	$body = trim($_POST['body']);

	 	$new_comment = Comment::make($photo->id, $author, $body);

	 	if ($new_comment && $new_comment->save()) {
	 		// comment saved
	 		// No message needed; seeing the comment itself is proof enough 

	 		// send email !!
	 		$new_comment->try_send_notification();

	 		// Important!!! You could just let the page render from here.
	 		// But then if the page is reloaded, the form will try
	 		//  to resubmit the comment. So redirect instead:
	 		redirect_to("photo.php?id={$photo->id}");
	 	} else {
	 		// failure, comment not saved
	 		$message = "There was an error that prevented the comment from being saved.";
	 	}

	 } else {
	 	$author	= "";
	 	$body = "";
	 }


	 // $comments = Comment::find_comments_on($photo->id);
	 $comments = $photo->comments();

	 // echo "<pre>";
	 // var_dump($comments);
	 // echo "</pre>";
	 // die();

?>
<?php include_layout_template('header.php'); ?>

<a href="index.php">back</a><br /><br />

<div style="margin-left: 20px">
	<figure>
		<img src="<?php echo $photo->image_path(); ?>" />
		<figcaption><?php echo $photo->caption; ?></figcaption>
	</figure>
</div>

<!-- list comments START-->

<div id="comments">
	<?php foreach ($comments as $comment) { ?>
		<div class="comment" style="margin-bottom: 2em;">
			<div class="author">
				<?php echo htmlentities($comment->author);?> wrote: 
			</div>
			<div class="body">
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
			<div class="meta-info">
				<?php echo datetime_to_text($comment->created); ?>
			</div>
		</div>
	<?php } ?>
	<?php if (empty($comments)) { echo "No Comments"; } ?>
</div>


<!-- list comments END-->

 
<div id="comment-form">
	<h3>New Comment</h3>
	<?php echo output_message($message); ?>
	<form action="photo.php?id=<?php echo $photo->id; ?>" method="post">
		<table>
			<tr>
				<td>Your Name:</td>
				<td><input type="text" name="author" value="<?php echo $author;?>" /></td>
			</tr>
			<tr>
				<td>Your comment:</td>
				<td><textarea type="text" name="body" rows=8><?php echo $body; ?></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Submit Comment" /></td>
			</tr>
		</table>
		
	</form>
</div>


<?php include_layout_template('footer.php'); ?>

