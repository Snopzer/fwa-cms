<?php
	session_start();
	include_once('includes/config.php');
	include_once('includes/header.php');
include 'includes/menu.php'; ?>
<?php
	$select = mysql_query("SELECT (SELECT COUNT(*) FROM r_user) as usercount ,(SELECT COUNT(*) FROM r_category) as categorycount, (SELECT COUNT(*) FROM r_post) as postcount, (SELECT COUNT(*) FROM r_post where status=1) as activeposts,(SELECT SUM(views) FROM r_post) as totalviews")or die(mysql_error());
	$count = mysql_fetch_array($select);
?>
<div id="page-wrapper" class="gray-bg dashbard-1">
	<div class="content-main">
		<div class="banner">
			<h2>
				<a href="home.php">Home</a>
			</h2>
		</div>
		<div class="content-top">
			<div class="col-md-4 ">
				<div class="content-top-1">
					<div class="col-md-6 top-content">
						<h5>Users</h5>
						<label><?php echo $count['usercount']; ?> </label>
					</div>
					<div class="col-md-6 top-content">
						<h5>Article Views</h5>
						<label><?php echo $count['totalviews']; ?> </label>
					</div>
					<div class="col-md-6 top-content1">	   
						<div id="demo-pie-1" class="pie-title-center" data-percent="25"> <span class="pie-value"></span> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="content-top-1">
					<div class="col-md-6 top-content">
						<h5>Categories</h5>
						<label><?php echo $count['categorycount']; ?> </label>
					</div>
					<div class="col-md-6 top-content1">	   
						<div id="demo-pie-2" class="pie-title-center" data-percent="50"> <span class="pie-value"></span> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="content-top-1">
					<div class="col-md-4 top-content">
						<h5>All Posts</h5>
						<label><?php echo $count['postcount']; ?> </label>
					</div>
					<div class="col-md-3 top-content">
						<h5>Active</h5>
						<label><?php echo $count['activeposts']; ?> </label>
					</div>
					<div class="col-md-5 top-content">
						<h5>Un-Active Posts</h5>
						<label><?php echo $count['postcount']-$count['activeposts']; ?> </label>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-8 content-top-2">
				<div id="postviews_chart" style="width: 100%; height: 100%"></div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="content-top">
				<div class="middle-content">
			<h3>Posts Time Line</h3>    
			</div>
			<div class="mid-content-top">
				<div class="middle-content">
					<div id="posthistory_chart" style="width: 100%; height: 100%"></div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		
		<div class="content-mid">
			<div class="mid-content-top">
				<div class="middle-content">
					<h3>Latest Images</h3>                                
					<div id="owl-demo" class="owl-carousel text-center">
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/na.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/na1.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/na2.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/na.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/na1.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/na2.jpg" alt="name">
						</div>
						<div class="item">
							<img class="lazyOwl img-responsive" data-src="images/na.jpg" alt="name">
						</div>
						
					</div>
				</div>
				<link href="css/owl.carousel.css" rel="stylesheet">
				<script src="js/owl.carousel.js"></script>
				<script>
					$(document).ready(function () {
						$("#owl-demo").owlCarousel({
							items: 3,
							lazyLoad: true,
							autoPlay: true,
							pagination: true,
							nav: true,
						});
					});
				</script>
				<!-- //requried-jsfiles-for owl -->
			</div>
			<div class="clearfix"> </div>
		</div>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<?php	$getPostsbyDate = mysql_query("SELECT COUNT( id_post ) as posts , DATE( date_added ) as date_added FROM r_post GROUP BY DATE( date_added ) ASC")or die(mysql_error()); ?>
		
		<?php	$getPostListQuery = mysql_query("SELECT title, views FROM  `r_post` order by views DESC")or die(mysql_error()); ?>
		
		<script type="text/javascript">
			// pie chart
			google.charts.load('current', {'packages':['corechart','corechart']});
			google.charts.setOnLoadCallback(drawPostViewsChart);
			function drawPostViewsChart() {
				
				var data = google.visualization.arrayToDataTable([
				['Post', 'Views'],
				<?php	while ($getPost = mysql_fetch_assoc($getPostListQuery)) {	?>
					['<?php echo $getPost['title'] ?>',<?php echo $getPost['views'] ?>],
				<?php } ?>
				
				]);
				
				var options = {'title':'Post Views','width':1100,'height':480};
				
				
				var chart = new google.visualization.PieChart(document.getElementById('postviews_chart'));
				
				chart.draw(data, options);
			}
			
			
			google.charts.setOnLoadCallback(drawChart1);
			
			function drawChart1() {
				var data1 = google.visualization.arrayToDataTable([
				['Date', 'Posts'],
				<?php	while ($getPostHistoryData = mysql_fetch_assoc($getPostsbyDate)) {	?>
					['<?php echo $getPostHistoryData['date_added'] ?>',<?php echo $getPostHistoryData['posts'] ?>],
				<?php } ?>
				]);
				
				var options1 = {
					title: 'Posts Time Line',
					curveType: 'function',
					legend: { position: 'bottom' },
					'width':1400,'height':280
				};
				
				var chart1 = new google.visualization.LineChart(document.getElementById('posthistory_chart'));
				
				chart1.draw(data1, options1);
			}
			
			
			
			
			
		</script>
		
		
		
	<?php include_once('includes/footer.php');?>			