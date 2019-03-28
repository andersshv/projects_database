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
	$projects = $mysqli->query("SELECT * FROM project WHERE user_id='$user_id'");
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
		<h1>Hello <?= $user_name . " " . $user_id?></h1>          
		<p>
			<?php      
			// Display message about account verification link only once
			if ( isset($_SESSION['message']) )
			{
				echo $_SESSION['message'];
			}          
			?>
		</p>
		<a href="logout.php"><button name="logout"/>Log Out</button></a> 
		<a href="new_project.php"><button name="new_project"/>create new project</button></a> 		  
		<h2>Here are your projects:</h2>
		<p>
			<?php
			while ($row = $projects->fetch_assoc()) {
				echo "<p>Project name: " . $row['project_name'] . "</p>";
			}
			?>	
		</p>
    </div>

</body>
</html>
