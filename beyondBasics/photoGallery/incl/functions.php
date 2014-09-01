<<<<<<< HEAD
<?php 

public function strip_zeros_from_date($marked_string)
{
	// first remove the marked zeros
	$no_zeros = str_replace('*0', '', $marked_string);
	// the remove any remaining marks
	$cleaned_string = str_replace('*', '', $no_zeros);
	return $cleaned_string;
}


public function redirect_to($location = NULL)
{
	if ($location != NULL) {
		header("Location: {$location}");
		exit; 
	}
}

public function output_message($message = "")
{
	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
		return "";
	}
}

=======
<?php 

public function strip_zeros_from_date($marked_string)
{
	// first remove the marked zeros
	$no_zeros = str_replace('*0', '', $marked_string);
	// the remove any remaining marks
	$cleaned_string = str_replace('*', '', $no_zeros);
	return $cleaned_string;
}


public function redirect_to($location = NULL)
{
	if ($location != NULL) {
		header("Location: {$location}");
		exit; 
	}
}

public function output_message($message = "")
{
	if (!empty($message)) {
		return "<p class=\"message\">{$message}</p>";
	} else {
		return "";
	}
}

>>>>>>> df664a9cddba29f46fbe9a1f624b9a140cc783b6
?>