<?php 
if (isset($_POST['signup'])) {
	require 'dbh.php';
	$username = $_POST['usr_name'];
	$email = $_POST['name'];
	$pass = $_POST['pass'];
	$repass = $_POST['repass'];

	if(empty($username)||empty($email)||empty($pass)||empty($repass)){
		header("Location: signup.php?error=emptyfields&usr_name=".$username."&name=".$email);
		exit();
	}
	elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)&&!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: signup.php?error=invalidnameusr_name");
		exit();
	}

	elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		header("Location: signup.php?error=invalidname&usr_name=".$username);
		exit();
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("Location: signup.php?error=invalidusr_name&name=".$email);
		exit();
	}
	elseif ($pass !== $repass) {
		header("Location: signup.php?error=passwordcheck&usr_name=".$username."&name=".$email);
		exit();
	}else{
		$sql = "SELECT user_name from user_data WHERE user_name=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: signup.php?error=sqlerror");
		exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"s",$username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$result_check = mysqli_stmt_num_rows($stmt);
			if($result_check>0){
				header("Location: signup.php?error=usertaken&name=".$email);
				exit();
			}else{
				$stmt = mysqli_stmt_init($conn);
				$sql = "INSERT INTO user_data(user_name,user_email,user_pass) VALUES (?,?,?) ";
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: signup.php?error=sqlerror");
					exit();
				}
				else{
					$hashpassword = password_hash($pass, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashpassword);
					mysqli_stmt_execute($stmt);
					header("Location: signup.php?signup=success");
					exit();
				}
		}
	}


}
mysqli_stmt_close($stmt);
mysql_close($conn);
}
else{
	header("Location: signup.php");
	exit();
}