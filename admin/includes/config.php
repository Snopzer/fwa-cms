<?php
	/*
	File name 		: 	config.php
	Date Created 	:	13-06-2016
	Date Updated 	:	08-09-2016
	Description		:	When the Application is set up in other system all database details should be change in each and every File, so we created this file especially for constants like db credential ect. so that we can include this files in our page and use the database connections
	*/
	/* MySQL Server Host address */
	$host 		=	"";
	
	/* MySQL User Name */
	$user		=	"";
	
	/* MySQL User Password*/
	$password	=	"";
	
	/* MySQL Database*/
	$database	=	"";		
	
	$serverConnection=mysql_connect($host,$user,$password) or die(mysql_error());
    $connect=mysql_select_db($database,$serverConnection)  or die(mysql_error());
	
	
	/*The Below Parameters will enhance in Next Edit will get the Details form Database so that no need to change in Config File */
	/*SITE Details*/
	define ( SITEURL , '');
	
	/* Admin parameters */
	define ( ADD_BUTTON , 'Add');
	define ( EDIT_BUTTON , 'Edit');
	define ( DELETE_BUTTON , 'Delete');
	define ( SAVE_BUTTON , 'SAVE');
	define ( UPDATE_BUTTON , 'UPDATE');
	define ( ADMIN_PAGE_LIMIT , 10);
	
	/* Admin Notification Messages */
	define ( ADMIN_NO_RECORDS_FOUND , 'No Records Found');
	
	/* Contact Page Parameters*/
	define ( CONTACT_MAIL , 'info@snopzer.com');
	define ( CONTACT_PHONE , '7207556743');
	define ( CONTACT_ADDRESS , 'snopzer.com');
	define(POST_DESCRIPTION_LENGTH,300);
	define ( SITE_COPY_RIGHTS , '&copy; 2016 www.techdefeat.com All Rights Reserved');
	
	
?>