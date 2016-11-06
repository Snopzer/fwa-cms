<?php
	include_once('config.php');
	$siteQuery = $conn->query("SELECT * FROM r_site_details WHERE id=1");
	$siteData = $siteQuery->fetch_assoc();
	
	define ( SITE_NAME , $siteData['site_name']);
	define ( SITE_TITLE , $siteData['site_title']);
	define ( SITE_KEYWORDS , $siteData['site_keywords']);
	define ( SITE_DESCRIPTION , $siteData['site_description']);
	define ( OWNER_NAME , $siteData['owner_name']);
	define ( GOOGLE_ANALYTICS , $siteData['google_analytics']);
	
	/* Admin parameters */
	define ( ADD_BUTTON , 'Add');
	define ( EDIT_BUTTON , 'Edit');
	define ( DELETE_BUTTON , 'Delete');
	define ( SAVE_BUTTON , 'SAVE');
	define ( UNDO_BUTTON , 'UNDO');
	define ( UPDATE_BUTTON , 'UPDATE');
	define ( ADMIN_PAGE_LIMIT , $siteData['admin_page_limit']);
	
	/* Admin Notification Messages */
	define ( ADMIN_NO_RECORDS_FOUND , 'No Records Found');
	
	/* Contact Page Parameters*/
	define ( CONTACT_MAIL , $siteData['contact_mail']);
	define ( CONTACT_PHONE , $siteData['contact_phone']);
	define ( CONTACT_ADDRESS , $siteData['contact_address']);
	define ( POST_DESCRIPTION_LENGTH,$siteData['post_description_length']);
	
	/*Email Settings*/
	define ( ADMIN_MAIL , $siteData['admin_mail']);
	define ( FROM_MAIL , $siteData['from_mail']);
	define ( REPLY_TO_MAIL , $siteData['reply_to_mail']);
	define ( SITE_COPY_RIGHTS , $siteData['site_copy_rights']);
	
	/*Social Link*/
	define ( SOCIAL_FACEBOOK_URL , $siteData['social_facebook_url']);
	define ( SOCIAL_TWITTER_URL , $siteData['social_twitter_url']);
	define ( SOCIAL_GOOGLEPLUS_URL , $siteData['social_googleplus_url']);
	define ( SOCIAL_LINKEDIN_URL ,$siteData['social_linkedin_url']);
	define ( SOCIAL_BEHANCE_URL , $siteData['social_behance_url']);
	define ( SOCIAL_VIMIO_URL , $siteData['social_vimio_url']);
	define ( SOCIAL_YOUTUBE_URL , $siteData['social_youtube_url']);
	/*Social Network Pages*/	
	
	?>