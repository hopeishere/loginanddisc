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
	include_once("dbh.php");
	$cid = $_GET['cid'];
	$topics = "";
	if(isset($_SESSION['userid'])){
				$logged = "| <a href ='create_topic.php?cid=".$cid."'>Click here to create a topics<a>";
			}else{
				$logged = "| Please log in to create topics in this forum";
			}
			$sql = "SELECT id FROM categories WHERE id='".$cid."'LIMIT 1";
			$res = mysqli_query($conn,$sql);
			if(mysqli_num_rows($res)==1){
				$sql2 = "SELECT *FROM topics WHERE cat_id = '".$cid."'ORDER BY topic_reply_date DESC";
				$res2 = mysqli_query($conn,$sql2);
				if(mysqli_num_rows($res2)>0){
					$topics .= "<table width = '100%' style = 'border-collapse:collapse;'>";
					$topics .= "<tr><td colspan = '3'><a href = 'index.php'>Return to Forum Index</a>".$logged."<hr/></td></tr>";
					$topics .= "<tr style = 'background-color:#dddddd;'><td>Topic title</td><td width ='65' align= 'center' >Replies</td><td width ='65' align= 'center' >Views</td></tr>";
					$topics.="<tr><td colspan = '3'><hr/></td></tr>";
					while($row = mysqli_fetch_assoc($res2)){
							$tid = $row['id'];
							$title = $row['topic_title'];
							$Views = $row['topic_views'];
							$date = $row['topic_date'];
							$creator = $row['topic_creator'];
							$topics .= "<tr><td><a href ='view_topic.php?cid=".$cid."&tid = ".$tid."''>".$title."</a><br/><span class ='post_info'>Posted by: ".$creator." on ".$date."</span></td><td align='center'>0</td><td align='center'>".$Views."</td></tr>";
							$topics .= "<tr><td colspan = '3'><hr/></td></tr>";
			
						}
						$topics .= "</table>";
						echo $topics;
				}
					else{
						echo "<a href = 'index.php'>Return to Forum Index</a>";
						echo "<p> There are no topics in this category".$logged."</p>";
					}
			 }else{
				echo "<a href = 'index.php'>Return to Forum Index</a>";
				echo "<p style = 'color : white;> You are trying to view a category that does not exist yet</p>";
		}
		?>
</div>	

</body>
</html>