<?php
	error_reporting(1);
	if($_POST['action']=='test'){
		
		parse_str($_POST['installData'], $insdata);
		$db_host		=	$insdata['db_host'];
		$db_user		=	$insdata['db_user'];
		$db_password	=	$insdata['db_password'];	
		$db_name		=	$insdata['db_name'];	
		
		//Check databse exist or not.
		$conn = mysqli_connect($db_host, $db_user, $db_password,$db_name);
		if($conn)
		{
			$response['message'] = "Connected to Database successfully";
			$response['success'] = true;
			
			}else{
			$response['message'] = "Failed to connect Database";
			$response['success'] = false;
		}
		echo json_encode($response);
		exit;
	}  
	
	
	if($_POST['action']=='install'){
		
		parse_str($_POST['installData'], $insdata);
		$db_host		=	$insdata['db_host'];
		$db_user		=	$insdata['db_user'];
		$db_password	=	$insdata['db_password'];	
		$db_name		=	$insdata['db_name'];	
		$fwa_username	=	$insdata['fwa_username'];	
		$fwa_password	=	$insdata['fwa_password'];	
		$fwa_email		=	$insdata['fwa_email'];	
		
		
		$conn = mysqli_connect($db_host, $db_user, $db_password,$db_name);
		if($conn)
		{
			
			//$response['message'] = "Connected to Database successfully";
			//$response['success'] = true;
			
$DdatabaseContent = '<?php
	/* MySQL Server Host address */
	$host 		=	"localhost";

	/* MySQL User Name */
	$user		=	"root";

	/* MySQL User Password*/
	$password	=	"";

	/* MySQL Database*/
	$database	=	"123";	
	
	/*Connect to Database start*/
	$conn = new mysqli($host, $user, $password, $database);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	/*Connect to Database End*/
    define ( SITE_ADMIN_URL , "http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/admin/");
	define ( SITEURL , "http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'");
	
?>';
			
			$fp = fopen(dirname(__FILE__) . "/config.php","wb");
			fwrite($fp,$DdatabaseContent);
			fclose($fp);
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_user` (
			`id_user` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`id_user_role` int(11) NOT NULL,
			`name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`phone` varchar(99) COLLATE latin1_general_ci DEFAULT NULL,
			`department` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
			`password` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
			`status` int(1) DEFAULT NULL,
			`activate_link` varchar(100) COLLATE latin1_general_ci NOT NULL,
			`skills` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`id_country` int(11) DEFAULT NULL,
			`image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`meta_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
			`meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
			`meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
			KEY `meta_title` (`meta_title`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;")or die(mysql_error());
				
			$conn->query("INSERT INTO `r_user` (`id_user`, `id_user_role`, `name`, `phone`, `department`, `email`, `password`, `status`, `activate_link`, `skills`, `id_country`, `image`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
			(1, 1, '".$insdata['fwa_username']."', '123456789', '".$insdata['fwa_username']."', '".$insdata['fwa_email']."', '".md5($insdata['fwa_password'])."', 1, '', '".$insdata['fwa_username']."', 1, '', '', '', '')")or die(mysql_error());
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_category` (
			`id_category` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`description` text COLLATE latin1_general_ci,
			`image` varchar(255) COLLATE latin1_general_ci NOT NULL,
			`meta_title` varchar(100) COLLATE latin1_general_ci NOT NULL,
			`meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
			`meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
			`sort_order` int(11) NOT NULL,
			`top` int(1) NOT NULL,
			`status` int(1) DEFAULT NULL COMMENT '1:Enable;0:Disble',
			`date_created` datetime NOT NULL,
			`date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			`deleted` int(1) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die(mysql_error());
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_comment` (
			`id_comment` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`email` varchar(99) COLLATE latin1_general_ci DEFAULT NULL,
			`subject` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`message` text COLLATE latin1_general_ci,
			`id_post` int(10) NOT NULL,
			`status` tinyint(1) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;")or die(mysql_error());
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_country` (
			`id_country` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`status` tinyint(1) NOT NULL COMMENT '1:Enable; 0:Disable'
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;");
			
			$conn->query("INSERT INTO `r_country` (`id_country`, `name`, `status`) VALUES
			(1, 'India', 1),(2, 'Australia', 1);")or die(mysql_error());
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_image` (
			`id_image` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`image_name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`status` int(11) DEFAULT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die(mysql_error());
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_message` (
			`id_message` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`subject` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`message` text COLLATE latin1_general_ci,
			`date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			`date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			`status` tinyint(1) NOT NULL
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;")or die(mysql_error());
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_page` (
			`id_page` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`meta_description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`meta_keywords` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`page_heading` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`page_description` text COLLATE latin1_general_ci,
			`top` int(1) NOT NULL,
			`status` int(11) DEFAULT NULL
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;")or die(mysql_error());
			
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_post` (
			`id_post` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`status` int(1) NOT NULL,
			`id_category` int(11) DEFAULT NULL,
			`id_user` int(10) DEFAULT NULL,
			`meta_title` varchar(155) COLLATE latin1_general_ci NOT NULL,
			`meta_keywords` varchar(155) COLLATE latin1_general_ci NOT NULL,
			`meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
			`title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`short_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
			`description` text COLLATE latin1_general_ci,
			`image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`date_added` datetime DEFAULT NULL,
			`date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			`favourites` int(11) NOT NULL DEFAULT '0',
			`views` int(11) NOT NULL DEFAULT '0',
			`source` varchar(255) COLLATE latin1_general_ci NOT NULL,
			`image_source` varchar(255) COLLATE latin1_general_ci NOT NULL
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die(mysql_error());
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_seo_url` (
			`id_seo_url` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`seo_url` varchar(150) COLLATE latin1_general_ci NOT NULL UNIQUE KEY,
			`id_category` int(11) DEFAULT '0',
			`id_post` int(11) DEFAULT '0',
			`id_page` int(11) DEFAULT '0',
			`id_user` int(11) DEFAULT '0'
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die(mysql_error());
			
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_site_details` (
			`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`site_name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`owner_email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`email_from` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`phone` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`replay_email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`title` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`meta_description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`meta_keywords` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`google_analytics_code` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
			`copyrights` varchar(255) COLLATE latin1_general_ci DEFAULT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;")or die(mysql_error());
			
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_subscriber` (
			`id_subscriber` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL UNIQUE KEY
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;")or die(mysql_error());
			
			
			
			$conn->query("CREATE TABLE IF NOT EXISTS `r_user_role` (
			`id_user_role` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`role` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
			`status` int(11) DEFAULT NULL,
			`date_created` datetime NOT NULL,
			`date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;")or die(mysql_error());
			
			
			$conn->query("INSERT INTO `r_user_role` (`id_user_role`, `role`, `status`, `date_created`, `date_updated`) VALUES
			(1, 'Super Admin', 1, '0000-00-00 00:00:00', '2016-09-25 01:25:35');")or die(mysql_error());
			
			
			$response['message'] = "Installation Completed";
			$response['adminURL'] = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/admin';
			$response['siteURL'] = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']);
			$response['success'] = true;
			
			}else{
			$response['message'] = "Failed to connect Database";
			$response['success'] = false;
		}
		echo json_encode($response);
		exit;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>