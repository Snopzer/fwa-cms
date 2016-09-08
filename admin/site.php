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
	
	$pages = $siteCount / ADMIN_PAGE_LIMIT;
	$pages = ceil($pages);
	
	//pagination
	$page = false;
	if (array_key_exists('page', $_GET)) {
		$page = $_GET['page'];
	}
	if ($page == "" || $page == 1) {
		$page1 = 0;
		} else {
		$page1 = ($page * ADMIN_PAGE_LIMIT) - ADMIN_PAGE_LIMIT;
	}
	$selectSiteList = mysql_query("SELECT * FROM r_site_details order by id desc limit ".$page1.",".ADMIN_PAGE_LIMIT)or die(mysql_error());					
	
?>  
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/menu.php'); ?>
<script src="js/ckeditor/ckeditor.js"></script>
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
						<?php if(isset($_GET['message']) && $_GET['message']!=''){ ?>
							<div class="alert alert-<?php echo $_GET['response']?> fade in">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $_GET['message'];?>
							</div>
						<?php } ?>
						<div class="horz-grid">
							<div class="bs-example">
								<table class="table">
									<tbody>
										<tr>
											<td><h1 id="h1.-bootstrap-heading"> Sites - [<?php echo $siteCount;?>]</h1></td>
											<td class="type-info text-right">
												<a href="site.php?action=add"><span class="btn btn-success"><?php echo ADD_BUTTON;?></span></a> 
												<a href="javascript:fnDetails();"><span class="btn btn-primary"><?php echo EDIT_BUTTON; ?></span></a>
												<a href="javascript:fnDelete();"><span class="btn btn-danger"><?php echo DELETE_BUTTON;?></span></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<table class="table"> 
								<form name="frmMain" method="post">
									<tr class="table-row">
										<td class="table-img">&nbsp;</td>
										<td class="march"><h6><input class="form-control" type="text" name="department" id="department"></h6></td>
										<td class="march"><h6><input class="btn btn-default" type="submit"  name="search" value="Search"></h6></td>                                
									</tr>
									
									<tr class="table-row">
										<td class="table-img">
											<input type="checkbox" name="checkall" onClick="Checkall()"/>
										</td>
										<td class="table-text"><h6>Site Name</h6></td>
										<td class="table-text"><h6>Owner Email</h6></td>
										<td class="table-text"><h6>Email From</h6></td>
										<td class="table-text"><h6>Phone</h6></td>
									</tr>
									<?php	
										
										while ($site = mysql_fetch_assoc($selectSiteList)) {	?>
										<tr class="table-row">
											<td class="table-img"><input type="checkbox" name="selectcheck" value="<?= $site["id"] ?>"></td>
											<td class="march"><h6><?php echo $site["site_name"] ?></h6></td>
											<td class="march"><h6><?php echo $site["owner_email"] ?></h6></td>
											<td class="march"><h6><?php echo $site["email_from"] ?></h6></td>
											<td class="march"><h6><?php echo $site["phone"] ?></h6></td>
											<td><a href="site.php?id=<?php echo  $site["id"] ?>&action=edit&page=<?php echo  "$page"?>"><span class="label label-primary">Edit</span><a/>
											<a href="site-controller.php?chkdelids=<?php echo  $site["id"] ?>&action=delete&page=<?php echo  "$page"?>""><span class="label label-info">Delete</span></a>
											</td>
										</tr>
									<?php	}	?>
								</table>
								<input name="uid" type="hidden" value="<?php echo $_REQUEST["uid"]; ?>">
								<input type="hidden" name="action"/>
								<input type="hidden" name="id"/>
								<input type="hidden" name="chkdelids"/>
								<input type="hidden" name="page" value="<?php echo "$page"; ?>"/>
							</form>
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
							
							
							<ul class="nav nav-tabs" id="myTab">
								<li class="active"><a data-target="#site-details" data-toggle="tab">
								<h4 id="grid-example-basic">Site Details</h4></a></li>
								<li><a data-target="#site-mail" data-toggle="tab"><h4 id="grid-example-basic">Mail</h4></a></li>
								<li><a data-target="#site-settings" data-toggle="tab"><h4 id="grid-example-basic">Settings</h4></a></li>
							</ul>
							
							<div class="tab-content">
								<div class="tab-pane active" id="site-details">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Site Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["site_name"] ?>" name="site_name" placeholder="Enter Site Name">
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Site URL</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["site_url"] ?>" name="site_url" placeholder="Enter Site Name">
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Site Admin URL</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["site_admin_url"] ?>" name="site_admin_url" placeholder="Enter Site Name">
										</div>
									</div>
									
									
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">owner Name</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["owner_email"] ?>" name="owner_email" placeholder="Enter owner Name">
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Phone</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["phone"] ?>" name="phone" placeholder="Enter Phone Number">
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
											<textarea  name="meta_keywords" id="meta_keywords" class="form-control"><?php echo  $result["meta_keywords"] ?></textarea> 
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label ">Meta Description</label>
										<div class="col-sm-8">
											<textarea  name="meta_description" id="meta_description" class="form-control"><?php echo  $result["meta_description"] ?></textarea> 
										</div>
									</div>
									
									
								</div>
								<div class="tab-pane" id="site-settings">
									
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label ">Google Analytics Codes</label>
										<div class="col-sm-8">
											<textarea  name="google_analytics_code" class="form-control"><?php echo  $result["google_analytics_code"] ?></textarea> 
										</div>
									</div>
									
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Admin Page Limit</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["admin_page_limit"] ?>" name="admin_page_limit" placeholder="Enter Copyrights">
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Post Description Length</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["post_description_length"] ?>" name="post_description_length" placeholder="Enter Copyrights">
										</div>
									</div>
									
									
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Copyrights</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["copyrights"] ?>" name="copyrights" placeholder="Enter Copyrights">
										</div>
									</div>
									
									
								</div>
								<div class="tab-pane" id="site-mail">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">From Mail</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["email_from"] ?>" name="email_from" placeholder="Enter From Mail">
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label hor-form">Reply Mail</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" value="<?php echo  $result["replay_email"] ?>" name="replay_email" placeholder="Enter Reply Mail">
										</div>
									</div>
								</div>
							</div>
							
							<!--
								site_url
site_admin_url
admin_page_limit
post_description_length

add_button_lable
edit_button_lable
delete_button_lable
save_button_lable
admin_no_reocord_found
							-->
							
							
							
							
							
							
							
							
							
							
							<!--<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label hor-form">Select Status</label>
								<div class="col-sm-8">
								<select name="status" id="status" class="form-control selectpicker"  >
								<option name="enable"  value="1" <?php if($result['status']==1){ echo "Selected";}?>>Enable</option>
								<option name="disable"  value="0" <?php if($result['status']==0){ echo "Selected";}?>>Disable</option>
								</select>
								</div>                      
							</div>-->
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<input type="submit" value="<?php echo UPDATE_BUTTON;?>" class="btn-primary btn">
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
									<textarea  name="meta_keywords" id="meta_keywords" class="form-control"></textarea> 
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label ">Meta Description</label>
								<div class="col-sm-8">
									<textarea  name="meta_description" id="meta_description" class="form-control"></textarea> 
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
									<input type="submit" value="<?php echo SAVE_BUTTON;?>" class="btn-primary btn">
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
	<script language="JavaScript">
		function fnDetails()
		{
			var obj = document.frmMain.elements;
			flag = 0;
			for (var i = 0; i < obj.length; i++)
			{
				if (obj[i].name == "selectcheck" && obj[i].checked)
				{
					flag = 1;
					break;
				}
			}
			if (flag == 0)
			{
				alert("Please make a selection from a list to Edit");
			} else if (flag == 1)
			{
				var checkedvals = "";
				for (var i = 0; i < obj.length; i++) {
					if (obj[i].checked == true) {
						checkedvals = checkedvals + "," + obj[i].value;
					}
				}
				var checkvals = checkedvals.substr(1);
				var arrval = checkvals.split(",");
				if (arrval.length > 1)
				{
					alert("Select Only One checkbox to edit");
				} else
				{
					window.location.href = "site.php?action=edit&page=<? echo "$page"?>&id=" + arrval[0];
				}
			}
		}
	</script>
	
	
	<script language="JavaScript">
		function Checkall()
		{
			if (document.frmMain.checkall.checked == true)
			{
				var obj = document.frmMain.elements;
				for (var i = 0; i < obj.length; i++)
				{
					if ((obj[i].name == "selectcheck") && (obj[i].checked == false))
					{
						obj[i].checked = true;
					}
				}
			} else if (document.frmMain.checkall.checked == false)
			{
				var obj = document.frmMain.elements;
				for (var i = 0; i < obj.length; i++)
				{
					if ((obj[i].name == "selectcheck") && (obj[i].checked == true))
					{
						obj[i].checked = false;
					}
				}
			}
		}
		function fnDelete()
		{
			var obj = document.frmMain.elements;
			flag = 0;
			for (var i = 0; i < obj.length; i++)
			{
				if (obj[i].name == "selectcheck" && obj[i].checked) {
					flag = 1;
					break;
				}
			}
			if (flag == 0) {
				alert("Select Checkbox to Delete");
				} else if (flag == 1) {
				var i, len, chkdelids, sep;
				chkdelids = "";
				sep = "";
				for (var i = 0; i < document.frmMain.length; i++) {
					if (document.frmMain.elements[i].name == "selectcheck")
					{
						if (document.frmMain.elements[i].checked == true) {
							//alert(document.frmFinal.elements[i].value)
							chkdelids = chkdelids + sep + document.frmMain.elements[i].value;
							sep = ",";
						}
					}
				}
				ConfirmStatus = confirm("Do you want to DELETE selected User Role.?")
				if (ConfirmStatus == true) {
					document.frmMain.chkdelids.value = chkdelids
					document.frmMain.action.value = "delete"
					document.frmMain.action = "site-controller.php";
					document.frmMain.submit()
				}
			}
		}
	</script>								