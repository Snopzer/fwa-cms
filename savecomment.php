<?php 
	include_once('admin/includes/config.php');
	if(isset($_GET['type'])&$_GET['type']=='save'){
        $id=$_GET['id'];
        $seo_url=$_GET['seo_url'];
		$name=$_POST['name'];
        $email=$_POST['email'];
        $subject=$_POST['subject'];
        $message=$_POST['message'];
        $row="insert into r_comment (name,email,subject,message,post_id) VALUES ('$name','$email','$subject','$message','$id')";
        $result=mysql_query($row)or die(mysql_error());
		if($result){
			header('location:/'.$seo_url);
		}
	}
?>