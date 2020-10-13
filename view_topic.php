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
	
<div class="success">
	<?php  
	include_once ("dbh.php");
	$cid = $_GET['cid'];
	$tid = $_GET['tid'];
	$sql ="SELECT *FROM topics WHERE cat_id = '".$cid."'AND id='".$tid."' LIMIT 1";
	$res = mysqli_query($conn,$sql);
	if(mysqli_num_rows($res) == 1){
		echo "<table width = '100%'>";
		if($_SESSION['userid']){
		echo "<tr><td colspan = '2'><input type = 'submit' value = 'Add reply' OnClick = \"'pos_reply.php?cid =".$cid."&tid=".$tid."'\" /><hr />";} 
		else{ 
			echo "<tr><td colspan = '2'><p>Please log in to add your reply</p></td></tr>";
		}
		while($row = mysqli_fetch_assoc($res)){
			$sql2  = "SELECT *FROM posts WHERE cat_id '".$cid."'AND topic_id = '".$tid."'"; 
			$res2 = mysqli_query($conn,$sql2);
			while($row2 = mysqli_fetch_assoc($res2)){
				echo "<tr><td valign = 'top' style= 'border: 1px solid #000000;'<div style='min-height:125px;'>".$row['topic_title']."<br /> by".$row2['post_creator']." - ".$row2['post_date']."<hr />".$row2['post_content']."</div></td><td width = '200' valign = 'top' align = 'center' style = 'border : 1px solid #000000;'>User Info Here</td></tr><tr><td colspan = '2' <hr / ></td></tr>";
			}

		}

	}else{
		echo "<p> This topic does not exist</p>";
	}
	?>
</div>	

</body>
</html>