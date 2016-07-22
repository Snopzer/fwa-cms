<?php
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
?>  
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/menu.php'); ?>
<?php if (!isset($_GET['action']) & !isset($_GET['type'])) { ?>
	<div id="page-wrapper" class="gray-bg dashbard-1">
		<div class="content-main">	
			<div class="banner">
				<h2>
					<a href="home.php">Home</a>
					<i class="fa fa-angle-right"></i>
					<span>Category</span>
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
											<td><h1 id="h1.-bootstrap-heading"> CATEGORIES - [<?php
												$select = mysql_query("SELECT * FROM r_category order by id_category desc")or die(mysql_error());
												$count = mysql_num_rows($select);
												echo "$count";
											?>]</h1></td>
											<td class="type-info text-right">
												<a href="category.php?action=add"><span class="btn btn-success">Add New</span></a> 
												<a><span class="btn btn-primary" id="edit">Edit</span></a>
												<a><span class="btn btn-danger" id="delete">Delete</span></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<form action="category.php?type=search" method="post">
								<table class="table"> 
									<tr class="table-row">
										<td class="table-img">&nbsp;</td>
										<td class="march"><h6><input class="form-control" type="text" name="search" id="department"></h6></td>
										<td class="march"><h6><input class="btn btn-default" type="submit" value="Search Categories"></h6></td>                                
									</tr>
									<tr class="table-row">
										<td class="table-img">
											<input type="checkbox" id="selectall" onClick="selectAll(this)" >
										</td>
										<td class="table-text"><h6>Name</h6></td>
										<!--<td class="table-text"><h6>Description</h6></td>-->
										<td class="table-text"><h6>Status</h6></td>
									</tr>
									<?php
										$page = false;
										if (array_key_exists('page', $_GET)) {
											$page = $_GET['page'];
										}
										if ($page == "" || $page == 1) {
											$page1 = 0;
											} else {
											$page1 = ($page * 5) - 5;
										}
										$select = mysql_query("SELECT * FROM r_category order by id_category desc limit $page1,5")or die(mysql_error());
										if (mysql_num_rows($select) > 0) {
											while ($row = mysql_fetch_assoc($select)) {
											?>
											<tr class="table-row">
												<td class="table-img"><input type="checkbox" name="colors" value="<?php echo$row['id_category']?>"></td>
												<td class="march"><h6><?php echo $row["name"] ?></h6></td>
												<!--<td class="march"><h6><?php echo $row["description"] ?></h6></td>-->
												<td class="march"><h6><?php echo ($row["status"]==1)?'Enable':'Disable'; ?></h6></td>
												<td><a href="category.php?id=<?php echo $row["id_category"] ?>&action=edit&page=<?php echo "$page"?>"><span class="label label-primary">Edit</span><a/>
												<a href="category-controller.php?id=<?php echo $row["id_category"] ?>&action=delete&page=<?php echo "$page"?>""><span class="label label-info">Delete</span></a>
												</td>
											</tr>
											<?php
											}
											} else {
										?>
										<tr class="table-row">
											<td class="table-img text-center" colspan="4">No Records Found</td>
										</tr>
										<?php }
									?>
								</table>
							</form>
							<?php
								$res1 = mysql_query("SELECT * FROM r_category");
								$count = mysql_num_rows($res1);
								//echo "$count";
								$a = $count / 5;
								$a = ceil($a);
								/*echo $a;
								exit;*/
								if ($count > 5) {
								?>
								<div class="horz-grid text-center">
									<ul class="pagination pagination-lg">
										<?php for ($b = 1; $b <= $a; $b++) { ?>
											<?php if ($b == $page) { ?>
												<li class="active"><a href="category.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>    
												<?php } else { ?>
												<li><a href="category.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
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
	<?php } ?>
	<?php
		if (isset($_GET['action'])) {
		?>
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="content-main">
				<div class="banner">
					<h2>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
						<span><a href="category.php">Category</a></span>
						<i class="fa fa-angle-right"></i>
						<span><?php echo ($_GET['action'] == 'edit') ? 'Edit Category' : 'Add Category'; ?></span>
					</h2>
				</div>
				<div class="grid-system">
					<div class="horz-grid">
						<div class="grid-hor">
							<h4 id="grid-example-basic">Category Details:</h4>
							
						</div>
						<?php
							if ($_GET['action'] == "edit") {
								$id = $_GET['id'];
								$page = $_GET['page'];
								$query = mysql_query("select c.*,su.* from r_category c, r_seo_url su where  c.id_category = su.id_category  and c.id_category=$id")or die(mysql_error());
								$result = mysql_fetch_assoc($query);
							?>
							<form class="form-horizontal" action="category-controller.php" method="post">
								<input type="hidden" name="action" value="edit"/>
								<input type="hidden" name="id" value="<?php echo $result["id_category"] ?>">
								<input type="hidden" name="page" value='<? echo "$page"?>'>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label hor-form">Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $result["name"] ?>" id="name" name="name">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label hor-form">Description</label>
									<div class="col-sm-8">
										<textarea class="form-control"  name="description"><?php echo $result["description"] ?></textarea>
									</div>
								</div>
								
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label hor-form">SEO URL</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $result["seo_url"] ?>" id="seo_url" name="seo_url" >
									</div>
								</div>
								
								
								
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label hor-form">Image</label>
									<div class="col-sm-8">
										<input type="file" class="form-control" id="photo" name="photo" placeholder="<?php echo  $result["image"] ?>">
										<span id="prev_image_name"><?php echo $result["image"];?></span><br />
										<img style="display:none;" id="prev_image" src='images/<?php echo  $result["image"] ?>' width="50" height="50">
										
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Title</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo  $result["meta_title"] ?>" id="meta_title" name="meta_title" >
									</div>
								</div>
								
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label ">Meta Keywords</label>
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
									<label for="inputEmail3" class="col-sm-2 control-label ">Sort Order</label>
									<div class="col-sm-8">
										<input type="text"  class="form-control" id="sort_order" name="sort_order" value="<?php echo $result["sort_order"] ?>">
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
										<input type="submit" value="ADD" class="btn-primary btn">
										<!--<button class="btn btn-default" type="reset">Reset</button>-->
									</div>
								</div></div>
						</form>
						<?php
							} elseif ($_GET['action'] == "add") {
						?>
						<form class="form-horizontal" action="category-controller.php" method="post">
							<input type="hidden" name="action" value="add"/>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="" id="name" name="name" placeholder="Name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Description</label>
								<div class="col-sm-8">
									<textarea  class="form-control" id="description" name="description" ></textarea>
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">SEO URL</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="" id="seo_url" name="seo_url" >
								</div>
							</div>
							
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Image</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" id="photo" name="photo" placeholder="photo">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Meta Title</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="meta_title">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta Keywords</label>
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
								<label for="inputEmail3" class="col-sm-2 control-label ">Sort Order</label>
								<div class="col-sm-8">
									<input type="number"  min="1" class="form-control" id="sort_order" name="sort_order" placeholder="Sort Order">
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Status</label>
								<div class="col-sm-8">
									<select name="status" id="status" class="form-control1" >
										<option name="enable"  value="1">Enable</option>
										<option name="disable"  value="0">Disable</option>
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
	<?php
		if (isset($_GET['type']) && $_GET['type'] == "search") {
			$search = $_POST['search'];
			$query = mysql_query("SELECT * FROM `r_category` WHERE CONCAT( `name`) LIKE '%" . $search . "%' ")or die(mysql_error());
		?>
		
		
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<div class="content-main">	
				<div class="banner">
					<h2>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
						<span>Category</span>
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
												<td><h1 id="h1.-bootstrap-heading"> CATEGORIES - [<?php
													$select = mysql_query("SELECT * FROM `r_category` WHERE CONCAT( `name`) LIKE '%" . $search . "%' ")or die(mysql_error());
													$count = mysql_num_rows($select);
													echo "$count";
												?>]</h1></td>
												<td class="type-info text-right">
													<a href="category.php?action=add"><span class="btn btn-success">Add New</span></a> 
													<a><span class="btn btn-primary">Edit</span></a>
													<a><span class="btn btn-danger">Delete</span></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<form action="category.php?type=search" method="post">
									<table class="table"> 
										<tr class="table-row">
											<td class="table-img">&nbsp;</td>
											<td class="march"><h6><input class="form-control" type="text" name="search" id="department"></h6></td>
											<td class="march"><h6><input class="btn btn-default" type="submit"></h6></td>                                
										</tr>
										
										<tr class="table-row">
											<td class="table-img">
												<input type="checkbox" id="selectall" onClick="selectAll(this)" >
											</td>
											<td class="table-text"><h6>Name</h6></td>
											<td class="table-text"><h6>Description</h6></td>
											<td class="table-text"><h6>Status</h6></td>
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
											$query = mysql_query("SELECT * FROM `r_category` WHERE CONCAT( `name`) LIKE '%" . $search . "%' ")or die(mysql_error());
											if ($query) {
												
												if (mysql_num_rows($query) > 0) {
													while ($row = mysql_fetch_assoc($query)) {
													?>
													<tr class="table-row">
														<td class="table-img"><input type="checkbox" name="categoryId" value="<?php echo $row["id_category"] ?>"></td>
														<td class="march"><h6><?php echo $row["name"] ?></h6></td>
														<td class="march"><h6><?php echo $row["description"] ?></h6></td>
														<td class="march"><h6><?php echo ($row["status"]==1)?'Enable':'Disable'; ?></h6></td>
														<td><a href="category.php?id=<?php echo $row["id_category"] ?>&action=edit&page=<?echo "$page"?>"><span class="label label-primary">Edit</span><a/>
														<a href="category-controller.php?id=<?php echo $row["id_category"] ?>&action=delete&page=<?echo "$page"?>""><span class="label label-info">Delete</span></a>
														</td>
													</tr>
													<?php }
													} else {
												?>
												<tr class="table-row">
													<td class="march"></td>
													<td class="march"><h3>NO RESULTS MATCHING</h3></td>
													
													<?php
													}
												}
											?>
										</table>
									</form>
									<?php
										$res1 = mysql_query("SELECT * FROM `r_category` WHERE CONCAT( `name`) LIKE '%" . $search . "%'");
										$count = mysql_num_rows($res1);
										//echo "$count";
										$a = $count / 5;
										$a = ceil($a);
									?>
									<div class="horz-grid text-center">
										<ul class="pagination pagination-lg">
											<?php for ($b = 1; $b <= $a; $b++) { ?>
												<?php if ($b == $page) { ?>
													<li class="active"><a href="category.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>    
													<?php } else { ?>
													<li><a href="category.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
													<?php
													}
												}
											?>
										</ul>
									</div>
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				
				
			<?php } ?>
			
			<script language="JavaScript">
				function selectAll(source) {
					checkboxes = document.getElementsByName('colors[]');
					for (var i in checkboxes)
					checkboxes[i].checked = source.checked;
				}
				
				$("#edit").click(function(){
					alert("Edit Record");  
					
					$('input[name="categoryId"]:checked').each(function() {
						console.log(this.value); 
						alert(this.value);
					});
					/*console.log($('input[name="category"]:checked'));
						
						$('input[name="category"]:checked').each(function() {
						console.log(this.value);
					});*/
					
					//console.log($('input[name=category\\[\\]]'));
					
				});
				$("#delete").click(function(){
					alert("Deleting Records");
				});
				
			</script>
			
			
			<?php include_once('includes/footer.php'); ?>					