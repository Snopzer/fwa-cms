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
        <link href="css/style.css" rel='stylesheet' type='text/css' />
        <link href="css/font-awesome.css" rel="stylesheet"> 
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="login">
            <h1><a href="home.php">Techdefeat</a></h1>
            <div class="login-bottom">
                <h2>Login</h2>
                <?php
                if (isset($_GET['login']) && $_GET['login'] == 'fail') {
                    ?>
                    <p style="color:red">Login Failed Please Check Your Details</p>
                    <?php
                }
                ?>  
                
                    <input type="hidden" name="login">
                    <div class="">
						<form action="controller.php?type=signin" method="POST" >
                        <div class="login-mail" id="mail_field">
                            <input type="text" id="email" name="email" placeholder="Email" >
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="login-mail" id="password_field">
                            <input type="password" id="password" name="password" placeholder="Password" >
                            <i class="fa fa-lock"></i>
                        </div>
						<div class="login-do">
							<label class="hvr-shutter-in-horizontal login-sub">
								<input type="submit" id="login" value="login">
							</label>
						</div>
						</form>
                        <a class="forgot-password " href="forgotpassword.php">Forget Password </a>   |
							<a href="signup.php">Do not have an account?</a>
                    </div>
                   			
                    <div class="clearfix"> </div>
               
            </div>
        </div>
        <div class="copy-right"><p> &copy; 2016 Techdefeat.com All Rights Reserved </p></div>  
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>

<script>
    $("#login").click(function ()
    {
        var email = $("#email").val();
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //return regex.test(email);
        //if email is empty or email is invalid then show alert message
        if ((email == '') || (!regex.test(email)))
        {
            //alert("Please Enter email");
            //instead of alert message show the warning desing to field
            $("#mail_field").css({"border-style": "solid", "border-color": "red"});
            $("#email").focus();
            return false;

        }
        if ($("#password").val() == '')
        {
            $("#password_field").css({"border-style": "solid", "border-color": "red"});
            $("#password").focus();
            return false;
        }
    });
</script>