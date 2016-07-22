<?php

	ob_start();
    session_start();
    include_once('includes/config.php');
	if(isset($_GET['type']) && $_GET['type']=="signup")
	{
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$password=mysql_real_escape_string($password);
		$row=  mysql_query("SELECT * FROM r_user where email='".$email."'") or die(mysql_error());
		$count=mysql_num_rows($row);
		
		if($count>=1)
		{
			header('location:signup.php?email=alreadyexist');
		}else{
			$sql= mysql_query("INSERT INTO r_user (email,password,image) VALUES ('".$email."','".$password."', 'no-user-image.png')") or die(mysql_error());
			$_SESSION['id'] = mysql_insert_id();
			$_SESSION['name'] = 'New User';
			$_SESSION['image'] = 'no-user-image.png';
		}
		if($sql){        
			header('location:profile.php');
			}else{
			echo "Resgistration failed.";
		} 
	} 
	elseif(isset($_GET['type']) && $_GET['type']== "signin" )
	{ 
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$password=mysql_real_escape_string($password);
		$sql	=  mysql_query("SELECT * FROM r_user where email='$email' and password='$password' ") or die(mysql_error());
		$count	=  mysql_num_rows($sql);
		if($count==1){
			$result = mysql_fetch_array($sql);
			$_SESSION['name'] = ($result['name']!='')?$result['name']:'New User';
			$_SESSION['image'] = ($result['image']!='')?$result['image']:'no-user-image.png';
			$_SESSION['id'] = $result['id_user'];
			header('location:home.php'); 
		}
		else{
			header('location:index.php?login=fail'); 
		}
	}
	elseif(isset($_GET['type']) && $_GET['type']== "logout" )
	{
		if (!isset($_SESSION['id'])) {
			header('location:index.php');
			} else {
			session_destroy();
			header('location:index.php');
		}
	}
	elseif(isset($_GET['type']) && $_GET['type']== "editprofile" )
	{
		$id=$_POST['id'];
		$pic=($_FILES['photo']['name']);
		$rows=mysql_query("update r_user SET image='".$pic."' where id_user=".$id)or die(mysql_error()) ;
		$path= "../../images/users/".$_FILES['photo']['name'];
		if(copy($_FILES['photo']['tmp_name'], $path))
		{
			echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory";
		}
		else{
			echo "Sorry, there was a problem uploading your file.";
		}
		
		$name=$_POST['name'];
		$department=$_POST['department'];
		$email=$_POST['email'];
		$skills=$_POST['skills'];
		$phone=$_POST['phone'];
		$country=$_POST['country'];
		$image=$_POST['image'];
		$row="update r_user SET name='$name',department='$department',email='$email',phone='$phone',skills='$skills',country='$country' where id_user='$id'";
		$result=mysql_query($row) or die (mysql_error());
		
		if($result){
			header('location:profile.php');
		}
		else{
			header('location:profile.php');
		}
	}
?>