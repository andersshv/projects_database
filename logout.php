<?php
/* Log out process, unsets and destroys session variables */
session_start();
$user_name = $_SESSION['user_name'];
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>projects_database</title>
</head>

<body>
    <div class="form">             
          <h1><?php echo 'Goodbye ' . $user_name ?></h1>          
          <a href="."><button>Log in</button></a>
    </div>
</body>
</html>
