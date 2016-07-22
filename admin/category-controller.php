<?php
	ob_start();
	session_start();
	include_once('includes/config.php');
	include_once('includes/fwa-function.php');
	
	
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){
		$pic = ($_FILES['photo']['name']);
		$path = "images/" . $_FILES['photo']['name'];
		if (copy($_FILES['photo']['tmp_name'], $path)) {
			echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
			} else {
			echo "Sorry, there was a problem uploading your file.";
		}
		$name = mysql_real_escape_string($_POST['name']);	
		$description = mysql_real_escape_string($_POST['description']);	
		$meta_title = mysql_real_escape_string($_POST['meta_title']);	
		$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);	
		$meta_description = mysql_real_escape_string($_POST['meta_description']);	
		$seo_url = mysql_real_escape_string($_POST['seo_url']);	
		$status = mysql_real_escape_string($_POST['status']);	
		$pic = $_FILES['photo']['name'];
		$date_created= date('Y-m-d h:i:s');
 		
		$addCategory = mysql_query("INSERT INTO r_category (name,description,image,date_created,meta_title,meta_keywords,meta_description,status) VALUES ('" . $name . "','" . $description . "','" . $pic . "','" . $date_created . "','" . $meta_title . "','" . $meta_keywords . "','" . $meta_description . "','" . $status . "')") or die(mysql_error());
		if ($addCategory) {
			
			$categoryid=mysql_insert_id();
			addSeoURL($seo_url,$categoryid,0,0,0);
			
			header('location:category.php');
			} else {
			echo "Error Deatails Not Stored";
		}
		}else if($_POST['action']=='edit'){
		$id=(int)$_POST['id']  ;   
		if (isset($_FILES['photo']['name']) && $_FILES['photo']['name']!='') {
			$pic = $_FILES['photo']['name'];
			$path = "images/" . $_FILES['photo']['name'];
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
		$seo_url = mysql_real_escape_string($_POST['seo_url']);	
		$date_updated = date('Y-m-d h:i:s');
		
		$editCategory = mysql_query("update r_category SET name='".$name."',description='".$description."',meta_title='".$meta_title."',meta_keywords='".$meta_keywords."',meta_description='".$meta_description."',status='".$status."',image='".$pic."'where id_category='".$id."' ");
		if ($editCategory) {
			updateSeoURLbyCategory($seo_url,$id,0,0,0);
			header("location:category.php?page=$page");
			} else {
			header("location:category-controller.php?email=alreadyexist");
		}
	}
	else if($_GET['action']=='delete'){
		$id=$_GET['id'];
		$page=$_GET['page'];
		$deleteCategory= "DELETE FROM r_category WHERE id_category=$id";
		if($deleteCategory)
		{
			header("location:category.php?page=$page");
		}
	}
?>