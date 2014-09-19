<?php require_once 'database.php'; ?>
<?php 
	$field = $_REQUEST['name'];	
	$value = $_REQUEST['participate'];
	// structure: "user_id" + "_" = "date_id"


	$stringposition = strpos ( $field, '_' ); 
	$user_id = substr($field,0,$stringposition); 
	$dates_id = substr($field, $stringposition+1);

	if ($value == 'participate') {
		$participate = 1;		
	} else {
		$participate = 0;		
	}

	$sql = "UPDATE org_dates_users SET participate = '{$participate}' WHERE date_id = '{$dates_id}' AND user_id = '{$user_id}'";
	$result = mysqli_query($connection, $sql);


	if($result){
		return "success";
	} else {
		return "failure";
	}
	
?>