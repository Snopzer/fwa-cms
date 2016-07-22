<?php
	ob_start();
	session_start();
	include_once('includes/config.php');
	include_once('includes/fwa-function.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
	if($_POST['action']=='add'){	
		$site_name = mysql_real_escape_string($_POST['site_name']);	
		$owner_email = mysql_real_escape_string($_POST['owner_email']);	
		$email_from = mysql_real_escape_string($_POST['email_from']);	
		$phone = mysql_real_escape_string($_POST['phone']);	
		$replay_email = mysql_real_escape_string($_POST['replay_email']);	
		$title = mysql_real_escape_string($_POST['title']);	
		$meta_description = mysql_real_escape_string($_POST['meta_description']);	
		$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);	
		$google_analytics_code = mysql_real_escape_string($_POST['google_analytics_code']);	
		$copyrights = mysql_real_escape_string($_POST['copyrights']); 
		                
			$addSiteData = mysql_query("INSERT INTO r_site_details (site_name,owner_email,email_from,phone,replay_email,title,meta_description,meta_keywords,google_analytics_code,copyrights) VALUES ('" . $site_name . "','" . $owner_email . "','" . $email_from . "','" . $phone . "','" . $replay_email . "','" . $title . "','" . $meta_description . "','" . $meta_keywords . "','" . $google_analytics_code . "','" . $copyrights . "')") or die(mysql_error());		
			if ($addSiteData) {
				header('location:site.php');
				}
			else {
				echo "Error Deatails Not Stored";
				}
			
	}
		else if($_REQUEST['action']=='edit'){
			$id=(int)$_POST['id']  ;  
			$site_name = mysql_real_escape_string($_POST['site_name']);	
			$owner_email = mysql_real_escape_string($_POST['owner_email']);	
			$email_from = mysql_real_escape_string($_POST['email_from']);	
			$phone = mysql_real_escape_string($_POST['phone']);	
			$replay_email = mysql_real_escape_string($_POST['replay_email']);	
			$title = mysql_real_escape_string($_POST['title']);	
			$meta_description = mysql_real_escape_string($_POST['meta_description']);	
			$meta_keywords = mysql_real_escape_string($_POST['meta_keywords']);	
			$google_analytics_code = mysql_real_escape_string($_POST['google_analytics_code']); 	
			$copyrights = mysql_real_escape_string($_POST['copyrights']); 	
			
			$row = "update r_site_details SET site_name='".$site_name."',owner_email='".$owner_email."',email_from='".$email_from."',phone='".$phone."',replay_email='".$replay_email."',title='".$title."',meta_description='".$meta_description."',meta_keywords='".$meta_keywords."',google_analytics_code='".$google_analytics_code."',copyrights='".$copyrights."' where id='$id' ";
			$updateSiteData = mysql_query($row);
					
			if ($updateSiteData) {
				header("location:site.php?page=$page");
				exit;
			}
				
	}
	else if($_REQUEST['action']=='delete'){
		$messageid=explode(",",$_REQUEST["chkdelids"]);
		$count=count($messageid);
		for($i=0;$i<$count;$i++)
		{
			$deleteSite=mysql_query("DELETE FROM r_site_details WHERE id=".$messageid[$i]);
		}
		header("location:site.php?page=$page");
	}
?>
