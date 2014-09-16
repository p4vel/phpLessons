<?php require_once 'database.php'; ?>
<?php 
	$sql = "UPDATE org_positions SET name = '".$_REQUEST['name']."' WHERE id = 2";
	$result = mysqli_query($connection, $sql);
	var_dump($result);
	if($result){
		return "success";
	} else {
		return "failure";
	}
	
?>