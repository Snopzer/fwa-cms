<?php
	include_once('admin/includes/config.php');
	
	$seo_url = $_GET['seo_url'];
	
	$checkSEORequest = mysql_query("select * from r_seo_url where seo_url='".$seo_url."'");	
	$checkSEO = mysql_fetch_assoc($checkSEORequest) or die(mysql_error());	
	
	if($checkSEO['id_post'] >=1 )	{
		$showProductDiv = true;		
		$select = mysql_query("SELECT ru.name as username,rc.name,rp.id_post,rp.meta_title,rp.meta_keywords,rp.meta_description,rp.id_category,rp.title,rp.description,rp.image,rp.date_updated,rp.favourites,rp.views FROM r_post rp,r_category rc,r_user ru WHERE rp.id_category=rc.id_category and rp.id_user=ru.id_user and rp.id_post='".$checkSEO['id_post']."' order by id_post desc")or die(mysql_error()); 		
		
		$result = mysql_fetch_assoc($select)or die(mysql_error());	
		
		$id=$result['id_post'];		
		$viewcheck=mysql_query("UPDATE `r_post` SET `views` = `views` + 1 WHERE `id_post` = '$id'");		
		$metaArray = array(		
		"title"  => $result['meta_title'],		
		"meta-keywords" => $result['meta_keywords'],		
		"meta-description" => $result['meta_description']);	
	}
	
	if($checkSEO['id_page'] >=1 )	{
		$showpageDiv = true;	
		
		
		$pageQuery = mysql_query("select * from r_page page,r_seo_url seo where page.id_page=seo.id_page and page.id_page=".$checkSEO['id_page'])or die(mysql_error());
		$result = mysql_fetch_assoc($pageQuery)or die(mysql_error());	
		
		$metaArray = array(		
		"title"  => $result['title'],		
		"meta-keywords" => $result['meta_keywords'],		
		"meta-description" => $result['meta_description']);	
	}
	
	if($checkSEO['id_user'] >=1 )	{
		$showUserDiv = true;	
		
		
		$pageQuery = mysql_query("select * from r_page page,r_seo_url seo where page.id_page=seo.id_page and page.id_page=".$checkSEO['id_user'])or die(mysql_error());
		$result = mysql_fetch_assoc($pageQuery)or die(mysql_error());	
		
		$metaArray = array(		
		"title"  => $result['title'],		
		"meta-keywords" => $result['meta_keywords'],		
		"meta-description" => $result['meta_description']);	
	}
	
	

	include_once('includes/header.php');
	
?>

<div class="technology-1">
    <div class="container">
        <div class="col-md-9 technology-left">
            <div class="business">
				<?php if($showpageDiv==true){ ?>
				<div class=" blog-grid2">
					<?if(!empty($result['image'])) { ?>
                    <img src="admin/images/<?= $result['image'] ?>" class="img-responsive" alt="<?= $result['image'] ?>">
					<? }?>
                    <div class="blog-text">
                        <h5><?php echo $result['page_heading'] ?></h5>
                        <p><?php echo $result['page_description'] ?> </p>	
                        <p></p>				
					</div>
				</div>
				<? } ?>
				
				<?php if($showUserDiv == true) {?>
				
				<?php  } ?>
				<?php if($showProductDiv == true) {?>
				<div class=" blog-grid2">
					<?if(!empty($result['image'])) { ?>
                    <img src="images/post/<?= $result['image'] ?>" class="img-responsive" alt="<?= $result['image'] ?>">
					<? }?>
					<div class="blog-poast-info">
								<ul>
									<li><i class="glyphicon glyphicon-user"> </i><a class="admin" href="#"><?php echo $result['username'] ?> </a></li>
									<li><i class="glyphicon glyphicon-calendar"> </i><?php echo $result['date_updated'] ?></li>
									<li><i class="glyphicon glyphicon-comment"> </i><a class="p-blog"><?php echo $result['name'] ?></a></li>
									<li><i class="glyphicon glyphicon-heart"> </i><a class="admin"><?php echo$result['favourites'] ?> favourites </a></li>
									<li><i class="glyphicon glyphicon-eye-open"> </i><?php echo $result['views'] ?> views</li>
								</ul>
							</div>
                    <div class="blog-text">
                        <h5><?php echo $result['title'] ?></h5>
                        <p><?php echo $result['description'] ?> </p>	
                        <p></p>				
					</div>
				</div>
				<?php } ?>
				 <?php if($showProductDiv == true) {?>
                <div class="comment-top">
                    <h2>Comment</h2><?php
						$commentQuery = "select * from r_comment where post_id=$id order by id_comment desc";
						$commentQuery = mysql_query($commentQuery);
						while ($comment = mysql_fetch_array($commentQuery)) {
							if ($comment['name'] != '' & $comment['message'] != '') {
							?>
                            <div class="media-left">
                                <a href="#">
                                    <img src="images/si.png" alt="">
								</a>
							</div>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment['name'] ?></h4>
                                <p><?php echo $comment['message'] ?></p>
							</div><br />
                            <?php
							}
						}
					?>
				</div>
				
                <div class="comment">
                    <h3>Leave a Comment</h3>
					
                    <div class=" comment-bottom">
                        <form action='savecomment.php?type=save&id=<?php echo $result['id_post']?>&seo_url=<?php echo $result['seo_url']?>' method="post">
						
                            <input type="text" name="name" placeholder="Name">
                            <input type="hidden" name="id" value="$id" >
                            <input type="text" name="email" placeholder="Email">
                            <input type="text" name="subject" placeholder="Subject">
                            <textarea placeholder="Message" name="message" required=""></textarea>
                            <input type="submit" value="Send">
						</form>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		
        <div class="col-md-3 technology-right-1">
            <div class="blo-top">
                <div class="tech-btm">
                    <img src="images/banner1.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
            <?php include_once('includes/subscribe.php'); ?>
            <?php include_once('includes/users.php'); ?>
		</div>
        <div class="clearfix"></div>
	</div>
</div>
<?php include_once ('includes/footer.php'); ?>