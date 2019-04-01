<?php
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  header("location: errorpages/error_not_logged_in.php");
}
else {
	$user_name = $_SESSION['user_name'];
	$user_id = $_SESSION['user_id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		require 'config/db.php';
		$project_name = $mysqli->escape_string($_POST['project_name']);
		$sql = "INSERT INTO project (user_id, project_name, archived) "
	          . "VALUES ('$user_id', '$project_name', false)";

		// Add user to the database
		if ( $mysqli->query($sql) ) {
			header("location: profile.php");
		}
		else {
			header("location: errorpages/error_something_went_wrong.php");
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
<body style="background-color: chocolate">
	<div class="form">
    <div style="display: flex">
  		<h1 style="width: 100%; background-color: antiquewhite">
        Create new project for: <?= $user_name . " " . $user_id?>
      </h1>
      <h1 style="width: 100px; display: flex; justify-content: center">
        <form action="logout.php" style="margin-top: -7px">
          <button type='input' name="logout"/>Log Out</button>
        </form>
      </h1>
    </div>
    <hr/>
    <div style="display: flex">
      <div style="margin-right: 8px">
    		<form action="profile.php">
          <button type='input' name="back"/>Back</button>
        </form>
      </div>
    </div>
    <br/>
		<form action="new_project.php" method="POST" style="border:2px solid #555">
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
