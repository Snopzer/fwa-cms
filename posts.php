<?php
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		
		
		header('location:index.php');
	}
?>  
<?php include_once('includes/header.php'); ?>
<!-- edito related files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="js/editor/editor.js"></script>
<!-- edito related files -->		
<?php include_once('includes/menu.php'); ?>
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
						
						<div class="horz-grid">
							<div class="bs-example">
								<table class="table">
									<tbody>
										<tr>
											<td><h1 id="h1.-bootstrap-heading"> POSTS - [<?php
												$select = mysql_query("SELECT * FROM r_post order by id_post desc")or die(mysql_error());
												$count = mysql_num_rows($select);
												echo "$count";
											?>]</h1></td>
											<td class="type-info text-right">
												<a href="posts.php?action=add"><span class="btn btn-success">Add New</span></a> 
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
									<td class="table-text"><h6>Title</h6></td>
									<td class="table-text"><h6>Date Added</h6></td>
									<!--<td class="table-text"><h6>Phone</h6></td>
										<td class="table-text"><h6>Department</h6></td>
										<td class="table-text"><h6>Password</h6></td>
										<td class="table-text"><h6>Skills</h6></td>
									<td class="table-text"><h6>Country</h6></td>-->
								</tr>
								<?php
									$page = false;
									if (array_key_exists('page', $_GET)) {
										$page = $_GET['page'];
									}
									//  $page = $_GET["page"];
									if ($page == "" || $page == 1) {
										$page1 = 0;
										} else {
										$page1 = ($page * 5) - 5;
									}
									
									
									$select = mysql_query("SELECT * FROM r_post order by id_post desc limit $page1,5")or die(mysql_error());
									if ($select) {
										while ($row = mysql_fetch_assoc($select)) {
										?>
										<tr class="table-row">
											<td class="table-img"><input type="checkbox" name="colors[]"></td>
											<td class="march"><h6><?= $row["title"] ?></h6></td>
											
											<td class="march"><h6><?= $row["date_added"] ?></h6></td>
											<!--<td class="march"><h6><?= $row["phone"] ?></h6></td>
												<td class="march"><h6><?= $row["department"] ?></h6></td>
												<td class="march"><h6><?= $row["password"] ?></h6></td>
												<td class="march"><h6><?= $row["skills"] ?></h6></td>
											<td class="march"><h6><?= $row["country"] ?></h6></td>-->
											<td><a href="posts.php?id=<?= $row["id_post"] ?>&action=edit&page=<?echo "$page"?>"><span class="label label-primary">Edit</span><a/>
											<a href="post-controller.php?id=<?= $row["id_post"] ?>&action=delete&page=<?echo "$page"?>""><span class="label label-info">Delete</span></a>
											</td>
										</tr>
										<?php
										}
									}
								?>
							</table>
							<?php
								$res1 = mysql_query("SELECT * FROM r_post");
								$count = mysql_num_rows($res1);
								//echo "$count";
								$a = $count / 5;
								$a = ceil($a);
								if ($count > 5) {
							?>
							<div class="horz-grid text-center">
								<ul class="pagination pagination-lg">
									<?php for ($b = 1; $b <= $a; $b++) { ?>
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
							 <? } ?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	<?php  }// show all users ends here?>
	<?php
		if (isset($_GET['action'])) {
		?>
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
						<div class="grid-hor">
							<h4 id="grid-example-basic">User Details:</h4>
							
						</div>
						<?php if($_GET['action'] == "edit"){
							$id = $_GET['id'];
							$page=$_GET['page'];
							$query = mysql_query("select * from r_post where id_post=$id")or die(mysql_error());
							$result = mysql_fetch_assoc($query);
						?>
						<form class="form-horizontal" action="post-controller.php" method="post" enctype="multipart/form-data" >
							<input type="hidden" name="action" value="edit"/>
							<input type="hidden" name="id" value="<?= $result["id_post"] ?>">
							<input type="hidden" name="page" value='<? echo "$page"?>'>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?= $result["title"] ?>" id="title" name="title" placeholder="title">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Description</label>
								<div class="col-sm-8">
									<!--<input type="text" class="form-control" value="<?= $result["description"] ?>" id="description" name="description" placeholder="description">-->
									<textarea  name="description" id="txtEditor"><?= $result["description"] ?></textarea> 
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Image</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" id="photo" name="photo" placeholder="<?= $result["image"] ?>">
									<img  src='images/<?= $result["image"] ?>' width="50" height="50">
									<input type="hidden" name="preview_image" value="<?= $result["image"] ?>">
									
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Date Added</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?= $result["date_added"] ?>" id="date_added" name="date_added" placeholder="Date added">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Seo url</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?= $result["seo_url"] ?>" id="title" name="seo_url" placeholder="seo_url">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Category</label>
								<div class="col-sm-8">
									<select name="category" id="selector1" class="form-control1" >
									<?php
										$row = mysql_query("select * from r_category ")or die(mysql_error());						
										while ($run = mysql_fetch_assoc($row)) {
										if($result['category']!==""){?>
										<option value="<?=$result['id_category']?>" selected><?=$result['id_category']?></option>
										<?php}else{?>
										<option value=""  selected>select category</option>
										<?php }
										?>
										<!--<option value="<?= $run['name'] ?>"><?= $run['name'] ?></option>-->
									<?php }?>
									</select>
								</div>                      
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">User</label>
								<div class="col-sm-8">
									<select name="user" id="selector1" class="form-control1" ><?php
										if($result['id_user']!==""){?>
										<option value="<?=$result['id_user']?>" selected><?=$result['id_user']?></option>
										<?php  }else{?>
										<option value=""  selected>select user</option>
										<?php }
										$row = mysql_query("select * from r_user ")or die(mysql_error());
										
										while ($run = mysql_fetch_assoc($row)) {
											if($run['name']!=""){
											?>
											<option value="<?= $run['name'] ?>"><?= $run['name'] ?></option>
										<?php }}?>
									</select>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<input type="submit" value="ADD" class="btn-primary btn">
									<!--<button class="btn btn-default" type="reset">Reset</button>-->
								</div>
							</div></div>
							
							
							
						</form>
						<?php
							} elseif($_GET['action'] == "add") {
						?>
						<form class="form-horizontal" action="post-controller.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="add"/>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="" id="title" name="title" placeholder="title">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Description</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="" id="description" name="description" placeholder="description">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Image</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" value="" id="photo" name="photo" placeholder="photo">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Seo url</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="<?= $result["seo_url"] ?>" id="title" name="seo_url" placeholder="seo_url">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Date Added</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="" id="date_added" name="date_added" placeholder="Date added">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Category</label>
								<div class="col-sm-8">
									<select name="category" id="selector1" class="form-control1" >
										<option value=""  selected>select category</option>
										
										<?php  
											$row = mysql_query("select * from r_category ")or die(mysql_error());
											
											while ($run = mysql_fetch_array($row)) {
											?>
											<option value="<?= $run['name'] ?>"><?= $run['name'] ?></option>
										<?php }?>
									</select>
								</div>                      
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">User</label>
								<div class="col-sm-8">
									<select name="user" id="selector1" class="form-control1" >
										
										<option value=""  selected>select user</option>
										<?php 
											$row = mysql_query("select * from r_user ")or die(mysql_error());
											
											while ($run = mysql_fetch_assoc($row)) {
												if($run['name']!=""){
												?>
												<option value="<?= $run['name'] ?>"><?= $run['name'] ?></option>
											<?php }}?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<input type="submit" value="ADD" class="btn-primary btn">
									<!--<button class="btn btn-default" type="reset">Reset</button>-->
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
			$(document).ready(function() {
				$("#txtEditor").Editor();
			});
		
		function selectAll(source) {
			checkboxes = document.getElementsByName('colors[]');
			for (var i in checkboxes)
			checkboxes[i].checked = source.checked;
		}
	</script>
	<?php include_once('includes/footer.php'); ?>	
	
