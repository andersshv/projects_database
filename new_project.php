<?php
require 'db.php';
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  header("location: error_not_logged_in.php");    
}
else {
	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		$project_name = $mysqli->escape_string($_POST['project_name']);
		
		$sql = "INSERT INTO project (user_id, project_name, archived) " 
            . "VALUES ('$user_id', '$project_name', false)";
			
		// Add user to the database
		if ( $mysqli->query($sql) ) {
			header("location: profile.php");
		}

		else {
			header("location: error_something_went_wrong.php");
		}
	}
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title><?= $user_name . "'s projects_database"?></title>
</head>

<body>
	<div class="form">
		<h1>Create new project for: <?= $user_name . " " . $user_id?></h1> 	  
		<form action="new_project.php" method="POST" style="border:1px solid #ccc">
		  <div class="container">
		  
			<br/>
			<label for="project_name"><b>Project name: </b></label>
				<input type="text" placeholder="Enter project name" name="project_name" required>
			<br/>
			<br/>

			<div class="clearfix">
			  <button type="submit">Create project</button>
			</div>
			
		  </div>
		</form>  
	</div>

</body>
</html>