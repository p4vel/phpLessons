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
?>
<?php include_layout_template('header.php'); ?>

<a href="index.php">back</a><br /><br />

<div style="margin-left: 20px"></div>
	<figure>
		<img src="<?php echo $photo->image_path(); ?>" />
		<figcaption><?php echo $photo->caption; ?></figcaption>
	</figure>

<?php include_layout_template('footer.php'); ?>

