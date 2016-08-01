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
	$select = mysql_query("SELECT ru.name as user,rc.name,rp.id_post, seo.seo_url,rp.id_category,rp.title,rp.description,rp.image,rp.date_updated,rp.favourites,rp.views FROM r_post rp,r_category rc,r_user ru,r_seo_url seo WHERE rp.id_category=rc.id_category and rp.id_user=ru.id_user and seo.id_post=rp.id_post and rp.status=1 order by id_post desc")or die(mysql_error()); 
?> 
<div class="technology">
	<div class="banner">
		<div class="container">
			<?php	if (isset($_GET['subscription']) && $_GET['subscription'] == "success") {?><p style="color: white">Thank You For Subscibing Our News Letter</p><?php }		?>
			<?php	if (isset($_GET['contact']) && $_GET['contact'] == "success") {		?><p style="color: white">Your Contact Request Is Sent. You Will Get Replay Soon Thankyou For Contacting Us.</p><?php }		?> 
			
			<h2>Techdefeat.com</h2>
			<p>Techdefeat will provide you solutions for your Windows Software Problems, Website Creation, Managing websites, Static, Dynamic Websites and  Search Engine Optimization for your website and many more intrestin facts</p>
			<a href="contact.php">Contact us for Support</a>
		</div>
	</div>
	
    <div class="container">
        <div class="col-md-9 technology-left">
            <div class="tech-no">
                <?php	while ($result = mysql_fetch_assoc($select)) {	?>
					<div class="tc-ch">		
						<?php if(!empty($result['image'])){?>
							<div class="tch-img">
								<a href="/<?php echo $result['seo_url']?>"><img src="images/post/<?php echo $result['image'] ?>" class="img-responsive" alt=""/></a>
							</div>
							<a class="blog blue"><?php echo $result['name']; ?></a>
						<?php } ?>
						<h3> <a href="/<?php echo $result['seo_url']?>"><?php echo $result['title'] ?></a></h3>
						<p><?php echo $result['description']; ?></p>
						<div class="blog-poast-info">
							<ul>
								<li><i class="glyphicon glyphicon-user"> </i><a class="admin" href="#"><?php echo $result['user']; ?> </a></li>
								<li><i class="glyphicon glyphicon-calendar"> </i><?php echo $result['date_updated']; ?></li>
								<li><i class="glyphicon glyphicon-comment"> </i><a class="p-blog"><?php echo $result['name']; ?></a></li>
								<li><i class="glyphicon glyphicon-heart"> </i><a class="admin"><?php echo $result['favourites']; ?> favourites </a></li>
								<li><i class="glyphicon glyphicon-eye-open"> </i><?php echo $result['views']; ?> views</li>
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