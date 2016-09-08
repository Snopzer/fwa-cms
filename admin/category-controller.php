<?php
	/*
	File name 		: 	category-controller.php
	Date Created 	:	13-06-2016
	Date Updated 	:	08-09-2016
	Description		:	Manage Category Operation Like Add/Edit/Delete Categories
	*/
	
	ob_start();
	session_start();
	include_once('includes/config.php');
	include_once('includes/fwa-function.php');
	
	
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){
	
	if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != '') {
		$path = "../images/category/" . $_FILES['photo']['name'];
		if (copy($_FILES['photo']['tmp_name'], $path)) {
			$pic = $_FILES['photo']['name'];
			echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
			} else {
			echo "Sorry, there was a problem uploading your file.";
		}
		}
		$name 				= mysql_real_escape_string($_POST['name']);	
		$description 		= mysql_real_escape_string($_POST['description']);	
		$meta_title 		= mysql_real_escape_string($_POST['meta_title']);	
		$meta_keywords		= mysql_real_escape_string($_POST['meta_keywords']);	
		$meta_description 	= mysql_real_escape_string($_POST['meta_description']);	
		$seo_url 			= mysql_real_escape_string($_POST['seo_url']);	
		$status 			= mysql_real_escape_string($_POST['status']);	
		$sort_order			= mysql_real_escape_string($_POST['sort_order']);	 
		$date_created		= date('Y-m-d h:i:s');
 		
		$addCategory = mysql_query("INSERT INTO r_category (name,description,image,date_created,meta_title,meta_keywords,meta_description,sort_order,status) VALUES ('" . $name . "','" . $description . "','" . $pic . "','" . $date_created . "','" . $meta_title . "','" . $meta_keywords . "','" . $meta_description . "','".$sort_order."','" . $status . "')") or die(mysql_error());
		if ($addCategory) {
			
			$categoryid=mysql_insert_id();
			addSeoURL($seo_url,$categoryid,0,0,0);
			$message = "<strong>Success!</strong> category Added Successfully.";
			header('location:category.php?response=success&message='.$message);
			} else {
				$message = "<strong>Success!</strong> category Not Added .Please check Carefully..";
			header('location:posts.php?response=warning');
		}
		}else if($_POST['action']=='edit'){
		$id=(int)$_POST['id']  ;   
		if (isset($_FILES['photo']['name']) && $_FILES['photo']['name']!='') {
			$pic = $_FILES['photo']['name'];
			$path = "../images/category/" . $_FILES['photo']['name']; 
			if (copy($_FILES['photo']['tmp_name'], $path)) {
				echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
				} else {
				echo "Sorry, there was a problem uploading your file.";
			}
		} 
		else {
			$pic = $_POST['preview_image'];
		}
		$name = mysql_real_escape_string($_POST['name']);
		$description = mysql_real_escape_string($_POST['description']);
		$meta_title = mysql_real_escape_string($_POST['meta_title']);		
		$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);		
		$meta_description = mysql_real_escape_string($_POST['meta_description']);
		$status = mysql_real_escape_string($_POST['status']);	
		$seo_url = mysql_real_escape_string($_POST['seo_url']);	
		$sort_order = mysql_real_escape_string($_POST['sort_order']);
		$date_updated = date('Y-m-d h:i:s');
		/*echo "update r_category SET name='".$name."',description='".$description."',meta_title='".$meta_title."',meta_keywords='".$meta_keywords."',meta_description='".$meta_description."',status='".$status."',image='".$pic."',sort_order='".$sort_order."' where id_category='".$id."' ";
		exit;*/
		$editCategory = mysql_query("update r_category SET name='".$name."',description='".$description."',meta_title='".$meta_title."',meta_keywords='".$meta_keywords."',meta_description='".$meta_description."',status='".$status."',image='".$pic."',sort_order='".$sort_order."' where id_category='".$id."' ");
		if ($editCategory) {
			
			
			updateSeoURLbyCategory($seo_url,$id,0,0,0);
			$message = "<strong>Success!</strong> Category Modified Successfully.";
			header('location:category.php?response=success&message='.$message);
			
			} else {
				$message = "<strong>Warning!</strong> Category Not Modified.Please check Carefully..";
			header('location:category.php?response=danger&message='.$message);
			
		}
	}
	else if($_REQUEST['action']=='delete'){
		$messageid=explode(",",$_REQUEST["chkdelids"]);
		$count=count($messageid);
		for($i=0;$i<$count;$i++)
		{
			$row="DELETE FROM r_category WHERE id_category=".$messageid[$i];
			$result= mysql_query($row);
		}
		if($result){
		$message = "<strong>Success!</strong> Category Deleted Successfully.";
			header('location:category.php?response=success&message='.$message);
		}
		else{
			$message = "<strong>Warning!</strong> Category Not Deleted. Please check Carefully.";
			header('location:category.php?response=danger&message='.$message);
		}
	}
	
		?>