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
	
	// create project
	function create(){
	 
		// query to insert record
		$query = 
			"INSERT INTO " . $this->table_name . 
			" SET id=:id, user_id=:user_id, project_name=:project_name, creation_date=:creation_date, archived=:archived";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->user_id=htmlspecialchars(strip_tags($this->user_id));
		$this->project_name=htmlspecialchars(strip_tags($this->project_name));
		$this->creation_date=htmlspecialchars(strip_tags($this->creation_date));
		$this->archived=htmlspecialchars(strip_tags($this->archived));
	 
		// bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":user_id", $this->user_id);
		$stmt->bindParam(":project_name", $this->project_name);
		$stmt->bindParam(":creation_date", $this->creation_date);
		$stmt->bindParam(":archived", $this->archived);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>