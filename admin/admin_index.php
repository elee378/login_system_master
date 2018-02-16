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
	<?php
	  	if($_SESSION['current_hour'] <= "11") {
	    	$greeting = "It is morning time";

	  	}elseif($_SESSION['current_hour'] >= "12" && $_SESSION['current_hour'] <= "16") { 
	   		$greeting = "It is the afternoon";
	   		
	  	}elseif($_SESSION['current_hour'] >= "17") { 
	    	$greeting = "It is now night";
	  	}
	?>
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

		<?php echo $_SESSION['user_name'];?>
		<?php echo $greeting?>
	</div>

	<p id="lastLogin">You last logged in on <?php echo $_SESSION['users_timestamp']; ?>.</p>
</body>
</html>
