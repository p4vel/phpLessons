<<<<<<< HEAD
<?php 
require_once("../incl/database.php");

if (isset($database)) {
		 echo "true";
	} else { 
		echo "false";
	}

echo "<br />";

echo "IS this working";

=======
<?php 
require_once("../incl/database.php");

if (isset($database)) {echo "true";} else { echo "false";}
// equals: echo (isset($database)) ? "true" : "false";

echo "<br />";

echo $database->escape_value("It's working?<br />");


//$sql  = "INSERT INTO users (id, username, password, first_name, last_name) ";
//$sql .= "VALUES (1, 'mczerny', 'start123', 'Mirko', 'Czerny')";
//$result = $database->query($sql);

$sql = "SELECT * FROM users WHERE id = 1";
$result_set = $database->query($sql);
$found_user = $database->fetch_array($result_set);
echo $found_user['username'];

>>>>>>> df664a9cddba29f46fbe9a1f624b9a140cc783b6
?>