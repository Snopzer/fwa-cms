<?php
	ob_start(); 
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){
		$name = mysql_real_escape_string($_POST['name']);
		$email = mysql_real_escape_string($_POST['email']);
		$subject = mysql_real_escape_string($_POST['subject']);
		$message = mysql_real_escape_string($_POST['message']);
		
		$addCommentQuery =  mysql_query("INSERT INTO r_comment (name,email,subject,message) VALUES ('".$name."','".$email."','".$subject."','".$message."')") or die(mysql_error());
		
        if($addCommentQuery){
		
            header('location:comments.php');
			exit;
		}
        else
		{
            echo "Error Deatails Not Stored";exit;
		}
	}	else if($_POST['action']=='edit'){
		$id = (int)$_POST['id'];
		$name = mysql_real_escape_string($_POST['name']);
		$email = mysql_real_escape_string($_POST['email']);
		$subject = mysql_real_escape_string($_POST['subject']);
		$message = mysql_real_escape_string($_POST['message']);
		
		$editComment=  mysql_query("update r_comment SET name='".$name."',email='".$email."',subject='".$subject."',message='".$message."' where id=".$id ) or die(mysql_error());
		if($editComment)
		{
			header("location:comments.php?page=$page");
		}
		else {
			echo "failed to update";
		}
		}
		else if($_GET['action']=='delete'){
		    $id = (int)$_GET['id'];
			$page = $_GET['page'];
			$deleteComment = mysql_query("DELETE FROM r_comment WHERE id=$id");
			if ($deleteComment) {
				header("location:comments.php?page=$page");
			}
			else {
				echo "cannot delete record";
			}}
?>
