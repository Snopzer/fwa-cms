<?php
	session_start();
	if (isset($_SESSION['id'])) {
		header('location:home.php');
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>TECHDEFEAT</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Ramadan time table,calender,saher timings,iftaar timings,Ramadan Namaz Timings" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<!-- Custom Theme files -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link href="css/font-awesome.css" rel="stylesheet"> 
		<script src="js/jquery.min.js"> </script>
		<script src="js/bootstrap.min.js"> </script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
	</head>
	<body>
		<div class="login">
			<h1><a href="home.php">TECHDEFEAT</a></h1>
			
			<div class="login-bottom">
				<h2>Sign Up - It's Free And Always Will Be</h2>
				<div class="">
					<?php 
						if(isset($_GET['email'])&&$_GET['email']=="alreadyexist")
						{
						?>
						<div class="alert alert-danger">
							<strong>Warning!</strong> Email already exist! <a href="index.php">Login Here</a>
						</div>
						<?php
						}?>
						<form  action="controller.php?type=signup"  method="post" >
							
							<div class="login-mail" id="mail_field">
								<input type="text" placeholder="Email" name="email" required="" id="email">
								<i class="fa fa-envelope"></i>
							</div>
							<div class="login-mail" id="password_field">
								<input type="password" placeholder="Password" name="password" id="password" required="">
								<i class="fa fa-lock"></i>
							</div>
							<div class="login-mail" id="cpassword_field">
								<input type="password" placeholder="Repeated password" id="cpassword" >
								<i class="fa fa-lock"></i>
							</div>
							<a class="news-letter" id="checkbox" >
								<input  class="input-checkbox" type="checkbox" name="checkbox" id="terms" value="1" >
								<label class="input-label" >I agree with the terms</label>
							</a>
							<div class="login-do">
								<label class="hvr-shutter-in-horizontal login-sub">
									<input type="submit" id="signup" value="Register" >
								</label>
							</div>
						</form>
						<a href="index.php">Already Have an Account Login Now</a>
				</div>
				<div class="clearfix"> </div>
			</div>
			
		</div>
		
		<div class="copy-right">
			<p> &copy; 2016 WWW.TECHDEFEAT.COM All Rights Reserved </p>
		</div>
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>


<script type="text/javascript" language="JavaScript">
	
	
	$("#signup").click(function()
	{
		var email = $("#email").val();
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if((email=='') || (!regex.test(email)))
		{
			$("#mail_field").css({"border-style": "solid", "border-color": "red"});
			$("#email").focus();
			return false;
			}else{
			$("#mail_field").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		
		if($("#password").val()=='')
		{
			$("#password_field").css({"border-style": "solid", "border-color": "red" });
			$("#password").focus();
			return false;
		} 
		else{
			$("#password_field").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		var password = $("#password").val();
		var cpassword = $("#cpassword").val();
		if( (cpassword=='') || password!=cpassword)
		{
			$("#cpassword_field").css({"border-style": "solid", "border-color": "red" });
			$("#cpassword").focus();
			return false;
		} 
		else{
			$("#cpassword_field").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		if($("#terms").prop("checked")==false)
		{
			$("#check_field").css({"border-style": "solid", "border-color": "red" });
			$(".terms").focus();
			return false;
		} 
		else{
			$("#check_field").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
	});
	
</script>

