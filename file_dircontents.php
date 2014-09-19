<?php 

	// like fopen/fread/flcose:
	// opendir()
	// readdir()
	// closedir()

	 $dir = ".";
	// if (is_dir($dir)) {
	// 	if ($dir_handle = opendir($dir)) {
	// 		while ($filename = readdir($dir_handle)) { 	// returning next item inside of the directory
	// 			echo "filename: {$filename}<br />" ;	// as a pointer moving through the directory
	// 		}
	// 		// use rewinddir($dir_handle) to start over
	// 	closedir($dir_handle);
	// 	}
	// }

	// scandir(): reads alle filenames into an array
	if (is_dir($dir)) {
		$dir_array = scandir($dir);
		foreach ($dir_array as $file) {
			if (stripos($file, '.') > 0) {
				echo "filename: {$file} <br />";
			}
		}
	}

	// not much shorter, but maybe less complicated
	// makes things like reverse order much easier

?>