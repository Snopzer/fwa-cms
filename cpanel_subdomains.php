<?php
	$request = "/frontend/gl_paper_lantern/subdomain/doadddomain.html?rootdomain=techdefeat.com&domain=test3";
	$result = subd('localhost',2082,'streetmart','543@Fareed',$request);
	
	function subd($host,$port,$ownername,$passw,$request) {
	
		$sock = fsockopen('localhost',2082);
		if(!$sock) {
			print('Socket error');
			exit();
		}
		$authstr = "$ownername:$passw";
		$pass = base64_encode($authstr);
		$in = "GET $request\r\n";
		$in .= "HTTP/1.0\r\n";
		$in .= "Host:$host\r\n";
		$in .= "Authorization: Basic $pass\r\n";
		$in .= "\r\n";
		
		fputs($sock, $in);
		fclose( $sock );
	}
	exit;
	?>