<!DOCTYPE HTML>
<html>
    <head>
        <title>Install FWACMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Install FWACMS" />
        <meta name="keywords" content="Install FWACMS" />
        <link href="admin/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link href="admin/css/style.css" rel='stylesheet' type='text/css' />
        <link href="admin/css/font-awesome.css" rel="stylesheet"> 
        <script src="admin/js/jquery.min.js"></script>
        <script src="admin/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="login">
            <h1><a href="home.php">Install FWACMS</a></h1>
            <div class="login-bottom">
               
					
                <h2>Please Fill the Fields</h2>
				<form id="loginForm">
					<div class="">
						<div class="login-mail" id="mail_field">
                            <input type="text" id="email" name="email" placeholder="DATABASE HOST" >
                            <i class="fa fa-desktop"></i>
                        </div>
                        <div class="login-mail" id="password_field">
                            <input type="password" id="password" name="password" placeholder="DATABASE USER" >
                            <i class="fa fa-user"></i>
                        </div>
						<div class="login-mail" id="password_field">
                            <input type="password" id="password" name="password" placeholder="DATABASE PASSWORD" >
                            <i class="fa fa-lock"></i>
                        </div>
						<div class="login-mail" id="password_field">
                            <input type="password" id="password" name="password" placeholder="DATABASE NAME" >
                            <i class="fa fa-database"></i>
                        </div>
						<a class="right" href="signup.php">Test Connection</a>
						
                    </div>
					 <h2>Please Fill User Details</h2>
                    <div class="">
						<div class="login-mail">
                            <input type="password" id="username" name="username" placeholder="USERNAME" >
                            <i class="fa fa-user"></i>
                        </div>
						<div class="login-mail">
                            <input type="password" id="password" name="password" placeholder="PASSWORD" >
                            <i class="fa fa-lock"></i>
                        </div>
						<div class="login-mail">
                            <input type="password" id="email" name="email" placeholder="EMAIL" >
                            <i class="fa fa-lock"></i>
                        </div>
					</div>
					</form>
					<div class="text-center">
							<button id="LogIn" class="btn btn-warning submit-button" >Install</button>
							<button id="LogIn" class="btn btn-warning submit-button" >Reset</button>
					</div>
                   			
                    <div class="clearfix"> </div>
               
            </div>
        </div>
        <div class="copy-right"><p> &copy; 2016 Techdefeat.com All Rights Reserved </p></div>  
        <script src="admin/js/jquery.nicescroll.js"></script>
        <script src="admin/js/scripts.js"></script>
    </body>
</html>

<script type="text/javascript" language="JavaScript">
	$("#LogIn").click(function()
	{
		$("#showSuccessMessageDiv").hide();
		$("#showMessageDiv").hide();
		$("#showMessage").html('');
		$("#showSuccessMessage").html('');
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var email = $("#email").val();
		if((email=='') || (!regex.test(email)))
		{
			$("#mail_field").css({"border-style": "solid", "border-color": "red"});
			$("#showMessageDiv").show();
			$("#showMessage").html('<strong>Warning! </strong> Please enter your email.');
			$("#email").focus();
			return false;
		}else{
			$("#mail_field").css({"border-style": "solid","border-color": "#E9E9E9"});
		}
		var regex = /(?=^.{5,}$)/;
		var password = $("#password").val();
		if((password=='') || (!regex.test(password)))
		{
		$("#password_field").css({"border-style": "solid", "border-color": "red" });
		$("#showMessageDiv").show();
		$("#showMessage").html('<strong>Warning! </strong> Please enter your password.');
		$("#password").focus();
		return false;
		}
		else{
			$("#password_field").css({"border-style": "solid","border-color": "#E9E9E9"});
		}	
		$.ajax({
		url: "controller.php",
		method: "GET",
		data: { loginData : $("#loginForm").serialize(), 'action':'login'},
		dataType: "json",
		success: function (response) {
			if(response["success"]==true)
			{
				$("#showMessageDiv").hide();
				$("#showSuccessMessageDiv").show();
				$("#showSuccessMessage").html("<strong>Success! </strong> Please Wait...!");
				location = '/admin/controller.php?action=checkLogin&loginid='+response["id"];
				window.open(location);
			}else{
				$("#showMessageDiv").show();
				$("#showMessage").html(response["message"]);
			}
		},
		error: function (request, status, error) {
			$("#showMessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
		}
		});
		return false;
		
	});
</script>
