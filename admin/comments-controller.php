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
			$message = "<strong>Success!</strong> Comment Added Successfully.";
			header('location:comments.php?response=success&message='.$message);
			} else {
				$message = "<strong>Success!</strong> Comment Not Added .Please check Carefully..";
			header('location:comments.php?response=warning');
		}
		
           
	}	else if($_POST['action']=='edit'){
		$id = (int)$_POST['id'];
		//echo "$id";
		//exit;
		$name = mysql_real_escape_string($_POST['name']);
		$email = mysql_real_escape_string($_POST['email']);
		$subject = mysql_real_escape_string($_POST['subject']);
		$message = mysql_real_escape_string($_POST['message']);
		
		$editComment=  mysql_query("update r_comment SET name='".$name."',email='".$email."',subject='".$subject."',message='".$message."' where id_comment=".$id ) or die(mysql_error());
		if($editComment)
		{
			$message = "<strong>Success!</strong> Comment Modified Successfully.";
			header('location:comments.php?response=success&message='.$message);
			
			} else {
				$message = "<strong>Warning!</strong> Comment Not Modified.Please check Carefully..";
			header('location:comments.php?response=danger&message='.$message);
			
		}
		}
		else if($_REQUEST['action']=='delete'){
			
			$messageid=explode(",",$_REQUEST["chkdelids"]);
		$count=count($messageid);
		for($i=0;$i<$count;$i++)
		{
			$row="DELETE FROM r_comment WHERE id_comment=".$messageid[$i];
			$result= mysql_query($row);
		}
		if($result)
		{
			$message = "<strong>Success!</strong> Comment Deleted Successfully.";
			header('location:comments.php?response=success&message='.$message);
			
			} else {
				$message = "<strong>Warning!</strong> Comment Not Deleted. Please check Carefully.";
			header('location:comments.php?response=danger&message='.$message);
			
		}
		
		}
?>
