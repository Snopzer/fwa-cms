<?php
	ob_start(); 
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	
	if($_POST['action']=='add'){
		$country = $conn->real_escape_string($_POST['country']);	
		$insert=  $conn->query("INSERT INTO r_country (name) VALUES ('".$country."')") or die(mysql_error());
		
        if($insert){
			$message = "<strong>Success!</strong> Country Added Successfully.";
			header('location:country.php?response=success&message='.$message);
			} else {
				$message = "<strong>Success!</strong> Country Not Added .Please check Carefully..";
			header('location:country.php?response=warning');
		}
		}else if($_POST['action']=='edit'){
		$id = (int)$_POST['id'];
		
		$country = $conn->real_escape_string($_POST['country']);
		$id=$_POST['id'];
		$page=$_POST['page'];
		$row="update r_country SET name='$country' where id_country='$id' ";
		$result=  $conn->query($row);
		if($result)
		{
			$message = "<strong>Success!</strong> Country Modified Successfully.";
			header('location:country.php?response=success&message='.$message);
			
			} else {
				$message = "<strong>Warning!</strong> Country Not Modified.Please check Carefully..";
			header('location:country.php?response=danger&message='.$message);
			
		}
			
		}
		else if($_REQUEST['action']=='delete'){
			
			$messageid=explode(",",$_REQUEST["chkdelids"]);
		$count=count($messageid);
		for($i=0;$i<$count;$i++)
		{
			$row="DELETE FROM r_country WHERE id_country=".$messageid[$i];
			$result= $conn->query($row);
		}
			if($result)
		{
		    
				$message = "<strong>Success!</strong> Country Deleted Successfully.";
			header('location:country.php?response=success&message='.$message);
			
			} else {
				$message = "<strong>Warning!</strong> Page Not Deleted. Please check Carefully.";
			header('location:country.php?response=danger&message='.$message);
			
		}
		}
?>
