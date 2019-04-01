<?php
session_start();
if ( $_SESSION['logged_in'] != 1 ) {
  header("location: errorpages/error_not_logged_in.php");
}
else {
  require 'config/db.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['archive'])) {
      $project_id = $_POST['archive'];
      $sql = "UPDATE project SET archived=true WHERE id=$project_id";
      if ( $mysqli->query($sql) ) {
        header("location: profile.php");
      }
      else {
        header("location: errorpages/error_something_went_wrong.php");
      }
    }
  } else {
    $user_name = $_SESSION['user_name'];
    $user_id = $_SESSION['user_id'];
    // $projects = $mysqli->query("SELECT * FROM project WHERE user_id='$user_id' && archived=false");
    // while ($row = $projects->fetch_assoc()) {
    //   $project_id = $row['id'];
    //   $actions = $mysqli->query("SELECT * FROM action WHERE project_id='$project_id' && archived=false");
    //   $row = $actions->fetch_assoc();
    //   $action_date = $row['action_date'];
    // }
  }
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title><?= $user_name . "'s projects_database"?></title>
  <style>
    table {
      table-layout: fixed;
      width: 100%;
    }
    table th {
      width: calc(100% / 7);
    }
  </style>
</head>
<body style="background-color: chocolate">
	<div class="form">
    <div style="display: flex">
  		<h1 style="width: 100%; background-color: antiquewhite">
        Active projects for <?= $user_name . " " . $user_id?>
      </h1>
      <h1 style="width: 100px; display: flex; justify-content: center">
        <form action="logout.php" style="margin-top: -7px">
          <button type='input' name="logout"/>Log Out</button>
        </form>
      </h1>
    </div>
    <hr/>
    <div style="display: flex">
      <div style="margin-right: 8px; min-width: 92px;">
    		<form action="new_project.php">
          <button type='input' name="new_project"/>New Project</button>
        </form>
      </div>
      <div style="min-width: 122px;">
        <form action="archived_projects.php">
          <button type='input' name="archived_project"/>Archived Projects</button>
        </form>
      </div>
      <div style="width: 100%">
        <div style="text-align: right; padding-right: 12px; padding-top: 3px">
          <?php
            $ddate = date("d-m-Y", strtotime('monday this week'));
            $date = new DateTime($ddate);
            $week = $date->format("W");
            echo "Week: $week (Mon. ";
            echo date("d-m-Y", strtotime('monday this week'));
            echo " - Sun. ";
            echo date("d-m-Y", strtotime('sunday this week'));
            echo ")";
          ?>
        </div>
      </div>
      <div>
        <form>
          <button/><-</button>
        </form>
      </div>
      <div style="margin-right: 4px">
        <form>
          <button/>-></button>
        </form>
      </div>
    </div>
    <hr/>
		<p>
			<?php
      echo "
      <div style='margin-bottom: 0px; margin-top: -16px;
                  border: 5px solid chocolate; padding: 4px; display: flex'>
        <div style='display: inline-block; width: 22%'></div>
        <div style='display: grid; width: 78%; text-align: center;
                    background-color: chocolate'>
          <table>
            <tr>
              <th>Mandag</th>
              <th>Tirsdag</th>
              <th>Onsdag</th>
              <th>Torsdag</th>
              <th>Fredag</th>
              <th>Lørdag</th>
              <th>Søndag</th>
            </tr>
          </table>
        </div>
      </div>
      ";
      $projects = $mysqli->query("SELECT * FROM project WHERE user_id='$user_id' && archived=false");
			while ($row = $projects->fetch_assoc()) {
        $c_date = $row['creation_date'];
        $time_stamp = strtotime($c_date);
        $date = date('d-m-Y', $time_stamp);
        // Border colors: orange - darkolivegreen - blueviolet
				echo "
        <div style='margin-bottom: 16px; border: 5px solid darkolivegreen;
                    padding: 4px; display: flex'>
          <div style='display: inline-block; width: 22%'>
            <div>
              <div style='font-weight: bold; text-decoration-line: underline'>
                Project name: " . $row['project_name'] . "
              </div>
              <div>Creation date: " . $date . "</div>
            </div>
            <form action='profile.php' method='post'>
              <button type='input' name='archive' value='" . $row['id'] . "'>
                archive
              </button>
            </form>
          </div>
          <div style='display: grid; width: 78%; text-align: center;
                      background-color: antiquewhite'>
            <table>
              <tr>
                <th><button>Add actiongggg</button></th>
                <th><button>Add action</button></th>
                <th><button>Add action</button></th>
                <th><button>Add action</button></th>
                <th><button>Add action</button></th>
                <th><button>Add action</button></th>
                <th><button>Add action</button></th>
              </tr>
            </table>
          </div>
        </div>
        ";
			}
			?>
		</p>
    </div>
</body>
</html>
