<?php
	/*
	File name 		: 	config.php
	Date Created 	:	13-06-2016
	Date Updated 	:	08-09-2016
	Description		:	When the Application is set up in other system all database details should be change in each and every File, so we created this file especially for constants like db credential ect. so that we can include this files in our page and use the database connections
	*/
	
	/*display error settings*/
	//error_reporting(1);
	
	
	/* MySQL Server Host address */
	$host 		=	"localhost";
	
	/* MySQL User Name */
	$user		=	"root";
	
	/* MySQL User Password*/
	$password	=	"";
	
	/* MySQL Database*/
	$database	=	"fwacms";		
	
	/*The Below Parameters will enhance in Next Edit will get the Details form Database so that no need to change in Config File */
	/*SITE Details*/
	define ( SITE_NAME , 'TechDefeat');
	define ( SITE_KEYWORDS , 'TechDefeat');
	define ( SITE_DESCRIPTION , 'Techdefeat will provide you solutions for your Windows Software Problems, Website Creation, Managing websites, Static, Dynamic Websites and  Search Engine Optimization for your website and many more intrestin facts');
	define ( SITE_ADMIN_URL , 'http://techdefeat/admin/');
	define ( SITEURL , 'http://techdefeat.com/');
	define ( OWNER_NAME , 'Mohammad Fareed');
	
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
	define ( POST_DESCRIPTION_LENGTH,300);
	
	/*Email Settings*/
	define ( ADMIN_MAIL , 'fareed@techdefeat.com');
	define ( FROM_MAIL , 'info@techdefeat.com');
	define ( REPLY_TO_MAIL , 'no-reply@techdefeat.com');
	define ( SITE_COPY_RIGHTS , '&copy; 2016 www.techdefeat.com All Rights Reserved');
	
	/*Social Network Pages*/
	define ( SOCIAL_FACEBOOK_URL , 'https://www.facebook.com/techdefeat1/');
	define ( SOCIAL_TWITTER_URL , 'https://twitter.com/techdefeat_com');
	define ( SOCIAL_GOOGLEPLUS_URL , 'https://plus.google.com/b/106136272474879652354/?pageId=106136272474879652354');
	define ( SOCIAL_LINKEDIN_URL , '');
	define ( SOCIAL_BEHANCE_URL , '');
	define ( SOCIAL_VIMIO_URL , 'https://vimeo.com/techdefeat');
	define ( SOCIAL_YOUTUBE_URL , 'https://www.youtube.com/channel/UCbHsMI8xvNudPGi2OvIxPxw');
	
	
	/*Connect to Database start*/
	$conn = new mysqli($host, $user, $password, $database);
	if ($conn->connect_error) {
		header("Location: ".SITEURL."/error.php?message=" . url_encode($conn->connect_error));
	} 
	/*Connect to Database End*/

?>