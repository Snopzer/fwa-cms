<?php
	ob_start(); 
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){
		$country = mysql_real_escape_string($_POST['country']);	
		$insert=  mysql_query("INSERT INTO r_country (name) VALUES ('".$country."')") or die(mysql_error());
		
        if($insert){
			
            header('location:country.php');
		}
        else
		{
            echo "Error Deatails Not Stored";
		}
		}else if($_POST['action']=='edit'){
		$id = (int)$_POST['id'];
		
		$country = mysql_real_escape_string($_POST['country']);
		$id=$_POST['id'];
		$page=$_POST['page'];
		$row="update r_country SET name='$country' where id_country='$id' ";
		$result=  mysql_query($row);
		if($result)
		{
			header("location:country.php?page=$page");
		}
		else {
			echo "failed to update";
		}}
		else if($_GET['action']=='delete'){
		    $id = (int)$_GET['id'];
			$page = $_GET['page'];
			$row = "DELETE FROM r_country WHERE id_country=$id";
			$result = mysql_query($row);
			if ($result) {
				header("location:country.php?page=$page");
			}
			else {
				echo "cannot delete record";
			}}
?>
