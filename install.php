<!DOCTYPE HTML>
<html>
    <head>
        <title>Install FWACMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="install/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link href="install/css/style.css" rel='stylesheet' type='text/css' />
        <link href="install/css/font-awesome.css" rel="stylesheet"> 
        <script src="install/js/jquery.min.js"></script>
        <script src="install/js/bootstrap.min.js"></script>
	</head>
    <body>
        <div class="login">
            <h1><a href="index.php">Install FWACMS</a></h1>
            <div class="login-bottom">
				
				<span id="showMessage"> </span>
                <span id="installSuccess"></span>
				<div id="setupdone" style="display:none;">
				Visit Admin Panel : <a href="#" id="adminURL">Manage Site</a><br />
				Your Blog : <a href="#" id="siteURL">Visit Site</a>
				</div>
				<form id="installForm" class="setup-div">
				<h2>Please Fill the Fields</h2>
				
				<div class="">
						<div class="login-mail" id="database_host">
                            <input type="text" id="db_host" name="db_host" placeholder="DATABASE HOST" >
                            <i class="fa fa-desktop"></i>
						</div>
                        <div class="login-mail" id="database_user">
                            <input type="text" id="db_user" name="db_user" placeholder="DATABASE USER" >
                            <i class="fa fa-user"></i>
						</div>
						<div class="login-mail" id="database_password">
                            <input type="text" id="db_password" name="db_password" placeholder="DATABASE PASSWORD" >
                            <i class="fa fa-lock"></i>
						</div>
						<div class="login-mail" id="database_name">
                            <input type="text" id="db_name" name="db_name" placeholder="DATABASE NAME" >
                            <i class="fa fa-database"></i>
						</div>
						<span id="TestConnection" class="btn btn-success  right" >Test Connection</span>
						
					</div>
					<h2>Please Fill User Details</h2>
                    <div class="">
						<div class="login-mail" id="username_field">
                            <input type="text" id="td_username" name="fwa_username" placeholder="USERNAME" >
                            <i class="fa fa-user"></i>
						</div>
						<div class="login-mail" id="password_field">
                            <input type="text" id="td_password" name="fwa_password" placeholder="PASSWORD" >
                            <i class="fa fa-lock"></i>
						</div>
						<div class="login-mail" id="email_field">
                            <input type="text" id="td_email" name="fwa_email" placeholder="EMAIL" >
                            <i class="fa fa-lock"></i>
						</div>
					</div>
					
				</form>
					<div class="text-center setup-div">
						<button id="install" class="btn btn-warning submit-button" >Install</button>
						<span id="Reset" class="btn btn-warning submit-button" >Reset</span>
					</div>
				
				<div class="clearfix"> </div>
				
			</div>
		</div>
        <div class="copy-right"><p> &copy; 2016 FWACMS All Rights Reserved </p></div>  
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
	</body>
</html>

<script type="text/javascript" language="JavaScript">
	$("#install").click(function(){
	$.ajax({
			url: "install-controller.php",
			method: "POST",
			data: { installData : $("#installForm").serialize(), 'action':'install'},
			dataType: "json",
			success: function (response) {
				if(response["success"]==true)
				{	
					
					$("#showMessage").html(response["message"]);
					$(".setup-div").hide();
					$("#setupdone").show();
					$("#adminURL").attr("href",response["adminURL"]);
					$("#siteURL").attr("href",response["siteURL"]);
					$("#installSuccess").show();
					}else{
					$("#showMessage").html(response["message"]);
				}
			},
			error: function (request, status, error) {
				$("#showMessage").html("OOPS! Something Went Wrong Please Try After Sometime!");
			}
		});
	});
	$("#TestConnection").click(function(){
		$.ajax({
			url: "install-controller.php",
			method: "POST",
			data: { installData : $("#installForm").serialize(), 'action':'test'},
			dataType: "json",
			success: function (response) {
				if(response["success"]==true)
				{	
					$("#showMessage").html(response["message"]);
					}else{
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
