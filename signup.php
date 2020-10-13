<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="login.css">
<body>
	<div class="box_signup">
		<h1>Sign Up</h1>

			<form action="signup_store.php" method="post">
				<input class = "text-box_signup"type="text" name="usr_name" placeholder="Username">
				<input class = "text-box_signup"type="text" name="name" placeholder="email">
				<input class = "text-box_signup"type="password" name="pass" placeholder="password">
				<input class = "text-box_signup"type="password" name="repass" placeholder="re-password">
				<?php
			if(isset($_GET['error'])){
				if ($_GET['error'] == "emptyfields") {
					echo '<p style = "Color : red;">there are blank fields</p>';
				}
				else if ($_GET['error'] == "invalidnameusr_name") {
					echo '<p style = "Color : red;">invalid username and email </p>';
				}else if ($_GET['error'] == "invalidname") {
					echo '<p style = "Color : red;">invalid username</p>';
				}else if ($_GET['error'] == "invalidusr_name") {
					echo '<p style = "Color : red;">invalid email </p>';
				}else if ($_GET['error'] == "passwordcheck") {
					echo '<p style = "Color : red;">invalid password </p>';
				}else if ($_GET['error'] == "usertaken") {
					echo '<p style = "Color : red;">username taken </p>';
				}
			}else if(isset($_GET['signup']) == "success"){
					echo '<p style = "Color : green;">sign up success</p>';
			}
		?>
				<button class="btn-login"type="submit" name="signup">sign up</button>
				<p><a href="login.php">already have a account ?</a></p>
			</form>
	</div>

</body>
</html>