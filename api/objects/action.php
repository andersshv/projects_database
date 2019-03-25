<?php
class Action{
 
    // database connection and table name
    private $conn;
    private $table_name = "action";
 
    // object properties
    public $id;
    public $project_id;
    public $action_date;
	public $action_text;
	public $done;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// get all actions in database
	function get_all_actions() {
	 
		// select all query
		$query = "SELECT * FROM `action` WHERE 1";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// get all projects with user_id ....
	function get_all_actions_with_project_id($project_id) {
	 
		// select all query
		$query = "SELECT * 
					FROM `action` 
					WHERE project_id='" . $project_id . "'";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
}
?>