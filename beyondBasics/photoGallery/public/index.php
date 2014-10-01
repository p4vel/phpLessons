<?php require_once("../incl/initialize.php"); ?>
<?php 

	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	
	// 2. records per page ($per_page)
	$per_page = 3;

	// 3. total record count ($total_count)
	$total_count = Photograph::count_all();

	// Find all Photos
	// use pagination instead
	// $photos = Photograph::find_all();

	$pagination = new Pagination($page, $per_page, $total_count);

	// Instead of finding all records , just find the records 
	// for this page
	$sql  = "SELECT * FROM photographs ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	$photos = Photograph::find_by_sql($sql);

	// NEed to add "?page=$page" to all links we want to
	// maintain the current page (or store $page in $session)

?>

<?php include_layout_template('header.php'); ?>
<?php 
	$table_photos_prolog  = "<table cellpadding=0 cellspacing=0 border=0><tr>";
	echo $table_photos_prolog;

	foreach ($photos as $photo){

		$row  = "<td><figure>";
		$row .= "<a href=\"photo.php?id={$photo->id}\">";
		$row .= "<img src=\"{$photo->image_path()}\" width=250 />";
		$row .= "</a>";
		$row .= "<figcaption>{$photo->caption}</figcaption>";
		$row .= "</figure></td>" ;
		
		echo $row;
	}

	echo "</tr>";
?>

<tr id="pagination"><td colspan=<?php echo $per_page ?> style="text-align: center">
<?php 	
		if ($pagination->total_pages() > 1) {
			
			if ($pagination->has_previous_page()) {
				$prevlink  = "<a href=\"index.php?page=";
				$prevlink .= $pagination->previous_page();
				$prevlink .= "\">&laquo;</a> ";
				echo $prevlink;
			}

			for ($i=1; $i <= $pagination->total_pages(); $i++) { 
				if ($i == $page) {
					echo " <span class=\"page_selected\">{$i}</span> ";	
				}
				else {
					echo " <a href=\"index.php?page={$i}\">{$i}</a> ";
				}
			}

			if ($pagination->has_next_page()) {		
				$nextlink  = " <a href=\"index.php?page=";
				$nextlink .= $pagination->next_page();
				$nextlink .= "\">&raquo;</a>";
				echo $nextlink;
			}
		}

?>
</td></tr>
<?php echo "</table>";s 	 ?>

<?php include_layout_template('footer.php'); ?>

