<?php 
	include_once('admin/includes/config.php');
	
	$metaArray = array(
    "title"  => "Ultimate Stop for Software Solutions - Techdefeat.com",
    "meta-keywords" => "Windows Software Applications Solutions, SEO",
    "meta-description" => "Techdefeat will provide you solutions for your Windows Software Problems, Website Creation, Managing websites, Static, Dynamic Websites and  Search Engine Optimization for your website and many more intrestin facts",
	);
	include_once('includes/header.php'); 
?>
<?php 
	
	$postQuery = $conn->query("SELECT ru.name as user,rc.name,rp.id_post, seo.seo_url as seo_url, rp.id_category,rp.title,rp.description,rp.short_description,rp.image,rp.date_updated,rp.favourites,rp.views  from r_post rp
	LEFT JOIN r_category rc ON rp.id_category=rc.id_category
	LEFT JOIN r_user ru ON rp.id_user=ru.id_user
	LEFT JOIN r_seo_url seo ON rp.id_post=seo.id_post
	where rp.status=1 order by id_post desc")or die(mysql_error());
?> 
<div class="technology">
	<div class="banner">
		<div class="container">
			<h2><?php echo SITE_NAME; ?></h2> 
			<p><?php echo SITE_DESCRIPTION; ?></p>
			<a href="contact.php">Contact us for Support</a>
		</div>
	</div>
	
    <div class="container">
        <div class="col-md-9 technology-left">
            <div class="tech-no">
                <?php while ($postData = $postQuery->fetch_assoc()) { ?>
					<div class="tc-ch">		
						<?php if(!empty($postData['image'])){?>
							<div class="tch-img">
								<a href="<?php echo SITEURL?><?php echo $postData['seo_url']?>"><img src="images/post/<?php echo $postData['image'] ?>" class="img-responsive" alt="<?php echo $postData['name']; ?>"/></a>
							</div>
							<a class="blog blue"><?php echo $postData['name']; ?></a>
						<?php } ?>
						<h3> <a href="<?php echo SITEURL?><?php echo $postData['seo_url']?>"><?php echo $postData['title'] ?></a></h3>
						<p><?php echo substr($postData['short_description'],0,POST_DESCRIPTION_LENGTH); ?>....<a href="<?php echo SITEURL?><?php echo $postData['seo_url']?>">Read More.</a></p>
						<div class="blog-poast-info">
							<ul>
								<li><i class="glyphicon glyphicon-user"> </i><a class="admin" href="#"><?php echo $postData['user']; ?> </a></li>
								<li><i class="glyphicon glyphicon-calendar"> </i><?php echo $postData['date_updated']; ?></li>
								<li><i class="glyphicon glyphicon-comment"> </i><a class="p-blog"><?php echo $postData['name']; ?></a></li>
								<!--<li><i class="glyphicon glyphicon-heart"> </i><a class="admin"><?php echo $postData['favourites']; ?> favourites </a></li>-->
								<li><i class="glyphicon glyphicon-eye-open"> </i><?php echo $postData['views']; ?> views</li>
							</ul>
						</div>
					</div>
				<?php	}	?>
			</div>
		</div>
        <div class="col-md-3 technology-right">
            <div class="blo-top">
                <div class="tech-btm">
                    <img src="images/banner1.jpg" class="img-responsive"/>
				</div>
			</div>
            <?php include_once('includes/subscribe.php'); ?>
            <?php include_once('includes/users.php'); ?>
		</div>
        <div class="clearfix"></div>
	</div>
</div>
<?php include_once('includes/footer.php'); ?>