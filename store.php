<?php  
if(isset($_POST['login'])){
	require 'dbh.php';
	$mailuid = $_POST['name'];
	$password = $_POST['pass'];
	if(empty($mailuid)||empty($password)){
	header("Location: login.php?error=emptyfields");
	exit();	
	}else{
		$sql = "SELECT*FROM user_data WHERE user_name = ? OR user_email = ?;";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: login.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$pwdchek = password_verify($password, $row['user_pass']);
				if($pwdchek == false){
					header("Location: login.php?error=wrongpassword");
					exit();
				}
				else if($pwdchek == true){
					session_start();
					$_SESSION['userid']=$row['ID'];
					$_SESSION['useruid'] = $row['user_name'];
					header("Location: index.php?login = success");
					exit();
				}
			}
			else{
			header("Location: login.php?error=nouser");
			exit();
			}
		}
	}

}else{
	header("Location: login.php");
	exit();
}