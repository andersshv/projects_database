<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $id;
    public $user_name;
    public $e_mail;
 
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
}
?>