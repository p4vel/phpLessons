<?php 
	require_once("../../incl/initialize.php");
	if (!$session->is_logged_in()) {
		redirect_to("login.php");
	}
?>
<?php 
	if ($_GET['clear'] == 'true') {
		if ($handle = fopen($log->logfile, 'w')){
			file_put_contents($log->logfile, '');
			$log->log_action("Logs Cleared", "by User ID {$session->user_id}");
			redirect_to('logfile.php');
		}
	} 
 ?>		
<?php include_layout_template('admin_header.php');?>
<!-- 
	[x] 	locate logs/log.txt useing SITE_ROOT and DS
	[x] 	file exists?
	[x] 	file is readable?
	[x] 	output entries to HTML 
-->

<h2>Menu</h2>
<h3>LOGFILE ... (<a href="logfile.php?clear=true">Clear Logfile</a>)</h3>
<?php 

	

	if (file_exists($log->logfile) && is_readable($log->logfile) && $handle = fopen($log->logfile, 'r')) {
		echo "<ul class=\"log-entries\">";
		while (!feof($handle)) {
			$entry = fgets($handle);
			echo "<li>{$entry}</li>";
		}
		echo "</ul>";
		fclose($handle);
	} else {
		echo "Couldn't read from {$log->logfile}";
	}


?>


<?php include_layout_template('admin_footer.php');?>