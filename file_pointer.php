<?php 
	
	$file = 'filetest.txt';
	if($handle = fopen($file, 'w')){ //overwrite
		fwrite($handle, "123\n456\n789");

		$pos = ftell($handle); 	// returns postion of the pointer
		fseek($handle, $pos-6);	// move pointer 6 positions backwards

		fwrite($handle, "abcdef");

		rewind($handle);		// going back to the beginning of the file
		fwrite($handle, 'xyz');	

		fclose($handle);
	}

	// Beware, it will OVERTYPE !!!
	// Note: a and a+ modes will not let you move the pointer !!!

	
?>