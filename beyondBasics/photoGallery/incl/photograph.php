<?php 

	require_once(LIB_PATH.DS.'database.php');

	class Photograph{

		protected static $table_name = "photographs";
		protected static $db_fields = array('id', 'filename', 'type', 'size', 'caption');
		public $id;
		public $filename;
		public $type;
		public $size;
		public $caption;

		public $temp_path;
		protected $upload_dir="images";

		public $errors=array();

		protected $upload_errors = array(
	 		UPLOAD_ERR_OK => "No errors.", 
	 		UPLOAD_ERR_INI_SIZE => "Larger than upload_max_filesize.", 
			UPLOAD_ERR_FORM_SIZE => "Larger than form MAX_FILE_SIZE.", 
			UPLOAD_ERR_PARTIAL => "Partial upload.", 
			UPLOAD_ERR_NO_FILE => "No file.", 
			UPLOAD_ERR_NO_TMP_DIR => "No temporary directory", 
	 		UPLOAD_ERR_CANT_WRITE => "Can't write to disk", 
	 		UPLOAD_ERR_EXTENSION => "File upload stopped by extension" 
	 	);


		// PAss in $_FILE['uploaded_file'] as an argument
		public function attach_file($file){
			// Perform error checking on the form parameters
			if (!file || empty($file) || !is_array($file)) {
				// error: nothing uploaded or wrong argument usage
				$this->errors[] = "No file was uploaded";
				return false;
			} elseif ($file['error'] != 0) {
				// error: report what PHP says went wrong
				$this->errors[] = $this->upload_errors[$file['error']];
				return false;
			} else {
				// Set object attributes to the form parameters
				// var_dump($file['tmp_name']);
				// die();
				$this->temp_path = $file['tmp_name'];
				$this->filename  = basename($file['name']);
				$this->type = $file['type'];
				$this->size = $file['size'];
				// Don't worry about saving anything to the database yet
				return true;
			}

		}

		public function save(){
			// A new record won't have an id yet.
			if (isset($this->id)) {
				$this->update();
			} else {
				// Make sure there are no errors
				// 		Can't Save if there are pre-existing errors
				if (!empty($this->errors)) {return false;}
				//		Make sure the caption is not too long for the DB
				if (strlen($this->caption) >= 255) {
					$this->errors[] = "The caption can only be 255 chracters long.";
					return false;
				}
				//		Can't Save without filename and temp location
				if (empty($this->filename) || empty($this->temp_path)) {
					$this->errors[] = "The file location was not available";
					return false;
				}
				//		Determine the target_path
				$this->target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
	
				//		Make sure a file doesn't already exist in the target location
				if (file_exists($target_path)) {
					$this->errors[] = "The file {$this->filename} already exsits.";
					return false;
				}

				// Attmept to move the file
				if (move_uploaded_file($this->temp_path, $this->target_path)) {
					// success
					// save a corresponding entry in the database
					if($this->create()){
						// We are done with temp_pat, the file isn't there anymore
						unset($this->temp_path);
						return true;
					}
				} else {
					// Failure: File was not moved
					$this->errors[] = "Teh file upload failed due to incorrect permissions on the uplod folder";
					// return false;
				}

				// Save a corresponding entry to the database
				$this->create();
			}
		}


		public function destroy(){
			// First remove the DB entry
			if ($this->delete()) {
				// then remove the file
				// Note that even thought the DB entry is gone, this object
				// is still around (which lets us use $this->image_path())
				$target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
				return unlink($target_path) ? true : false;
			} else {
				// DB delete failed
				return false; 
			}
		}

		public function image_path(){
			return $this->upload_dir.DS.$this->filename;
		}

		public function size_as_text()		{
			if ($this->size < 1024) {
				return "{$this->size} bytes";
			} elseif ($this->size < 1048576) {
				$size_kb = round($this->size/1024);
				return "{$size_kb} KB";
			} else {
				$size_mb = round($this->size/1048576, 1);
				return "{$size_mb} MB";
			}
		}

		public function comments(){
			return Comment::find_comments_on($this->id);
		}

		public static function find_all(){
			return self::find_by_sql("SELECT * FROM " . self::$table_name);
		}

		public static function find_by_id($id=0){
			global $database;
			$result_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE id = {$database->escape_value($id)} LIMIT 1");
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

		// replaced with a custom save
		// public function save(){
		// 	// a new record won't have an id yet
		// 	return isset($this->id) ? $this->update() : $this->create();
		// }

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
			foreach ($this->attributes() as $key => $value) {
				$clean_attributes[$key] = $database->escape_value($value);
			}
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