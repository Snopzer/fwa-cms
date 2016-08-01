<?php
	/*
	File name 		: 	config.php
	Date Created 	:	13-06-2016
	Description		:	When the Application is set up in other system all database details should be change in each and every File, so we created this file especially for constants like db credential ect. so that we can include this files in our page and use the database connections
	*/
		$host 		=	"localhost";
		$user		=	"root";
		$password	=	"";
		$database	=	"fwa-cms";		
	
	$serverConnection=mysql_connect($host,$user,$password) or die(mysql_error());
    $connect=mysql_select_db($database,$serverConnection)  or die(mysql_error());
	
	
	
?> 