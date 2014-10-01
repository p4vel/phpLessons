<?php 

	// If it's going to need the database, then it's 
	// probably smart to rewuire it before we start
	require_once(LIB_PATH.DS.'database.php');

	class Comment{

		protected static  $table_name = "comments";
		protected static $db_fields = array('id', 'photograph_id', 'created', 'author', 'body');

		public $id;
		public $photograph_id;
		public $created;
		public $author;
		public $body;


		public static function make($photo_id, $author="Anonymous", $body="")
		{
			if (!empty($photo_id) && !empty($author) && !empty($body)) {
				$comment = new Comment();
				$comment->photograph_id = (int)$photo_id;
				$comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
				$comment->author = $author;
				$comment->body = $body;
				return $comment;
			} else {
				return false;
			}
		}

		public static function find_comments_on($photo_id=0){
			
			global $database;
			$sql  = "SELECT * FROM " . self::$table_name . " ";
			$sql .= "WHERE photograph_id = " . $database->escape_value($photo_id) . " ";
			$sql .= "ORDER BY created ASC";

			return self::find_by_sql($sql);
		}


		public static function find_all(){
		return self::find_by_sql("SELECT * FROM users");
		}

		public static function find_by_id($id=0){
			global $database;
			$result_array = self::find_by_sql("SELECT * FROM ". self::$table_name. " WHERE id = {$id} LIMIT 1");
			return !empty($result_array) ? array_shift($result_array) : false;
		}

		public static function find_by_sql($sql = ""){
			global $database;
			$result_set = $database->query($sql);
			// return $result_set;

			$object_array = array();
			while ($row = $database->fetch_array($result_set)) {
				$object_array[] = self::instantiate($row);
			}
			return $object_array;
		} 

		public static function count_all(){
			global $database;
			$sql = "SELECT COUNT(*) FROM ".self::$table_name;
			$result_set = $database->query($sql);
			$row = $database->fetch_array($result_set);
			return array_shift($row);
		}

		private static function instantiate($record){
			// Could check taht $record exists and is an array
			$object = new self;
			
			// Simple, long-form approach:
			// $object->id 			= $record['id'];
			// $object->username 	= $record['username'];
			// $object->password 	= $record['password'];
			// $object->first_name 	= $record['first_name'];
			// $object->last_name 	= $record['last_name'];

			// More dynamic, short-form approach
			foreach ($record as $attribute => $value) {
				if($object->has_attribute($attribute)){
					$object->$attribute = $value;
				}
			}
			return $object;
		}

		private function has_attribute($attribute){
			// get_object_vars returns an associative array with all attributes
			// (incl. private ones) as the keys and their current values as value
			$object_vars = $this->attributes();
			// We don't care about the value, we just want to know if the key exists
			// Wo;; return true or false
			return array_key_exists($attribute, $object_vars);
		}

		public function save(){
			// a new record won't have an id yet
			return isset($this->id) ? $this->update() : $this->create();
		}

		protected function attributes(){
			// returns an array of attributes and their values
			// return get_object_vars($this);
			$attributes = array();
			foreach (self::$db_fields as $field) {	
				if (property_exists($this, $field)) {
					$attributes[$field] = $this->$field;
				}
			}
			return $attributes;
		}

		protected function sanitized_attributes(){
			global $database;
			$clean_attributes = array();
			// sanitize the values before submitting
			// Note: does not alter the actual value of eahc attribute
			// echo "<pre>";
			foreach ($this->attributes() as $key => $value) {
				
				// var_dump($key);
				$clean_attributes[$key] = $database->escape_value($value);
			}
			
			// echo "</pre>";
			// die();	
			
			return $clean_attributes;
		}

		public function create(){
			global $database;
			// Don't forget your SQL syntax and good habits:
			// - INSERT INTO table (key, key) VALUES ('value', 'value')
			// - single-quotes around all values
			// - escape all values to prevent SQL injection

			$attributes = $this->sanitized_attributes();
			
			$sql  = "INSERT into ".self::$table_name." (";

			// $sql .= "username, password, first_name, last_name"; 
			// -->>  replaced by follwing line for abstraction
			$sql .= join(", ", array_keys($attributes));	

			$sql .= ") VALUES ('";

			// $sql .= $database->escape_value($this->username) . "', '";
			// $sql .= $database->escape_value($this->password) . "', '";
			// $sql .= $database->escape_value($this->first_name) . "', '";
			// $sql .= $database->escape_value($this->last_name) . "')";
			// -->> replaced by the follwoing line
			$sql .= join("', '", array_values($attributes));
			$sql .= "')";


			if ($database->query($sql)) {
				$this->id = $database->insert_id();
				return true;
			} else {
				return false;
			}

		}	
		public function update(){
			global $database;
			// Don't forget your SQL syntax and good habits:
			// UPDATE table SET key='value', key='value' WHERE condition
			// - single quotes raound all values
			// - escape all values to prevent SQL injection
			$attributes = $this->sanitized_attributes();
			foreach ($attributes as $key => $value) {
				$attribute_pairs[] = "{$key}='{$value}'";
			}
			$sql  = "UPDATE ".self::$table_name." SET ";
			
			// $sql .= "username='".$database->escape_value($this->username)."', ";
			// $sql .= "password='".$database->escape_value($this->password)."', ";
			// $sql .= "first_name='".$database->escape_value($this->first_name)."', ";
			// $sql .= "last_name='".$database->escape_value($this->last_name)."' ";
			// -->>  replaced by:

			$sql .= join(", ", $attribute_pairs);

			$sql .= " WHERE id=".$database->escape_value($this->id);

			print_r($sql);
			// var_dump($sql);

			$database->query($sql);
			return ($database->affected_rows() == 1) ? true : false;


		}
		public function delete(){
			global $database;
			// Don't forget your SQL syntax and good habits:
			// - DELETE FROM tabel WHERE condition LIMIT 1
			// - escape all values to prevent SQL injections
			// - use LIMIT 1


			$sql  = "DELETE FROM ".self::$table_name." ";
			$sql .= "WHERE id=". $database->escape_value($this->id). " ";
			$sql .= "LIMIT 1";

			// var_dump($sql);

			$database->query($sql);
			return ($database->affected_rows() == 1) ? true : false;
		}

	}

?>