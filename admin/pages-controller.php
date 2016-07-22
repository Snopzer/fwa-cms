<?php
	ob_start();
	session_start();
	include_once('includes/config.php');
	include_once('includes/fwa-function.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){
	
		$title = mysql_real_escape_string($_POST['title']);	
		$meta_description = mysql_real_escape_string($_POST['meta_description']);	
		$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);	
		$page_heading = mysql_real_escape_string($_POST['page_heading']);	
		$page_description = mysql_real_escape_string($_POST['page_description']);	
		$seo_url = mysql_real_escape_string($_POST['seo_url']);	
		
		
        $addPage=  mysql_query("INSERT INTO r_page (title,meta_description,meta_keywords,page_heading,page_description) VALUES ('".$title."','".$meta_description."','".$meta_keywords."','".$page_heading."','".$page_description."')") or die(mysql_error());
		
        if($addPage){
			$pageid=mysql_insert_id();
			addSeoURL($seo_url,0,0,$pageid,0);
            header('location:pages.php');
		}
        else
		{
            echo "Error Deatails Not Stored";
		}
		}else if($_POST['action']=='edit'){
		$id=(int)$_POST['id'];
		$page=$_POST['page'];
       
		$title = mysql_real_escape_string($_POST['title']);	
		$meta_description = mysql_real_escape_string($_POST['meta_description']);	
		$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);	
		$page_heading = mysql_real_escape_string($_POST['page_heading']);	
		$page_description = mysql_real_escape_string($_POST['page_description']);	
		$seo_url = mysql_real_escape_string($_POST['seo_url']);	
		
		$editPage=mysql_query("update r_page SET title='$title',meta_description='$meta_description',meta_keywords='$meta_keywords',page_heading='$page_heading',page_description='$page_description' where id_page='$id' ");
		if($editPage)
		{
			updateSeoURLbyPage($seo_url,0,0,$id,0);
			header("location:posts.php?page=$page");
			header("location:pages.php?page=$page");
		}
		else {
			echo "failed to update";
		}
	}
	else if($_GET['action']=='delete'){
		$id = (int)$_GET['id'];
		$page=$_GET['page'];
		$deletePage = mysql_query("DELETE FROM r_page WHERE id_page=$id");
		if ($deletePage) {
			header("location:pages.php?page=$page");
		}
	} 
?>
