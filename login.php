<?php 
session_start();
 ?>
<!DOCTYPE html>

<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="login.css">
<body>
	<?php  
			if(isset($_SESSION['userid'])){
				echo '<form action="logout.inc.php" method="post">
				<button class="btn-login"type="submit" name="logout">log out</button>
				
			</form>';
			}else{
				echo '<div class="box">
		<h1>Log In</h1>
			<form action="store.php" method="post">
				<input class = "text-box"type="text" name="name" placeholder="Username/email">
				<input class = "text-box"type="password" name="pass" placeholder="password">
				<button class="btn-login"type="submit" name="login">Log In</button>
				<p>Forgot password ?</p>
				<p><a href="signup.php">Sign up</a></p>
			</form>
	</div>';
			}
		?>
<div class="success">
	<?php  
	include_once("dbh.php");
	$sql = "SELECT * FROM categories ORDER BY cat_title ASC";
	$res = mysqli_query($conn,$sql);
	$categories = "";
	if(mysqli_num_rows($res)>0){
		while($row = mysqli_fetch_assoc($res)){
			$id = $row['id'];
			$title = $row['cat_title'];
			$description = $row['cat_desc'];
			$categories.= "<a href = 'view_category.php?cid=".$id."' style = 'color : white;'>".$title."-<font size '-1'>".$description."</font></a>";
		}
		echo $categories;

	}else{
		echo "<p>No categories avaiable yet</p>";
	}
	?>
	
</div>	

</body>
</html>