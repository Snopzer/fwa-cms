<?php
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		
		
		header('location:index.php');
	}
	$id = (int)$_POST['id'];
	// display all posts
	$selectPosts = mysql_query("SELECT * FROM r_post order by id_post desc");
	$postCount = mysql_num_rows($selectPosts);
	
	$pages = $postCount / 5;
	$pages = ceil($pages);
	
	//pagination
	$page = false;
	if (array_key_exists('page', $_GET)) {
		$page = (int)$_GET['page'];
	}
	if ($page == "" || $page == 1) {
		$page1 = 0;
		} else {
		$page1 = ($page * 5) - 5;
	}
	$selectPostList = mysql_query("SELECT * FROM r_post order by id_post desc limit ".$page1.",5")or die(mysql_error());
?>  
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/menu.php'); ?>
<!-- editor script -->
<script src="js/ckeditor/ckeditor.js"></script>
<!-- editor script -->
<?php if(!isset($_GET['action'])){?>
	<div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="content-main">	
			<div class="banner">
				<h2>
					<a href="home.php">Home</a>
					<i class="fa fa-angle-right"></i>
					<span>Posts</span>
				</h2>
			</div>
			<div class="grid-system">
				<div class="horz-grid">
					<div class="grid-system">
						<?php if(isset($_GET['message']) && $_GET['message']!=''){ ?>
						<div class="alert alert-<?php echo $_GET['response']?> fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $_GET['message'];?>
						</div>
						<? } ?>
						<div class="horz-grid">
							<div class="bs-example">
								<table class="table">
									<tbody>
										<tr>
											<td><h1 id="h1.-bootstrap-heading"> POSTS - [<?php echo $postCount;?>]</h1></td>
											<td class="type-info text-right">
												<a href="posts.php?action=add"><span class="btn btn-success">Add New</span></a> 
												<a><span class="btn btn-primary">Edit</span></a>
												<a><span class="btn btn-danger">Delete</span></a>
												<!--<a><span class="btn btn-warning ">Enable</span></a>-->
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<table class="table table-hover"> 
								<tr class="table-row">
									<td class="table-img">
										<input type="checkbox" id="selectall" onClick="selectAll(this)" >
									</td>
									<td class="table-text"><h6>Title</h6></td>
									<td class="table-text"><h6>Date Added</h6></td>
									<td class="table-text"><h6>Status</h6></td>
									<td class="table-text"><h6>&nbsp;</h6></td>
								</tr>
								<?php	while ($post = mysql_fetch_assoc($selectPostList)) {	?>
									<tr class="table-row <?php echo ($post["status"]==1)?'warning':'danger'; ?>">
										<td class="table-img"><input type="checkbox" name="colors[]"></td>
										<td class="march"><h6><?php echo  $post["title"] ?></h6></td>
										<td class="march"><h6><?php echo  $post["date_added"] ?></h6></td>
										<td class="march"><h6><?php echo ($post["status"]==1)?'Enable':'Disable'; ?></h6></td>
										<td><a href="posts.php?id=<?php echo  $post["id_post"] ?>&action=edit&page=<?php echo  "$page"?>"><span class="label label-primary">Edit</span><a/>
										<a href="post-controller.php?id=<?php echo  $post["id_post"] ?>&action=delete&page=<?php echo  "$page"?>""><span class="label label-info">Delete</span></a>
										</td>
									</tr>
								<?php	}	?>
							</table>
							<?php	if ($postCount > 5) {	?>
								<div class="horz-grid text-center">
									<ul class="pagination pagination-lg">
										<?php for ($b = 1; $b <= $pages; $b++) { ?>
											<?php if ($b == $page) { ?>
												<li class="active"><a href="posts.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>    
												<?php } else { ?>
												<li><a href="posts.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
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
						<span><a href="posts.php">Posts</a></span>
						<i class="fa fa-angle-right"></i>
						<span><?php echo ($_GET['action']=='edit')?'Edit Post':'Add Post';?></span>
					</h2>
				</div>
				<div class="grid-system">
					<div class="horz-grid">
						<?php if($_GET['action'] == "edit"){
							$id = $_GET['id'];
							$page=$_GET['page'];
							$query = mysql_query("select p.id_category as category , p.*,su.* from r_post p,r_seo_url su where su.id_post = p.id_post and p.id_post=$id")or die(mysql_error());
							$result = mysql_fetch_assoc($query);
						?>
						<form class="form-horizontal" action="post-controller.php" method="post" enctype="multipart/form-data" >
							<input type="hidden" name="action" value="edit"/>
							<input type="hidden" name="id" value="<?php echo $result["id_post"] ?>">
							<input type="hidden" name="page" value='<?php echo "$page"?>'>
							<div class="grid-hor">
								<h4 id="grid-example-basic">Article Information</h4>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["title"] ?>" id="title" name="title" placeholder="title">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form ">Description</label>
								<div class="col-sm-8">
									<textarea name="description" id="description" class="form-control" rows="6"><?php echo  $result["description"] ?></textarea> 
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Image</label>
								<div class="col-sm-8">
									<input type="file" name="photo">
									<span id="prev_image_name"><?php echo $result["image"];?></span><br />
									<img style="display:none;" id="prev_image" src='../images/post/<?php echo  $result["image"] ?>' width="50" height="50"> 
									
								</div>
							</div>
							
							<div class="grid-hor">
								<h4 id="grid-example-basic">SEO Related Information</h4>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Seo url</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["seo_url"] ?>" id="title" name="seo_url" placeholder="seo_url">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo  $result["meta_title"] ?>" id="meta_title" name="meta_title" placeholder="meta_title">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Keywords</label>
								<div class="col-sm-8">
									<textarea  name="meta_keywords" class="form-control" rows="6"><?php echo  $result["meta_keywords"] ?></textarea> 
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Description</label>
								<div class="col-sm-8">
									<textarea  name="meta_description" class="form-control" rows="6"><?php echo  $result["meta_description"] ?></textarea> 
								</div>
							</div>
							<div class="grid-hor">
								<h4 id="grid-example-basic">Article Settings</h4>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Category</label>
								<div class="col-sm-8">
									<select name="category" id="selector1" class="form-control selectpicker" >
										<option value="">select category</option>
										<?php
											$row = mysql_query("select * from r_category ")or die(mysql_error());						
											while ($run = mysql_fetch_assoc($row)) {
												if($run['id_category']==$result['category']){?> 
												<option value="<?php echo $run['id_category']?>" selected><?php echo $run['name']?></option>
												<?php }else{ ?>
												<option value="<?php echo $run['id_category']?>"><?php echo $run['name']?></option>
												
												<?php }
											?>
										<?php }?>
									</select>
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
						<form class="form-horizontal" action="post-controller.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="add"/>
							<div class="grid-hor">
								<h4 id="grid-example-basic">Article Information</h4>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="title" name="title" placeholder="title">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Description</label>
								<div class="col-sm-8">
									<textarea  name="description" id="description" class="form-control" rows="6"></textarea> 	
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Image</label>
								<div class="col-sm-8">
									<input type="file" id="photo" name="photo" placeholder="photo">
								</div>
							</div>
							<div class="grid-hor">
								<h4 id="grid-example-basic">SEO Related Information</h4>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Seo url</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="seo_url" placeholder="seo_url">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="meta_title" placeholder="meta_title">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta Keywords</label>
								<div class="col-sm-8">
									<textarea  name="meta_keywords" class="form-control" rows="6"></textarea> 
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta Description</label>
								<div class="col-sm-8">
									<textarea  name="meta_description" class="form-control" rows="6"></textarea> 
								</div>
							</div>
							<div class="grid-hor">
								<h4 id="grid-example-basic">Article Settings</h4>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Category</label>
								<div class="col-sm-8">
									<select name="category" id="selector1" class="form-control" >
										<option value="0">Select Category</option>
										<?php  
											$row = mysql_query("select * from r_category ")or die(mysql_error());
											while ($run = mysql_fetch_array($row)) {	?>
											<option value="<?php echo $run['id_category'] ?>"><?php echo $run['name'] ?></option>
										<?php }?>
									</select>
								</div>                      
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Status</label>
								<div class="col-sm-8">
									<select name="status" id="status" class="form-control" >
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
		
		/* editor script */
		var editor=CKEDITOR.replace('description');
		/* editor script */
	</script>
<?php include_once('includes/footer.php'); ?>	