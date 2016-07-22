<?php
/*Library Function*/
	/*add seo url*/
	function addSeoURL($seo_url,$cat,$post,$page,$user)
	{
		if(empty($seo_url)){
			$seo_url =rand(111111,999999);
			}
		$addSEOURL = mysql_query("INSERT INTO  `r_seo_url` (`seo_url` ,`id_category` ,	`id_post` ,	`id_page` ,	`id_user`) VALUES (  '".$seo_url."',  '".$cat."',  '".$post."',  '".$page."',  '".$user."'	)") or die(mysql_error());
	}
	
	/*update seo url*/
	function updateSeoURLbyPost($seo_url,$cat,$post,$page,$user) 
	{ 
		$addSEOURL = mysql_query("UPDATE  `r_seo_url` SET `seo_url`='".$seo_url."' where id_post=".$post) or die(mysql_error()); 
		if(!$addSEOURL)
		{
			addSeoURL($seo_url,$cat,$post,$page,$user);
		}
	}
	
	function updateSeoURLbyCategory($seo_url,$cat,$post,$page,$user) 
	{	
		$addSEOURL = mysql_query("UPDATE  `r_seo_url` SET `seo_url`='".$seo_url."' where `id_category` =".$cat) or die(mysql_error());
		if(!$addSEOURL)
		{
			addSeoURL($seo_url,$cat,$post,$page,$user);
		}
	}

	function updateSeoURLbyPage($seo_url,$cat,$post,$page,$user) 
	{
		$addSEOURL = mysql_query("UPDATE  `r_seo_url` SET `seo_url`='".$seo_url."' where `id_page` =".$page) or die(mysql_error()); 
		if(!$addSEOURL)
		{
			addSeoURL($seo_url,$cat,$post,$page,$user);
		}
	}
	
	function updateSeoURLbyUser($seo_url,$cat,$post,$page,$user) 
	{
		$addSEOURL = mysql_query("UPDATE  `r_seo_url` SET `seo_url`='".$seo_url."' where `id_user` =".$user) or die(mysql_error()); 
		if(!$addSEOURL)
		{
			addSeoURL($seo_url,$cat,$post,$page,$user);
		}
	}
	
	/*//call function $result = subd('localhost',2082,'streetmart','543@Fareed');	
	function subd($host,$port,$ownername,$passw) {}
		$request = "/frontend/gl_paper_lantern/subdomain/doadddomain.html?rootdomain=techdefeat.com&domain=test3";
		$sock = fsockopen('localhost',2082);
		$authstr = "$ownername:$passw";
		$pass = base64_encode($authstr);
		$in = "GET $request\r\n";
		$in .= "HTTP/1.0\r\n";
		$in .= "Host:$host\r\n";
		$in .= "Authorization: Basic $pass\r\n";
		$in .= "\r\n";
		
		fputs($sock, $in);
		fclose( $sock );
	}*/
	


?>