<?php
	require_once('phpscripts/config.php');
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Create an account</title>
</head>
<body>
	<form class="signup-form" action="phpscripts/signup_function.php" method="post">
		<input type="text" name="first" placeholder="first name">
		<input type="text" name="username" placeholder="user name">
		<input type="text" name="email" placeholder="email">
		<input type="text" name="password" placeholder="password">
		<button type="submit" name="submit">Sign Up</button>
	</form>
</body>
</html>