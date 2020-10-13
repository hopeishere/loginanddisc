<?php
session_start();
if($_SESSION['userid'] == ""){
		header("location:index.php");
		exit();
	}
if(isset($_POST['topic_submit'])){
	if(($_POST['topic_title'] == "")&&($_POST['topic_content'] == "")){
	echo "You did not filled both fields";
	exit();
	}else{
	require 'dbh.php';
	$cid = $_POST['cid'];
	$title = $_POST['topic_title'];
	$content = $_POST['topic_content'];
	$creator = $_SESSION['useruid'];
	 $sql="INSERT INTO topics (cat_id,topic_title,topic_creator,topic_date,topic_reply_date) VALUES('".$cid."','".$title."','".$creator."',now(),now()) ";       
        $res1 = mysqli_query($conn,$sql);
         
        $new_topic_id=mysqli_insert_id($conn);
        
        $sql2="INSERT INTO post (cat_id,topic_id,post_creator,post_content,post_date) VALUES ('".$cid."','".$new_topic_id."','".$creator."','".$content."',now())";
 
        $res2 = mysqli_query($conn,$sql2);
        $sql3 = "UPDATE categories SET last_post_date=now(), last_user_posted='".$creator."'WHERE id='".$cid."' LIMIT 1";
  
          $res3=mysqli_query($conn,$sql3);
        if(($res1)&&($res2)&&($res3)){
            header("Location: view_topic.php?cid=".$cid."&tid=".$new_topic_id);
            echo "Success";
            }
        else{
            echo"There is a problem creating your topic, please try again";
        }
        
    }
    }