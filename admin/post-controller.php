<?php
	ob_start();
	session_start();
	include_once('includes/config.php');
	include_once('includes/fwa-function.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	
	if ($_POST['action'] == 'add') {
		$pic = ($_FILES['photo']['name']);
		//$rows = mysql_query("update r_post SET image='$pic' where id_post=$id")or die(mysql_error());
		$path = "../images/post/" . $_FILES['photo']['name']; 
		if (copy($_FILES['photo']['tmp_name'], $path)) {
			echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
			} else {
			echo "Sorry, there was a problem uploading your file.";
		}
		 
		$title = mysql_real_escape_string($_POST['title']);		
		$description = mysql_real_escape_string($_POST['description']);		
		$category = mysql_real_escape_string($_POST['category']);		
		$status = mysql_real_escape_string($_POST['status']);		
		$category = mysql_real_escape_string($_POST['category']);		
		$seo_url = mysql_real_escape_string($_POST['seo_url']);		
		$meta_title = mysql_real_escape_string($_POST['meta_title']);		
		$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);		
		$meta_description = mysql_real_escape_string($_POST['meta_description']);
		$date_added = date('Y-m-d h:i:s'); 
		$user=$_SESSION['id'];
		$addPost = mysql_query("INSERT INTO r_post (title,image,description,id_category,id_user,date_added,meta_title,meta_keywords,meta_description,status) VALUES ('" . $title . "','" . $pic . "','" . $description . "','" . $category . "','" . $user . "','" . $date_added . "','" . $meta_title . "','" . $meta_keywords . "','" . $meta_description . "','" . $status . "')") or die(mysql_error());

		if ($addPost) {
			$postid=mysql_insert_id();
			addSeoURL($seo_url,0,$postid,0,0);
			$message = "<strong>Success!</strong> Post Added Successfully.";
			header('location:posts.php?response=success&message='.$message);
			} else {
			header('location:posts.php?response=warning');
		}
		} else if ($_POST['action'] == 'edit') {
		
		
		$id = (int)$_POST['id'];
		
		if (isset($_FILES['photo']['name']) && $_FILES['photo']['name']!='') {
			$pic = $_FILES['photo']['name'];
			$path = "../images/post/" . $_FILES['photo']['name']; 
			if (copy($_FILES['photo']['tmp_name'], $path)) {
				echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
				} else {
				echo "Sorry, there was a problem uploading your file.";
			}
			} else {
			$pic = $_POST['preview_image']; 
		}
		
		$title = mysql_real_escape_string($_POST['title']);		
		$description = mysql_real_escape_string($_POST['description']);		
		$category = mysql_real_escape_string($_POST['category']);		
		$status = mysql_real_escape_string($_POST['status']);		
		$category = mysql_real_escape_string($_POST['category']);				
		$seo_url = mysql_real_escape_string($_POST['seo_url']);		
		$meta_title = mysql_real_escape_string($_POST['meta_title']);		
		$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);		
		$meta_description = mysql_real_escape_string($_POST['meta_description']);				
		
		$editPost = mysql_query( "update r_post SET title='".$title."',image='".$pic."',description='".$description."',id_category='".$category."',meta_title = '".$meta_title."',	meta_keywords = '".$meta_keywords."',	meta_description = '".$meta_description."',	status = '".$status."'	where id_post='".$id."' ");
		$page = $_POST['page'];
		if ($editPost) {
			updateSeoURLbyPost($seo_url,0,$id,0,0);
			$message = "<strong>Success!</strong> Post Modified Successfully.";
			header('location:posts.php?response=success&message='.$message.'&page=$page');
			//header("location:posts.php?page=$page");
			} else {
			$message = "<strong>Warning!</strong> Post Not Modified.Please check Carefully..";
			header('location:posts.php?response=danger&message='.$message.'&page=$page');
		}
		}
	else if ($_GET['action'] == 'delete') {
		$id = $_GET['id'];
		$page = $_GET['page'];
		$deletePost = mysql_query("DELETE FROM r_post WHERE id_post=$id");
		if ($deletePost) {
			//header("location:posts.php?page=$page");
			$message = "<strong>Success!</strong> Post Deleted Successfully.";
			header('location:posts.php?response=success&message='.$message.'&page=$page');
		}else{
			$message = "<strong>Warning!</strong> Post Not Deleted. Please check Carefully.";
			header('location:posts.php?response=danger&message='.$message.'&page=$page');
		}
	}
?>
