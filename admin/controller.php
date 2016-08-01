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
			header('location:signup.php?email=alreadyexist');
			}else{
			$activate_link = rand(0,1000);
			$sql= mysql_query("INSERT INTO r_user (email,password,image,status,activate_link) VALUES ('".$email."','".$password."', 'no-user-image.png',0,$activate_link)") or die(mysql_error());
			$_SESSION['id'] = mysql_insert_id();
			$_SESSION['name'] = 'New User';
			$_SESSION['image'] = 'no-user-image.png';
		}
		if($sql){
			$password=md5('password');
			// activation-strart
			$to      = $email; // Send email to our user
			$subject = 'Signup | Verification'; // Give the email a subject 
			$message = '
			Thanks for signing up!
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
			------------------------
			Email: '.$email.'
			Password: '.$passwordmail.' 
			------------------------
			Please click this link to activate your account:
			http://www.techdefeat.com/admin/controller.php?activate_link='.$activate_link.'  
			'; // Our message above including the link
			$headers = 'From:fareed543@gmail.com' . "\r\n"; // Set from headers
			$sendmail=mail($to, $subject, $message, $headers); // Send our email
			//ends activation
			if($sendmail)	{
				header('location:signup.php?msg=email-conformation-pending');
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
		//check the activation link is there are not.?
		//if there change status to 1 and login him and take him to profile page
		
		$activate_link=$_GET['activate_link'];
		
		$c=mysql_query("SELECT status FROM r_user WHERE activate_link='".$activate_link."'") or die(mysql_error());
		if(mysql_num_rows($c) > 0)
		{
			$count=mysql_query("SELECT * FROM r_user WHERE activate_link='$activate_link' and status='0'") or die(mysql_error());
			$i=mysql_fetch_array($count);
			$id=$i['id_user'];
			echo $id;
			exit; 
			if(mysql_num_rows($count) == 1)
			{
				mysql_query("UPDATE r_user SET status='1',activate_link='' WHERE id_user='$id' ") or die(mysql_error());
				header('location:profile.php');
				//exit;
				//$msg="Your account is activated"; 
			}
			else
			{
				echo "$msg =Your account is already active, no need to activate again";
			}
		}
		else
		{
		echo	"$msg =Wrong activation code.";
		}
	}
	?>