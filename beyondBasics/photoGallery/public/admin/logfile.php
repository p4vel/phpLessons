<?php 
	require_once("../../incl/initialize.php");
	if (!$session->is_logged_in()) {
		redirect_to("login.php");
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
<h3>LOGFILE ...</h3>
<?php 
	$dir_log = SITE_ROOT.DS."logs";
	$filename = "log.txt";
	chdir($dir_log);
	
	if ($_GET['clear'] == true) {
			if ($handle = fopen($filename, 'w')){
				$string = 'test';
				fwrite($handle, $string);
				echo "log file cleared";
				fclose($handle);
			}
	} else {
		// echo getcwd() . "<br />";
		if(!file_exists($filename)){				// if log file doesnt exist, create one
			if ($handle = fopen($filename, 'w')){
				echo "log file created.";
				fclose($handle);
			}
		} else {									// if log file does exist, read content
			if($handle = fopen($filename, 'r')){
				// echo "log file found.";
				// echo is_readable($filename) ? 'yes' : 'no';
				$content = "";
				$counter = 1;
				while (!feof($handle)) {		// read every sinlge Line

					$log_line = fgets($handle);
					$stringposition = strpos($log_line, "|");
					$log_date = substr($log_line, 0, $stringposition);
					$log_msg = substr($log_line, $stringposition+2);

					$content .= "<tr>";
					$content .= "<td class=\"counter\">{$counter}</td>";
					$content .= "<td class=\"log_date\">{$log_date}</td>";
					$content .= "<td class=\"log_msg\">" . $log_msg. "</td>";
					$content .= "</tr>";
					$counter++;
				}
				echo "<table class='log'>";
				// echo "<tr class=\"log_table_head\"><td>&nbsp;</td><td>log</td></tr>";
				echo $content;
				echo "</table>";
		
				echo "<hr />";
				echo "<a href=\"logfile.php?clear=true\">click to clear logfile</a>";
				fclose($handle);
			}
		}
	}

?>


<?php include_layout_template('admin_footer.php');?>