<?php
	/*
	File name 		: 	pages-controller.php
	Date Created 	:	13-06-2016
	Date Updated 	:	08-09-2016
	Description		:	Manage Pages Operation Like Add/Edit/Delete Pages
	*/
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
            $message = "<strong>Success!</strong> Page Added Successfully.";
			header('location:pages.php?response=success&message='.$message);
			} else {
				$message = "<strong>Success!</strong> Page Not Added .Please check Carefully..";
			header('location:pages.php?response=warning');
		}
		}
		else if($_POST['action']=='edit'){
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
			$message = "<strong>Success!</strong> Page Modified Successfully.";
			header('location:pages.php?response=success&message='.$message);
			
			} else {
				$message = "<strong>Warning!</strong> Page Not Modified.Please check Carefully..";
			header('location:pages.php?response=danger&message='.$message);
			
		}
	}
	else if($_REQUEST['action']=='delete'){
		
		$messageid=explode(",",$_REQUEST["chkdelids"]);
		$count=count($messageid);
		for($i=0;$i<$count;$i++)
		{
			$row="DELETE FROM r_page WHERE id_page=".$messageid[$i];
			$result= mysql_query($row);
		}
		if($result)
		{
			$message = "<strong>Success!</strong> Page Deleted Successfully.";
			header('location:pages.php?response=success&message='.$message);
			
			} else {
				$message = "<strong>Warning!</strong> Page Not Deleted. Please check Carefully.";
			header('location:pages.php?response=danger&message='.$message);
			
		}
	} 
?>
