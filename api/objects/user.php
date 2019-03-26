<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $id;
    public $user_name;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// get all users with user name ...
	function get_user_id_of_user_with_user_name($user_name) {
	 
		// select all query
		$query = "	SELECT * 
					FROM user 
					WHERE user_name='" . $user_name . "'";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// create user
	function create(){
	 
		// query to insert record
		$query = "INSERT INTO " . $this->table_name . " SET id=:id, user_name=:user_name";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->user_name=htmlspecialchars(strip_tags($this->user_name));
	 
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":user_name", $this->user_name);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>