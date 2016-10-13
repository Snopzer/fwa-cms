<?php
	/* MySQL Server Host address */
	$host 		=	"localhost";

	/* MySQL User Name */
	$user		=	"root";

	/* MySQL User Password*/
	$password	=	"";

	/* MySQL Database*/
	$database	=	"fwacms";	
	
	/*Connect to Database start*/
	$conn = new mysqli($host, $user, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	/*Connect to Database End*/
    define ( SITE_ADMIN_URL , "http://localhost/fwacms/admin/");
	define ( SITEURL , "http://localhost/fwacms/");
	
?>