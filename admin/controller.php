<?php	
	ob_start();
    session_start();
    include_once('includes/config.php');
	if(isset($_GET['type']) && $_GET['type']=="signup")
	{
		$email=$_POST['email'];
		$passwordmail=$_POST['password'];
		$password=md5($_POST['password']);
		$password=mysql_real_escape_string($password);
		$row=  mysql_query("SELECT * FROM r_user where email='".$email."'") or die(mysql_error());
		$count=mysql_num_rows($row);
		
		if($count>=1) 
		{
			header('location:signup.php?msg=Email Already  Exist!');
		}else{
			$activate_link = rand(0,1000);
			$sql= mysql_query("INSERT INTO r_user (email,password,image,status,activate_link) VALUES ('".$email."','".$password."', 'no-user-image.png',0,$activate_link)") or die(mysql_error());
			}
		if($sql){
			$password=md5('password');
			$subject = 'Techdefeat Signup | Verification';
			$message = '
			Thanks for signing up!
			Your account has been created, you can login with the following credentials after you have activated your account.
			------------------------
			Email: '.$email.'
			Password: '.$passwordmail.' 
			------------------------
			Please click this link to activate your account:
			'.SITEURL.'admin/controller.php?activate_link='.$activate_link;
			$headers = 'From:info@snopzer.com' . "\r\n"; 
			$sendmail=mail($email, $subject, $message, $headers);
			if($sendmail)	{
				header('location:signup.php?msg=Activation Link Sent to Your Phone');
				exit;
				}else{
				echo "Resgistration failed.";
			} 
		}
	} 
	elseif(isset($_GET['type']) && $_GET['type']== "signin" )
	{ 
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$password=mysql_real_escape_string($password);
		$sql	=  mysql_query("SELECT * FROM r_user where email='$email' and password='$password' and status=1") or die(mysql_error());
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
	elseif(isset($_GET['type']) && $_GET['type']== "forgetpassword" )
	{ 
		$email=mysql_real_escape_string($_POST['email']);
		$sql	=  mysql_query("SELECT * FROM r_user where email='$email'") or die(mysql_error());
		$count	=  mysql_num_rows($sql);
		
		
		if($count==1){
			$password = rand(0,1000);
			$sql	=  mysql_query("UPDATE r_user set password= '".md5($password)."' where email='$email'") or die(mysql_error());
		
			$subject = 'Techdefeat Password Updated'; // Give the email a subject 
			$message = '
			Your Password has been changed successfully
			------------------------
			Email: '.$email.'
			Password: '.$password.' 
			------------------------';
			$headers = 'From:info@snopzer.com' . "\r\n"; 
			
			$sendmail=mail($email, $subject, $message, $headers);
			header('location:forgotpassword.php?msg=Password Changed Successfully'); 
		}
		else{
			header('location:forgotpassword.php?msg=No Email Exist!'); 
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
	
	
	
	elseif( isset($_GET['activate_link'])&& ($_GET['activate_link']!='') )
	{
		$activate_link=$_GET['activate_link'];
		
		$c=mysql_query("SELECT status FROM r_user WHERE activate_link='".$activate_link."'") or die(mysql_error());
		if(mysql_num_rows($c) > 0)
		{
			$count=mysql_query("SELECT * FROM r_user WHERE activate_link='$activate_link' and status='0'") or die(mysql_error());
			$i=mysql_fetch_array($count);
			$id=$i['id_user'];
			if(mysql_num_rows($count) == 1)
			{
				mysql_query("UPDATE r_user SET status='1',activate_link='' WHERE id_user='$id' ") or die(mysql_error());
				header('location:index.php?msg=Your Account is Activated'); 
				exit;
			}
			else
			{
				 header('location:index.php?msg=Wrong Activation Code');
				 exit;
			}
		}
		else
		{
			header('location:index.php?msg=Your Activation Link Got Expired');
			exit;
		}
	}
	?>