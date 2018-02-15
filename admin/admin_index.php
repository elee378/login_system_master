<?php
	require_once('phpscripts/config.php');
	confirm_logged_in();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Welcome to your admin panel</title>
 <link rel="stylesheet" type="text/css" href="css/main.css">
 <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
	<?php echo $_SESSION['user_name'];?>
	<div>
	<?php
	if (isset($_SESSION['user_id'])) {
		echo '<form action="phpscripts/logout_function.php" method="POST">
			<button type="submit" name="submit">Logout</button>
			</form>';
	} else {
		echo '<form action="admin_login.php" method="post">
			<label>Username:</label>
			<input type="text" name="username" value="">
			<br>
			<label>Password</label>
			<input type="password" name="password" value="">
			<br><br>
			<input type="submit" name="submit" value="Show me the money">
			</form>';
	}
	?>
	</div>
</body>
</html>