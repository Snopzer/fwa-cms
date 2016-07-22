<?php
	ob_start();
	session_start();
	include_once('includes/config.php');
	include_once('includes/fwa-function.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){		
		$name = mysql_real_escape_string($_POST['name']);	
		$email = mysql_real_escape_string($_POST['email']);	
		$password = mysql_real_escape_string($_POST['password']);	
		$phone = mysql_real_escape_string($_POST['phone']);	
		$department = mysql_real_escape_string($_POST['department']);	
		$skills = mysql_real_escape_string($_POST['skills']);	
		$name = mysql_real_escape_string($_POST['name']);	
		$country = mysql_real_escape_string($_POST['country']);	
		$status = mysql_real_escape_string($_POST['status']);	
		$seo_url = $_POST['seo_url'];
		
		$checkEmail=  mysql_query("SELECT * FROM r_user where email='".$email."' ") or die(mysql_error());
		$count=mysql_num_rows($checkEmail);
		if($count==1)
		{
			header('location:users.php?email=alreadyexist');
			}else{                   
			$insert = mysql_query("INSERT INTO r_user (name,email,phone,department,password,skills,id_country,status) VALUES ('" . $name . "','" . $email . "','" . $phone . "','" . $department . "','" . md5($password) . "','" . $skills . "','" . $country . "','" . $status . "')") or die(mysql_error());		
			if ($insert) {
				$userid=mysql_insert_id();
				addSeoURL($seo_url,0,0,0,$userid);
				header('location:users.php');
				}
			else {
				echo "Error Deatails Not Stored";
				}
			}
	}
		else if($_REQUEST['action']=='edit'){
			$id=(int)$_POST['id']  ;   
			$name = mysql_real_escape_string($_POST['name']);	
			$phone = mysql_real_escape_string($_POST['phone']);	
			$department = mysql_real_escape_string($_POST['department']);	
			$skills = mysql_real_escape_string($_POST['skills']);	
			$name = mysql_real_escape_string($_POST['name']);	
			$country = mysql_real_escape_string($_POST['country']);	
			$status = mysql_real_escape_string($_POST['status']);	
			$page = mysql_real_escape_string($_POST['page']);	
			$seo_url = mysql_real_escape_string($_POST['seo_url']);	
			$email = mysql_real_escape_string($_POST['email']);	
			
			$row = "update r_user SET email='".$email."',name='".$name."',phone='".$phone."',department='".$department."',skills='".$skills."',id_country='".$country."',status=".$status." where id_user='$id' ";
			$result = mysql_query($row);
			
			if(isset($_POST['password']) && $_POST['password'])
			{
				$password = $_POST['password'];
				$updatePasswordQuery = "update r_user SET password='".md5($password)."' where id_user='$id' ";
				mysql_query($updatePasswordQuery);
			}
			
			if ($result) {
				updateSeoURLbyUser($seo_url,0,0,0,$id);
				header("location:users.php?page=$page");
				} 
	}
	else if($_REQUEST['action']=='delete'){
		$messageid=explode(",",$_REQUEST["chkdelids"]);
		$count=count($messageid);
		for($i=0;$i<$count;$i++)
		{
			$row="DELETE FROM r_user WHERE id_user=".$messageid[$i];
			$result= mysql_query($row);
		}
		header("location:users.php?page=$page");
	}
?>
