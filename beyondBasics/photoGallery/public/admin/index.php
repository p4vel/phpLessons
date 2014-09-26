<?php 
require_once("../../incl/initialize.php");
if (!$session->is_logged_in()) {
	redirect_to("login.php");
}
?>
<?php 
	include_layout_template('admin_header.php');
?>
	<h2>Menu</h2>
	<a href="logfile.php">view logfile</a>
	<a href="logout.php">Logout</a>
	<a href="photoupload.php">Upload Photos</a>
	<a href="list_photos">View Photos</a>
<?php 
	include_layout_template('admin_footer.php');
?>