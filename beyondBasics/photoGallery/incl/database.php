<?php
require_once(LIB_PATH.DS."config.php");


class MySQLDatabase{
	
	private $connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;

	function __construct(){
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("mysql_real_escape_string"); 
	} 

	public function open_connection(){
		$this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		if (!$this->connection) {
			die("Database connection failed: " . mysql_error());
		} else {
			$db_select = mysql_select_db(DB_NAME, $this->connection);
			if (!$db_select) {
				die("Database selection failed: " . mysql_error());
			}
		}
	}

	public function close_connection(){
		if (isset($this->connection)) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	
	public function query($sql){
		$this->last_query = $sql;
		$result = mysql_query($sql, $this->connection);
		$this->confirm_query($result);
		return $result;
	}

	public function fetch_array($result_set){
		return mysql_fetch_array($result_set);
	}

	public function numRows($result_set)
	{
		return mysql_num_rows($result_set);
	}

	public function affected_rows()
	{
		return mysql_affected_rows($tis->connection);
	}

	public function insert_id()
	{
		// get teh last id inserted over the current db connection
		return mysql_insert_id($this->connection);
	}

	private function confirm_query($result){
		if (!$result) {
			$output  = "Database query failed: " . mysql_error() . "<br /><br />";
			// $output .= "Last SQL query: " . $this->last_query; // only in production mode
			die($output); 
		}
	}

	public function escape_value($value){
		if ($new_enough_php) { // PHP v. 4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work			
			if ($magic_quotes_active) { $value = stripslashes($value); }
			$value = mysql_real_escape_string($value);
		} else { // before PHP v.4.3
			// if magic quotes aren't already on then add slashes manually
			if (!magic_quotes_active) { $value = addslashes($value); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}


}

$database = new MySQLDatabase();
?>