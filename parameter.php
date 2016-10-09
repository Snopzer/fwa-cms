<?php
	include_once('config.php');
	define ( SITE_NAME , 'FWACMS');
	define ( SITE_KEYWORDS , 'FWACMS');
	define ( SITE_DESCRIPTION , 'FWACMS');
	define ( SITE_ADMIN_URL , 'http://localhost/fwacms/admin/');
	define ( SITEURL , 'http://localhost/fwacms/');
	define ( OWNER_NAME , 'Owner Name');
	
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
	define ( CONTACT_PHONE , '1234567890');
	define ( CONTACT_ADDRESS , 'snopzer.com');
	define ( POST_DESCRIPTION_LENGTH,300);
	
	/*Email Settings*/
	define ( ADMIN_MAIL , 'info@snopzer.com');
	define ( FROM_MAIL , 'info@snopzer.com');
	define ( REPLY_TO_MAIL , 'no-reply@snopzer.com');
	define ( SITE_COPY_RIGHTS , '&copy; 2016 www.snopzer.com All Rights Reserved');
	
	/*Social Link*/
	define ( SOCIAL_FACEBOOK_URL , 'https://www.facebook.com/techdefeat1/');
	define ( SOCIAL_TWITTER_URL , 'https://twitter.com/techdefeat_com');
	define ( SOCIAL_GOOGLEPLUS_URL , 'https://plus.google.com/b/106136272474879652354/?pageId=106136272474879652354');
	define ( SOCIAL_LINKEDIN_URL , '');
	define ( SOCIAL_BEHANCE_URL , '');
	define ( SOCIAL_VIMIO_URL , 'https://vimeo.com/techdefeat');
	define ( SOCIAL_YOUTUBE_URL , 'https://www.youtube.com/channel/UCbHsMI8xvNudPGi2OvIxPxw');
	/*Social Network Pages*/	
	
	/*Connect to Database start*/
	$conn = new mysqli($host, $user, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	/*Connect to Database End*/
?>