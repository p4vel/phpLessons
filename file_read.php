<?php 

	$file = 'filetest.txt';
	if ($handle = fopen($file, 'r')) { //read
		$content = fread($handle, 6); // each character is 1 byte (roman alphabet)
		fclose($handle);
	}

	echo $content;
	echo "<br />";
	echo nl2br($content);
	echo "<br />";

	// use fileisze() to read the whole file
	$file = 'filetest.txt';
	if ($handle = fopen($file, 'r')) { //read
		$content = fread($handle, filesize($file)); // each character is 1 byte (roman alphabet)
		fclose($handle);
	}

	echo "<hr />";
	echo nl2br($content);
	echo "<br />";

	echo "<hr />";
	echo "<hr />";

	// file_get_contents()	: shortcut for fopen/fread/fclose
	// companion to shortcut file_put_contents()	

	$content = file_get_contents($file);
	echo nl2br($content);
	echo "<hr />";

	// incremental reading
	$file = 'filetest.txt';
	$content = "";
	if ($handle = fopen($file, 'r')) { //read
		while (!feof($handle)) {		// read every sinlge Line
			$content .= fgets($handle);
		}
		fclose($handle);
	}

	echo nl2br($content);
	echo "<hr />";

?>