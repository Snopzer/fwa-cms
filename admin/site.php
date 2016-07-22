<?php
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		
		
		header('location:index.php');
	}
	$id = (int)$_POST['id'];
	// display all posts
	$selectSites = mysql_query("SELECT * FROM r_site_details order by id desc");
	$siteCount = mysql_num_rows($selectSites);
	
	$pages = $siteCount / 5;
	$pages = ceil($pages);
	
	//pagination
	$page = false;
	if (array_key_exists('page', $_GET)) {
		$page = $_GET['page'];
	}
	if ($page == "" || $page == 1) {
		$page1 = 0;
		} else {
		$page1 = ($page * 5) - 5;
	}
	$selectSiteList = mysql_query("SELECT * FROM r_site_details order by id desc limit ".$page1.",5")or die(mysql_error());					
	
?>  
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/menu.php'); ?>
<?php if(!isset($_GET['action'])){?>
	<div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="content-main">	
			<div class="banner">
				<h2>
					<a href="home.php">Home</a>
					<i class="fa fa-angle-right"></i>
					<span>Sites</span>
				</h2>
			</div>
			<div class="grid-system">
				<div class="horz-grid">
					<div class="grid-system">
						
						<div class="horz-grid">
							<div class="bs-example">
								<table class="table">
									<tbody>
										<tr>
											<td><h1 id="h1.-bootstrap-heading"> Sites - [<?php echo $siteCount;?>]</h1></td>
											<td class="type-info text-right">
												<a href="site.php?action=add"><span class="btn btn-success">Add New</span></a> 
												<a><span class="btn btn-primary">Edit</span></a>
												<a><span class="btn btn-danger">Delete</span></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<table class="table"> 
								<form action="search.php?type=search" method="post">
									<tr class="table-row">
										<td class="table-img">&nbsp;</td>
										<td class="march"><h6><input class="form-control" type="text" name="department" id="department"></h6></td>
										<td class="march"><h6><input class="btn btn-default" type="submit"  name="search" value="Search"></h6></td>                                
									</tr>
								</form>
								<tr class="table-row">
									<td class="table-img">
										<input type="checkbox" id="selectall" onClick="selectAll(this)" >
									</td>
									<td class="table-text"><h6>Site Name</h6></td>
                                <td class="table-text"><h6>Owner Email</h6></td>
                                <td class="table-text"><h6>Email From</h6></td>
                                <td class="table-text"><h6>Phone</h6></td>
								</tr>
								<?php	while ($site = mysql_fetch_assoc($selectSiteList)) {	?>
									<tr class="table-row">
										<td class="table-img"><input type="checkbox" name="colors[]"></td>
										 <td class="march"><h6><?php echo $site["site_name"] ?></h6></td>
										<td class="march"><h6><?php echo $site["owner_email"] ?></h6></td>
                                        <td class="march"><h6><?php echo $site["email_from"] ?></h6></td>
                                        <td class="march"><h6><?php echo $site["phone"] ?></h6></td>
										<td><a href="site.php?id=<?php echo  $site["id"] ?>&action=edit&page=<?php echo  "$page"?>"><span class="label label-primary">Edit</span><a/>
										<a href="site-controller.php?id=<?php echo  $site["id"] ?>&action=delete&page=<?php echo  "$page"?>""><span class="label label-info">Delete</span></a>
										</td>
									</tr>
									<?php	}	?>
							</table>
							<?php	if ($siteCount > 5) {	?>
								<div class="horz-grid text-center">
									<ul class="pagination pagination-lg">
										<?php for ($b = 1; $b <= $pages; $b++) { ?>
											<?php if ($b == $page) { ?>
												<li class="active"><a href="site.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>    
												<?php } else { ?>
												<li><a href="site.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
												<?php
												}
											}
										?>
									</ul>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php  }// show all users ends here?>
	<?php 	if (isset($_GET['action'])) {		?>
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="content-main">
				<div class="banner">
					<h2>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
						<span><a href="site.php">Sites</a></span>
						<i class="fa fa-angle-right"></i>
						<span><?php echo ($_GET['action']=='edit')?'Edit Site':'Add Site';?></span>
					</h2>
				</div>
				<div class="grid-system">
					<div class="horz-grid">
						<div class="grid-hor">
							<h4 id="grid-example-basic">User Details:</h4>
							
						</div>
						<?php if($_GET['action'] == "edit"){
							$id = $_GET['id'];
							$page=$_GET['page'];
							$query = mysql_query("select * from r_site_details where id=$id")or die(mysql_error());
							$result = mysql_fetch_assoc($query);
						?>
						
					

						<form class="form-horizontal" action="site-controller.php" method="post" enctype="multipart/form-data" >
							<input type="hidden" name="action" value="edit"/>
							<input type="hidden" name="id" value="<?php echo $result["id"] ?>">
							<input type="hidden" name="page" value='<?php echo "$page"?>'>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Site Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["site_name"] ?>" name="site_name" placeholder="Enter Site Name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">owner Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["owner_email"] ?>" name="owner_email" placeholder="Enter owner Name">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">From Mail</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["email_from"] ?>" name="email_from" placeholder="Enter From Mail">
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Phone</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["phone"] ?>" name="phone" placeholder="Enter Phone Number">
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Reply Mail</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["replay_email"] ?>" name="replay_email" placeholder="Enter Reply Mail">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["title"] ?>" name="title" placeholder="Enter Title">
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta keywords</label>
								<div class="col-sm-8">
									<textarea  name="meta_keywords" class="form-control"><?php echo  $result["meta_keywords"] ?></textarea> 
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta Description</label>
								<div class="col-sm-8">
									<textarea  name="meta_description" class="form-control"><?php echo  $result["meta_description"] ?></textarea> 
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Google Analytics Codes</label>
								<div class="col-sm-8">
									<textarea  name="google_analytics_code" class="form-control"><?php echo  $result["google_analytics_code"] ?></textarea> 
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Copyrights</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["copyrights"] ?>" name="copyrights" placeholder="Enter Copyrights">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Select Status</label>
								<div class="col-sm-8">
									<select name="status" id="status" class="form-control selectpicker"  >
										<option name="enable"  value="1" <?php if($result['status']==1){ echo "Selected";}?>>Enable</option>
										<option name="disable"  value="0" <?php if($result['status']==0){ echo "Selected";}?>>Disable</option>
									</select>
								</div>                      
							</div>
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<input type="submit" value="UPDATE" class="btn-primary btn">
								</div>
							</div></div>
						</form>
						<?php
							} elseif($_GET['action'] == "add") {
						?>
						<form class="form-horizontal" action="site-controller.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="add"/>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Site Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control"  name="site_name" placeholder="Enter Site Name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">owner Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="owner_email" placeholder="Enter owner Name">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">From Mail</label>
								<div class="col-sm-8">
									<input type="text" class="form-control"  name="email_from" placeholder="Enter From Mail">
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Phone</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Reply Mail</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="replay_email" placeholder="Enter Reply Mail">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="title" placeholder="Enter Title">
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta keywords</label>
								<div class="col-sm-8">
									<textarea  name="meta_keywords" class="form-control"></textarea> 
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta Description</label>
								<div class="col-sm-8">
									<textarea  name="meta_description" class="form-control"></textarea> 
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Google Analytics Codes</label>
								<div class="col-sm-8">
									<textarea  name="google_analytics_code" class="form-control"></textarea> 
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Copyrights</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="copyrights" placeholder="Enter Copyrights">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Select Status</label>
								<div class="col-sm-8">
									<select name="status" id="status" class="form-control selectpicker"  >
										<option name="enable"  value="1">Enable</option>
										<option name="disable"  value="0">Disable</option>
									</select>
								</div>                      
							</div>
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<input type="submit" value="SAVE" class="btn-primary btn">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php
			}// end of add
		}// end of action set edit/add
	?>
	
	<script language="JavaScript">
		$('#prev_image_name').mouseover(function() {	$('#prev_image').show();	});
		$('#prev_image_name').mouseout(function() {	$('#prev_image').hide();	});
		
		function selectAll(source) {
			checkboxes = document.getElementsByName('colors[]');
			for (var i in checkboxes)
			checkboxes[i].checked = source.checked;
		}
	</script>
<?php include_once('includes/footer.php'); ?>	