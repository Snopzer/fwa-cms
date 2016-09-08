<!DOCTYPE HTML>
<html>	
    <head>		
        <title><?php echo $metaArray['title'];?></title>		
        <meta name="viewport" content="width=device-width, initial-scale=1">		
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		
        <meta name="keywords" content="<?php echo $metaArray['meta-keywords'];?>" />		
        <meta name="description" content="<?php echo $metaArray['meta-description'];?>" />		
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />		
        <link href="css/style.css" rel='stylesheet' type='text/css' />			
        <script src="js/jquery-1.11.1.min.js"></script>		
        <script src="js/bootstrap.min.js"></script>		
		<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>		
		<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>		
        <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>		
	</head>	
    <div class="header">		
        <div class="header-top">			
            <div class="container">				
                <div class="logo">					
                    <a href="index.php"><h1>Techdefeat.com</h1></a>					
				</div>				
				<div class="social">						
					<ul>							
						<li><a href="https://www.facebook.com/techdefeat1/" target="_blank" class="facebook"> </a></li>							
						<!--<li><a href="#" class="facebook twitter"  target="_blank"> </a></li>							
						<li><a href="#" class="facebook chrome"  target="_blank"> </a></li>							
						<li><a href="#" class="facebook in"  target="_blank"> </a></li>							
						<li><a href="#" class="facebook beh"  target="_blank"> </a></li>-->
						<li><a href="https://vimeo.com/techdefeat" class="facebook vem"  target="_blank"> </a></li>							
						<li><a href="https://www.youtube.com/channel/UCbHsMI8xvNudPGi2OvIxPxw" class="facebook yout" target="_blank"> </a></li>							
					</ul>						
				</div>					
				<div class="clearfix"></div>					
			</div>			
		</div>		
        <div class="head-bottom">			
            <div class="container">				
                <div class="navbar-header">					
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">						
                        <span class="sr-only">Toggle navigation</span>						
                        <span class="icon-bar"></span>						
                        <span class="icon-bar"></span>						
                        <span class="icon-bar"></span>						
					</button>					
				</div>				
                <div id="navbar" class="navbar-collapse collapse">					
                    <ul class="nav navbar-nav">						
                        <li class="active"><a href="index.php">Home</a></li>		
						<?php							
                            $categoriesQuery = mysql_query("SELECT seo.seo_url as seo_url, cat.* FROM r_category cat,r_seo_url seo where cat.id_category=seo.id_category and cat.status=1 order by cat.sort_order asc")or die(mysql_error());							
                            while ($category = mysql_fetch_assoc($categoriesQuery)) {								
							?>							
                            <li><a href="<?php echo SITEURL;?><?php echo $category['seo_url']; ?>"><?php echo $category['name']; ?></a></li>							
						<?php } ?>
						<?php							
							$PagesQuery = mysql_query("SELECT seo.seo_url as seo_url, pg.* FROM r_page pg,r_seo_url seo where pg.id_page=seo.id_page order by pg.id_page desc")or die(mysql_error());							
							if(mysql_num_rows($PagesQuery)>0){
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Techdefeat <span class="caret"></span></a>
							<ul class="dropdown-menu">
									<?php
									while ($page = mysql_fetch_assoc($PagesQuery)) {								
									?>							
									<li><a href="<?php echo  SITEURL;?><?php echo $page['seo_url']; ?>"><?php echo $page['title']; ?></a></li>							
									<?php } ?>	
							</ul>
						</li>
						<?php } ?>
						<!--<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Science <span class="caret"></span></a>
							<ul class="dropdown-menu">
							<li><a href="singlepage.php">Action</a></li>
							<li><a href="singlepage.php">Action</a></li>
							<li><a href="singlepage.php">Action</a></li>
							</ul>
						</li>-->
                        <li><a href="contact.php">Contact</a></li>						
					</ul>					
				</div>				
			</div>			
		</nav>		
	</div>	
</div>		