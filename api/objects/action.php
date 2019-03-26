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
	
	// create action
	function create(){
	 
		// query to insert record
		$query = 
			"INSERT INTO " . $this->table_name . 
			" SET id=:id, project_id=:project_id, action_date=:action_date, action_text=:action_text, done=:done";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->project_id=htmlspecialchars(strip_tags($this->project_id));
		$this->action_date=htmlspecialchars(strip_tags($this->action_date));
		$this->action_text=htmlspecialchars(strip_tags($this->action_text));
		$this->done=htmlspecialchars(strip_tags($this->done));
	 
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":project_id", $this->project_id);
		$stmt->bindParam(":action_date", $this->action_date);
		$stmt->bindParam(":action_text", $this->action_text);
		$stmt->bindParam(":done", $this->done);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>