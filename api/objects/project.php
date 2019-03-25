<?php
class Project{
 
    // database connection and table name
    private $conn;
    private $table_name = "project";
 
    // object properties
    public $id;
    public $user_id;
    public $project_name;
	public $creation_date;
	public $archived;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// get all projects in database
	function get_all_projects() {
	 
		// select all query
		$query = "SELECT * FROM `project` WHERE 1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// get all projects with user_id ....
	function get_all_projects_with_user_id($user_id) {
	 
		// select all query
		$query = "SELECT * 
					FROM `project` 
					WHERE user_id='" . $user_id . "'";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
}
?>