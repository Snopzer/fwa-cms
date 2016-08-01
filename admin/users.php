<?php
	session_start();
	include_once('includes/config.php');
	if (!isset($_SESSION['id'])) {
		
		header('location:index.php');
	}
	$userQuery = mysql_query("SELECT u.*, ur.role as adminrole FROM r_user u,r_user_role ur where u.id_user_role=ur.id_user_role order by id_user desc")or die(mysql_error());
	$userCount = mysql_num_rows($userQuery);
	$pages = $userCount / 5;
	$pages = ceil($pages);
	
	$page = false;
	if (array_key_exists('page', $_GET)) {
		$page = (int)$_GET['page'];
	}
	//  $page = $_GET["page"];
	if ($page == "" || $page == 1) {
		$page1 = 0;
		} else {
		$page1 = ($page * 5) - 5;
	}
	//select ur.role as role , ur.*,u.* from r_user_role ur,r_user u where u.id_user_role = ur.id_user_role
	$userList = mysql_query("SELECT u.*, ur.role as adminrole FROM r_user u,r_user_role ur where u.id_user_role=ur.id_user_role order by id_user desc limit $page1,5")or die(mysql_error());
?>  
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/menu.php'); ?>
<?php if (!isset($_GET['action'])) { ?>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">	
            <div class="banner">
                <h2>
                    <a href="home.php">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Users</span>
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
                                            <td><h1 id="h1.-bootstrap-heading"> USERS - [<?php echo $userCount; ?>]</h1></td>
                                            <td class="type-info text-right">
                                                <a href="users.php?action=add"><span class="btn btn-success">Add New</span></a> 
                                                <a  href="javascript:fnDetails();"><span class="btn btn-primary">Edit</span></a>
                                                <a  href="javascript:fnDelete();"><span class="btn btn-danger">Delete</span></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							
                            <table class="table"> 
                                <form name="frmMain" method="post">
                                    <tr class="table-row">
                                        <td class="table-img">
                                            <input type="checkbox" name="checkall" onClick="Checkall()"/>
										</td>
                                        <td class="table-text"><h6>Name</h6></td>
                                        <td class="table-text"><h6>Email</h6></td>
                                        <td class="table-text"><h6>Phone</h6></td>
                                        <td class="table-text"><h6>Role</h6></td>
                                        <td class="table-text"><h6>Status</h6></td>
									</tr>
                                    <?php
										if (mysql_num_rows($userList) > 0) {
											while ($user = mysql_fetch_assoc($userList)) {
											?>
												<tr class="table-row <?php echo ($user["status"]==1)?'warning':'danger'; ?>">
                                                <td class="table-img"><input type="checkbox" name="selectcheck" value="<?= $user["id_user"] ?>"/></td>
                                                <td class="march"><h6><?php echo $user["name"] ?></h6></td>
                                                <td class="march"><h6><?php echo $user["email"] ?></h6></td>
                                                <td class="march"><h6><?php echo $user["phone"] ?></h6></td>
                                                <td class="march"><h6><?php echo $user["adminrole"] ?></h6></td>
                                                <td class="march"><h6><?php echo ($user["status"] == 1) ? 'Enable' : 'Disable'; ?></h6></td>
                                                <td><a href="users.php?id=<?php echo $user["id_user"] ?>&action=edit&page=<?php echo "$page" ?>"><span class="label label-primary">Edit</span><a/>
												<a href="users-controller.php?chkdelids=<?php echo $user["id_user"] ?>&action=delete&page=<?php echo "$page" ?>""><span class="label label-info">Delete</span></a>
                                                </td>
											</tr>
                                            <?php
											}
											} else {
										?>
                                        <tr class="table-row">
                                            <td class="table-img text-center" colspan="4">No Records Found</td>
										</tr>
									<?php } ?>
								</table>
								<input name="uid" type="hidden" value="<?php echo $_REQUEST["uid"]; ?>">
								<input type="hidden" name="action"/>
								<input type="hidden" name="id"/>
								<input type="hidden" name="chkdelids"/>
								<input type="hidden" name="page" value="<?php echo "$page"; ?>"/>
							</form>
                            <?php
								if ($userCount > 5) {
								?>
                                <div class="horz-grid text-center">
                                    <ul class="pagination pagination-lg">
										
                                        <?php for ($b = 1; $b <= $pages; $b++) { ?>
                                            <?php if ($b == $page) { ?>
                                                <li class="active"><a href="users.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>    
												<?php } else { ?>
                                                <li><a href="users.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a></li>
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
	<?php }// show all users ends here ?>
    <?php if (isset($_GET['action'])) { ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="content-main">
                <div class="banner">
                    <h2>
                        <a href="home.php">Home</a>
                        <i class="fa fa-angle-right"></i>
                        <span><a href="users.php">Users</a></span>
                        <i class="fa fa-angle-right"></i>
                        <span><?php echo ($_GET['action'] == 'edit') ? 'Edit User' : 'Add user'; ?></span>
					</h2>
				</div>
                <div class="grid-system">
                    <div class="horz-grid">
                        <div class="grid-hor">
                            <h4 id="grid-example-basic"><?php echo ($_GET['action'] == 'edit') ? 'Edit User' : 'Add User'; ?> Details:</h4>
							
						</div>
                        <?php
							if ($_GET['action'] == "edit") {
								if (isset($_GET['uid'])) {
									$id = $_GET['uid'];
									} else {
									$id = $_GET['id'];
								}
								$page = $_GET['page'];
								$query = mysql_query("select * from r_user ru, r_seo_url seo where ru.id_user=seo.id_user and ru.id_user=$id")or die(mysql_error());
								$result = mysql_fetch_assoc($query);
							?>
                            <form class="form-horizontal" action="users-controller.php" method="post">
                                <input type="hidden" name="action" value="edit"/>
                                <input type="hidden" name="id" value="<?php echo $result["id_user"] ?>">
                                <input type="hidden" name="page" value="<?php echo "$page" ?>"/>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $result["name"] ?>" id="name" name="name" placeholder="name">
									</div>
								</div>
								
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">SEO URL</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $result["seo_url"] ?>" id="title" name="seo_url" placeholder="SEO URL">
									</div>
								</div>
								
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $result["email"] ?>" id="email" name="email" placeholder="email" >
									</div>
								</div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $result["phone"] ?>" id="phone" name="phone" placeholder="phone">
									</div>
								</div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Department</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $result["department"] ?>" id="phone" name="department" placeholder="department">
									</div>
								</div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
									</div>
								</div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Skills</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="<?php echo $result["skills"] ?>" id="password" name="skills" placeholder="skills">
									</div>
								</div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Country</label>
                                    <div class="col-sm-8">
                                        <select name="country" class="form-control" >
											<option>Select Country</option>
                                            <?php
												$row = mysql_query("select * from r_country order by name asc")or die(mysql_error());
												while ($run = mysql_fetch_assoc($row)) {
													if ($run['id_country'] == $result['id_country']) {
													?>
                                                    <option value='<?php echo $run['id_country'] ?>' selected><?php echo $run['name'] ?></option>'';
													<?php } else { ?>
                                                    <option value='<?php echo $run['id_country'] ?>'><?php echo $run['name'] ?></option>';
												<?php } ?>
											<?php } ?>
										</select>
									</div>
								</div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">User Role</label>
                                    <div class="col-sm-8">
                                        <select name="userrole" class="form-control" >
											<option>Select User Role</option>
                                            <?php
												$row = mysql_query("select * from r_user_role order by role asc")or die(mysql_error());
												while ($run = mysql_fetch_assoc($row)) {
													if ($run['id_user_role'] == $result['id_user_role']) {
													?>
                                                    <option value='<?php echo $run['id_user_role'] ?>' selected><?php echo $run['role'] ?></option>'';
													<?php } else { ?>
                                                    <option value='<?php echo $run['id_user_role'] ?>'><?php echo $run['role'] ?></option>';
												<?php } ?>
											<?php } ?>
										</select>
									</div>
								</div>
								
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label hor-form">Select Status</label>
                                    <div class="col-sm-8">
                                        <select name="status" id="status" class="form-control" >
                                            <option name="enable"  value="1" <?php
												if ($result['status'] == 1) {
													echo "Selected";
												}
											?>>Enable</option>
                                            <option name="disable"  value="0" <?php
												if ($result['status'] == 0) {
													echo "Selected";
												}
											?>>Disable</option>
										</select>
									</div>                      
								</div>
								
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <input type="submit" value="Save" class="btn-primary btn">
                                        <!--<button class="btn btn-default" type="reset">Reset</button>-->
									</div>
								</div></div>
						</form>
						<?php } elseif ($_GET['action'] == "add") { ?>
                        <?php if (isset($_GET['email']) && $_GET['email'] == "alreadyexist") { ?>
                            <p style="color: red">Email already exist!</p>
						<?php } ?>
                        <form class="form-horizontal" action="users-controller.php" method="post">
                            <input type="hidden" name="action" value="add"/>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="" id="name" name="name" placeholder="Enter Full Name">
								</div>
							</div>
							
							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">SEO URL</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="title" name="seo_url" placeholder="Enter SEO URL">
								</div>
							</div>
							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="" id="email" name="email" placeholder="Enter Email Address">
								</div>
							</div>
							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="" id="phone" name="phone" placeholder="Enter Phone Number">
								</div>
							</div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Department</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="" id="department" name="department" placeholder="Enter Department">
								</div>
							</div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" value="" id="password" name="password" placeholder="Enter Password">
								</div>
							</div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Skills</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="" id="skills" name="skills" placeholder="Enter Skills">
								</div>
							</div>
							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">Country</label>
                                <div class="col-sm-8">
                                    <select name="country" id="selector1" class="form-control" >
										<option>Select Country</option>
                                        <?php
											$row = mysql_query("select * from r_country order by name asc")or die(mysql_error());
											while ($run = mysql_fetch_assoc($row)) {
											?>
                                            <option value='<?php echo $run['id_country'] ?>' selected><?php echo $run['name'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label hor-form">User Role</label>
                                <div class="col-sm-8">
                                    <select name="userrole" id="selector1" class="form-control" >
										<option>Select User Role</option>
                                        <?php
											$row = mysql_query("select * from r_user_role order by role asc")or die(mysql_error());
											while ($run = mysql_fetch_assoc($row)) {
											?>
                                            <option value='<?php echo $run['id_user_role'] ?>' selected><?php echo $run['role'] ?></option>
										<?php } ?>
									</select>
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
                                    <input type="submit" value="Save" class="btn-primary btn">
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
                    window.location.href = "users.php?action=edit&page=<? echo "$page"?>&uid=" + arrval[0];
				}
			}
		}
	</script>
    <?php include_once('includes/footer.php'); ?>			
	
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
                ConfirmStatus = confirm("Do you want to DELETE selected User.?")
                if (ConfirmStatus == true) {
                    document.frmMain.chkdelids.value = chkdelids
                    document.frmMain.action.value = "delete"
                    document.frmMain.action = "users-controller.php";
                    document.frmMain.submit()
				}
			}
		}
</script>
     <?php include_once('includes/footer.php'); ?>	