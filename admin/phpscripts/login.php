<?php
	function logIn($username, $password, $ip) {
		require_once('connect.php');
		$username = mysqli_real_escape_string($link, $username);
		$password = mysqli_real_escape_string($link, $password);
		
		$loginstring = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass='{$password}'";
		$user_set = mysqli_query($link, $loginstring);
		//echo mysqli_num_rows($user_set);

	//THIS IS THE LOCKOUT FUNCTION
	$lockoutstring = "SELECT * FROM tbl_user WHERE user_name = '$username' OR user_pass = '$password'"; 

		$result = mysqli_query($link, $lockoutstring); 
		$foundQuery = mysqli_num_rows($result); 

		if($foundQuery < 2) { 
			$updateLogin = "UPDATE tbl_user SET user_loginAttempts = user_loginAttempts + 1 WHERE user_ip = '$ip'";
			$updateLoginQuery = mysqli_query($link, $updateLogin);

			$attemptsString = "SELECT user_loginAttempts FROM tbl_user WHERE user_ip ='$ip' AND user_loginAttempts >= '3'";
			$attempts = mysqli_query($link, $attemptsString);
			$threeAttempts = mysqli_num_rows($attempts);

			if($threeAttempts == "1") { 
				echo 'FAILED 3 TIMES.';
			}

		}elseif($foundQuery = 2) {
			$updateLogin = "UPDATE tbl_user SET user_loginAttempts = '0' WHERE user_ip = '$ip'";
			$updateLoginQuery = mysqli_query($link, $updateLogin);
		}
		
		if(mysqli_num_rows($user_set)){
			$founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
			$id = $founduser['user_id'];
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name']= $founduser['user_fname'];
				if(mysqli_query($link, $loginstring)){
					//THIS UPDATES THE DATABASE
					$update = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
					$updatequery = mysqli_query($link, $update);

					date_default_timezone_set('America/Toronto');
					$currentDate = date('l F jS Y, \a\t h:ia T'); 
					$_SESSION['current_hour'] = date('G');
					$updateTime = "UPDATE tbl_user SET user_timestamp = '$currentDate' WHERE user_id = {$id}";
					$updateTimeQuery = mysqli_query($link, $updateTime);

					$timestamp = $found_user['user_timestamp'];
					$_SESSION['users_timestamp'] = $timestamp; 
			}

			redirect_to("admin_index.php");

		}else{
			$message = "Learn how to type you dumba&*.";
			return $message;
		}

		mysqli_close($link);
	}
?>