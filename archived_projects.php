<?php
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  header("location: errorpages/error_not_logged_in.php");
}
else {
  require 'config/db.php';
  $user_name = $_SESSION['user_name'];
  $user_id = $_SESSION['user_id'];
  $projects = $mysqli->query("SELECT * FROM project WHERE user_id='$user_id' && archived=true");
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['unarchive'])) {
      $project_id = $_POST['unarchive'];
      $sql = "UPDATE project SET archived=false WHERE id=$project_id";
      if ( $mysqli->query($sql) ) {
        header("location: archived_projects.php");
      }
      else {
        header("location: errorpages/error_something_went_wrong.php");
      }
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
        Archived projects for <?= $user_name . " " . $user_id?>
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
          <button type='input'/>Active projects</button>
        </form>
      </div>
    </div>
		<p>
			<?php
			while ($row = $projects->fetch_assoc()) {
				echo "<div>" . $row['project_name'] . "</div>
              <form action='archived_projects.php' method='post'>
                <button
                  type='input'
                  name='unarchive'
                  value='" . $row['id'] . "'
                >
                  unarchive
                </button>
              </form>";
			}
			?>
		</p>
    </div>
</body>
</html>
