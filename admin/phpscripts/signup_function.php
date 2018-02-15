<?php
if (isset($_POST['submit'])){
	require_once('connect.php');

	$first = mysqli_real_escape_string($link, $_POST['first']);
	$username = mysqli_real_escape_string($link, $_POST['username']);
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$password = mysqli_real_escape_string($link, $_POST['password']);

	//error handlers
	//check for empty fields
	if(empty($first) || empty($username) || empty($email) || empty($password)){
			header("Location: ../signup.php?signup=empty");
			exit();
		}else{
			//check if input characters are valid
			if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $username)) {
				header("Location: ../signup.php?signup=invalid");
				exit();
			} else {
				//check if email is valid
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
					header("Location: ../signup.php?signup=bademail");
					exit();
				} else {
					$sqlsignup = "SELECT * FROM tbl_user WHERE user_id = '$id'";
					$result = mysqli_query($link, $sqlsignup);
					$resultCheck = mysqli_num_rows($result);

					if($resultCheck > 0) {
						header("Location: ../signup.php?signup=usernametaken");
						exit();
					} else {
						//randomizing password
						$randomPassword = password_hash($password, PASSWORD_DEFAULT);
						//insert the user into the database
						$sqlInsert = "INSERT INTO tbl_user (user_fname, user_name, user_email, user_pass) VALUES ('$first', '$username', '$email', '$randomPassword');";
						mysqli_query($link, $sqlInsert);

						header("Location: ../signup.php?signup=success");
						exit();
					}
				}
			}
		}

}else{
	header("Location: ../signup.php");
	exit();
}

?>