<?php
require 'config/db.php';
// Escape user_name to protect against SQL injections
$user_name = $mysqli->escape_string($_POST['user_name']);
$password = $mysqli->escape_string($_POST['password']);
$result = $mysqli->query("SELECT * FROM user WHERE user_name='$user_name'");

if ( $result->num_rows == 0 ){ // User doesn't exist
	session_start();
    // Set session variables to be used on profile.php page
	$_SESSION['message'] = "We welcome a new user: $user_name. Please remember your password: $password. Otherwise you won't be able to login with this username again.";
	$_SESSION['user_name'] = $_POST['user_name'];

	// Create user
	$password_enc = $mysqli->escape_string(password_hash($password, PASSWORD_BCRYPT));
  $sql = "INSERT INTO user (user_name, password) "
          . "VALUES ('$user_name','$password_enc')";

  // Add user to the database
  if ( $mysqli->query($sql) ) {
      $_SESSION['logged_in'] = true; // So we know the user has logged in
      header("location: profile.php");
  }

  else {
      header("location: errorpages/error_something_went_wrong.php");
  }
}
else { // User exists
	if ($result->num_rows > 1) {
		header("location: errorpages/error_two_users_with_same_username.php");
	}
	else {
    $user = $result->fetch_assoc();
    if ( password_verify($_POST['password'], $user['password']) ) {
				session_start();
        $_SESSION['user_name'] = $user['user_name'];
				$_SESSION['user_id'] = $user['id'];
        $_SESSION['logged_in'] = true;
        header("location: profile.php");
    }
    else {
        header("location: errorpages/error_wrong_password.php");
    }
	}
}
