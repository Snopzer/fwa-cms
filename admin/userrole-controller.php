<?php
	/*
	File name 		: 	usersrole-controller.php
	Date Created 	:	13-06-2016
	Date Updated 	:	08-09-2016
	Description		:	Manage User Role Operation Like Add/Edit/Delete Users Roles
	*/
	ob_start();
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){		
		$role = mysql_real_escape_string($_POST['role']);	
		$status = mysql_real_escape_string($_POST['status']);	
                                  
		$insert = mysql_query("INSERT INTO r_user_role (role,status) VALUES ('" . $role . "','" . $status . "')") or die(mysql_error());		
			if ($insert) {
				$userid=mysql_insert_id();
				//addSeoURL($seo_url,0,0,0,$userid);
				$message = "<strong>Success!</strong> User role Added Successfully.";
				header('location:userrole.php?response=success&message='.$message);
				}
			else {
				$message = "<strong>Warning!</strong> User Not Added.Please check Carefully..";
				header('location:userrole.php?response=Warning&message='.$message);
				}
			}
		else if($_REQUEST['action']=='edit'){
			$id=(int)$_POST['id']  ;   
			$role = mysql_real_escape_string($_POST['role']);	
			$status = mysql_real_escape_string($_POST['status']);	
			$page=$_POST['page'];
			$row = "update r_user_role SET role='".$role."',status=".$status." where id_user_role='$id' ";
			$result = mysql_query($row);
						
			if ($result) {
				$userid=mysql_insert_id();
				////updateSeoURLbyUser($seo_url,0,0,0,$id);
			$message = "<strong>Success!</strong> User Modified Successfully.";
			header('location:userrole.php?response=success&message='.$message);
			} else {
			$message = "<strong>Warning!</strong> User Not Modified.Please check Carefully..";
			header('location:userrole.php?response=danger&message='.$message);
				} 
	}
	else if($_REQUEST['action']=='delete'){
		$messageid=explode(",",$_REQUEST["chkdelids"]);
		$count=count($messageid);
		for($i=0;$i<$count;$i++)
		{
			$row="DELETE FROM r_user_role WHERE id_user_role=".$messageid[$i];
			$result= mysql_query($row);
		}
		if ($result) {
			$message = "<strong>Success!</strong> user role Deleted Successfully.";
		     header('location:userrole.php?response=success&message='.$message);
		}else{
			$message = "<strong>Warning!</strong> User role Not Deleted. Please check Carefully.";
			header('location:userrole.php?response=danger&message='.$message);
		}
	}
?>
