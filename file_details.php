<?php 

	$filename = 'filetest.txt';

	echo filesize($filename). "<br />"; // in bytes

	// filemtime: last modified (changed content)
	// filectime: last changed (changed content or metdata)
	// fileatime: last accessed (any read/change)

	echo strftime('%m/%d/%Y %H:%M', filemtime($filename)) . "<br />";
	echo strftime('%m/%d/%Y %H:%M', filectime($filename)) . "<br />";
	echo strftime('%m/%d/%Y %H:%M', fileatime($filename)) . "<br />";

	// touch($filename);	// set all times to current time

	// following lines will show cached times
	// reload page to see the effect of touch()

	echo strftime('%m/%d/%Y %H:%M', filemtime($filename)) . "<br />";
	echo strftime('%m/%d/%Y %H:%M', filectime($filename)) . "<br />";
	echo strftime('%m/%d/%Y %H:%M', fileatime($filename)) . "<br />";

	$path_parts = pathinfo(__FILE__);	// returns array

	echo "<hr /><pre>";

	echo var_dump($path_parts);

	echo "</pre>";
	// echo $path_parts['dirname'] . "<br />"; 	// "/folder/subfolder/subfolder"
	// echo $path_parts['basename'] . "<br />";	// "file_details.php"
	// echo $path_parts['filename'] . "<br />";	// "file_details.php" (since PHP 5.2)
	// echo $path_parts['extension'] . "<br />";	// "php"
?>