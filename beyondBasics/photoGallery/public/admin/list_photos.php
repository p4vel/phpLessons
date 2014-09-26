<?php 
require_once("../../incl/initialize.php");
if (!$session->is_logged_in()) {
	redirect_to("login.php");
}
?>
<?php 
	include_layout_template('admin_header.php');
?>




<?php 
	
	echo output_message($message);
	

	// [ ] 	find all data for photos in DB
	// [ ] 	use filename from DB-field to locate all pics listed in DB
	// [ ]	display in table

	
	$photos = Photograph::find_all();

	$table_photos_prolog  = "<table cellpadding=0 cellspacing=0 border=1>";
	$table_photos_prolog .= "<tr style=\"background-color: gray;\">";
	$table_photos_prolog .= "<td>Image</td>";
	$table_photos_prolog .= "<td>Title</td>";
	$table_photos_prolog .= "<td>Caption</td>";
	$table_photos_prolog .= "<td>Size</td>";
	$table_photos_prolog .= "<td>&nbsp;</td>";
	$table_photos_prolog .= "</tr>";
	echo $table_photos_prolog;

	foreach ($photos as $photo){
		$row  = "<tr>";
		$row .= "<td><a target=\"_blank\" href=\"../{$photo->image_path()}\" title=\"Open original image in new window\"><img src=\"../{$photo->image_path()}\" width=\"100\"/><a/a></td>";
		$row .= "<td>{$photo->filename}</td>" ;
		$row .= "<td>{$photo->caption}</td>";
		$row .= "<td>{$photo->size_as_text()}</td>" ;
		$row .= "<td><a href=delete_photo.php?id={$photo->id}>Delete</a></td>";
		$row .= "</tr>";
		echo $row;
	}

	echo "</table>";


?>
	<a href="index.php">back to admin menu</a>
	<a href="photoupload.php" title="Upload Photo">Upload another Photo</a>


<?php 
	include_layout_template('admin_footer.php');
?>