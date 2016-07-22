<?php
	ob_start();
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){
	
		$name = mysql_real_escape_string($_POST['name']);	
		$subject = mysql_real_escape_string($_POST['subject']);	
		$email = mysql_real_escape_string($_POST['email']);	
		$message = mysql_real_escape_string($_POST['message']);	
		$date_created = date('Y-m-d h:i:s'); 
		
		$addMessage = mysql_query("INSERT INTO r_message (name,subject,email,message,date_created) VALUES ('" . $name . "','" . $subject . "','" . $email . "','" . $message . "','" . $date_created . "')") or die(mysql_error());
		if ($addMessage) {
			header('location:message.php');
			} else {
			echo "Error Deatails Not Stored";
		}
	}else if($_POST['action']=='edit'){
		$id = $_POST['id'];
		$name = filter_input(INPUT_POST, 'name');
		$subject = filter_input(INPUT_POST, 'subject');
		$email = filter_input(INPUT_POST, 'email');
		$message = filter_input(INPUT_POST, 'message');
		$name = mysql_real_escape_string($_POST['name']);	
		$subject = mysql_real_escape_string($_POST['subject']);	
		$email = mysql_real_escape_string($_POST['email']);	
		$message = mysql_real_escape_string($_POST['message']);	
		
		$page=$_POST['page'];
		$editMessage = mysql_query("update r_message SET name='".$name."',subject='".$subject."',email='".$email."',message='".$message."' where id_message='".$id."' ");
		if ($editMessage) {
			header("location:message.php?page=$page");
			} else {
			header("location:message-controller.php?email=alreadyexist");
		}
	}
		else if($_GET['action']=='delete'){
		$id=(int)$_GET['id'];
		$page=$_GET['page'];
		$deleteMessage =mysql_query("DELETE FROM r_message WHERE id_message=$id");
		if($result)
		{
			header("location:message.php?page=$page");
		}
	}
?>
