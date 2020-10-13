<?php 
session_start();
 ?>
 <?php  
 if(!isset($_SESSION['userid'])||($_GET['cid']) == ""){
		header("location:index.php");
		exit();
	}
$cid = $_GET['cid'];
 ?>

<!DOCTYPE html>

<html>
<head>
	<title></title>
</head>
<link rel="stylesheet" href="login.css">
<body>
	
<div class="success">
	<form action="create_topic_parse.php" method="post">
		<p>topic title</p>
		<input type="text" name="topic_title" size="98" maxlength="150"/>
		<P>topic content</P>
		<textarea name="topic_content" rows="5" cols="75"></textarea><br/><br/>
		<input type="hidden" name="cid" value="<?php echo $cid;?>"/>
		<input type="submit" name="topic_submit" value="create your topic">
		
	</form>
	
</div>	

</body>
</html>