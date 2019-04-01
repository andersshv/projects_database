<!DOCTYPE html>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
	<link rel="icon" href="./favicon/favicon.ico">
	<title>projects_database</title>
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require 'login.php';
}
?>
<body style="background-color: chocolate;">

	<h1 style="text-align: center; background-color: antiquewhite;">
		projects_database
	</h1>
	<p style="text-align: center; background-color: antiquewhite;">
		Here you can save and view all your projects.
	</p>

	<form action="index.php" method="POST" style="border:1px solid #ccc">
	  <div class="container">
		<h1 >Create or login to your personal projects_database</h1>
		<p>Fill in this form to create or login to your personal projects_database.</p>
		<hr>

		<label for="user_name"><b>Username: </b></label>
			<input type="text" placeholder="Enter Username" name="user_name" required>
		<br/>
		<br/>

		<label for="password"><b>Password: </b></label>
			<input type="password" placeholder="Enter Password" name="password" required>
		<br/>
		<br/>

		<div class="clearfix">
		  <button type="submit" class="signupbtn">Log in</button>
		</div>
	  </div>
	</form>

</body>
</html>
