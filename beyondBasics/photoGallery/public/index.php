<?php require_once("../incl/initialize.php"); ?>
<?php include_layout_template('header.php'); ?>

<?php 
	// Find all Photos
	$photos = Photograph::find_all();

	$table_photos_prolog  = "<table cellpadding=0 cellspacing=0 border=1><tr>";
	echo $table_photos_prolog;

	foreach ($photos as $photo){

		$row  = "<td><figure>";
		$row .= "<a href=\"photo.php?id={$photo->id}\">";
		$row .= "<img src=\"{$photo->image_path()}\" height=100 />";
		$row .= "</a>";
		$row .= "<figcaption>{$photo->caption}</figcaption>";
		$row .= "</figure></td>" ;
		
		echo $row;
	}

	echo "</tr></table>";
?>

<?php include_layout_template('footer.php'); ?>

