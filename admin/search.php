<?php include_once('includes\header.php'); ?>
<?php include_once('includes\menu.php'); ?>

<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<?php if (isset($_GET['type']) && $_GET['type'] == "search") {
$search = $_POST['search'];
?>
<!--banner-->	
<div class="banner">
<h2>
	<a href="home.php">Home</a>
	<i class="fa fa-angle-right"></i>
	<span>Search Results</span>
</h2>
</div>
<div class="grid-system">
<div class="horz-grid">
	
	<div class="grid-system">
		<?php
			
			$query = mysql_query("SELECT * FROM `r_user` WHERE CONCAT(`id_user`, `name`, `phone`, `department`, `email`,`skills`, `country`) LIKE '%" . $search . "%' ")or die(mysql_error());
			if ($query) {
				if (mysql_num_rows($query) > 0) {
				?>
				<div class="horz-grid">
					<div class="bs-example">
						<table class="table">
							<tbody>
								<tr>
									<td><h1 id="h1.-bootstrap-heading"> USERS</h1></td>
									<td class="type-info">
										<a href="edituser.php"><span class="label label-success">Add New</span></a> 
										<a href="edituser.php"><span class="label label-primary">Edit</span></a>
										<a href="edituser.php"><span class="label label-danger">Delete</span></a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<table class="table"> 
						<tr class="table-row">
							<td class="table-img">
								<input type="checkbox" id="selectall" onClick="selectAll(this)" >
							</td>
							<td class="table-text"><h6>Name</h6></td>
							<td class="table-text"><h6>Email</h6></td>
							<td class="table-text"><h6>Phone</h6></td>
							<td class="table-text"><h6>Department</h6></td>
							<!--<td class="table-text"><h6>Password</h6></td>-->
							<td class="table-text"><h6>Skills</h6></td>
							<td class="table-text"><h6>Country</h6></td>
						</tr>
						
						<?php
							//seach                            
							while ($row1 = mysql_fetch_array($query)) {
							?>   
							<tr class="table-row">
								<td class="table-img"><input type="checkbox" name="colors[]"></td>
								<td class="march"><h6><?= $row1["name"] ?></h6></td>
								<td class="march"><h6><?= $row1["email"] ?></h6></td>
								<td class="march"><h6><?= $row1["phone"] ?></h6></td>
								<td class="march"><h6><?= $row1["department"] ?></h6></td>
								<!--<td class="march"><h6><?= $row1["password"] ?></h6></td>-->
								<td class="march"><h6><?= $row1["skills"] ?></h6></td>
								<td class="march"><h6><?= $row1["country"] ?></h6></td>
								<td><a href="edituser.php?id=<?= $row1["id_user"] ?>&type=edit&page=<?echo "$page"?>"><span class="label label-primary">Edit</span><a/>
									<a href="deleteuser.php?id=<?= $row1["id_user"] ?>&type=delete"><span class="label label-info">Delete</span></a>
								</td>
								</tr>
								<?php
								}
							?>		      
							
						</table>
						
					</div>
				<?php }} ?>
		</div>
		
	</div>
	<?php
		$select = mysql_query("SELECT * FROM `r_page` WHERE CONCAT(`id_page`, `title`, `meta_description`, `meta_keywords`, `page_heading`, `page_description`) LIKE '%" . $search . "%'")or die(mysql_error());
		if ($select) {
			if (mysql_num_rows($select) > 0) {
			?>
			
			<div class="horz-grid">
				<div class="bs-example">
					<table class="table">
						<tbody>
							<tr>
								<td><h1 id="h1.-bootstrap-heading">PAGES</h1></td>
								<td><a href="metaedit.php"><span class="label label-success">Add New</span></a>
									<a href="metaedit.php"><span class="label label-primary">Edit</span></a>
									<a href="metaedit.php"><span class="label label-danger">Delete</span></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				
				<table  class="table">         		
					<tr class="table-row">
						<td class="table-img">
							<input type="checkbox" id="selectall" onClick="selectAll(this)">
						</td>
						<td class="table-text"><h6>Title</h6></td>
						<td class="table-text"><h6>Meta Description</h6></td>
						<td class="table-text"><h6>Meta_keywords</h6></td>
						<td class="table-text"><h6>Page_heading</h6></td>
						<td class="table-text"><h6>Page_description</h6></td>
						<td class="march"> Action </td>
					</tr>	
					<?php while ($row = mysql_fetch_assoc($select)) { ?>
						<tr class="table-row">
							<td class="table-img"><input type="checkbox" name="colors[]"></td>
							<td class="march"><h6><?= $row["title"] ?></h6></td>
							<td class="march"><h6><?= $row["meta_description"] ?></h6></td>
							<td class="march"><h6><?= $row["meta_keywords"] ?></h6></td>
							<td class="march"><h6><?= $row["page_heading"] ?></h6></td>
							<td class="march"><h6><?= $row["page_description"] ?></h6></td>
							<td>
								<a href="metaedit.php?id=<?= $row["id_page"] ?>&type=edit&page=<?echo "$page"?>"><span class="label label-primary">Edit</span><a/>
									<a href="metadelete.php?id=<?= $row["id_page"] ?>&type=delete"><span class="label label-info">Delete</span></a>
								</td>
							</tr>
							<?php
							}
						?>
					</table>
				</div>
				<?php }
			} ?>
	</div>
	
	<?php
		$select = mysql_query("SELECT * FROM `r_ramzan_time` WHERE CONCAT(`id_ramzan`, `r_date`, `r_saheri`, `r_fazar`, `r_zohar`, `r_asar`, `r_iftar`, `r_maghrib`, `r_isha`) LIKE '%" . $search . "%'")or die(mysql_error());
		if ($select) {
			
			if (mysql_num_rows($select) > 0) {
			?>                    
			<div class="horz-grid">
				
				<div class="bs-example">
					<form method="post">
						<table class="table">
							<tbody>
								<tr>
									<td><h1 id="h1.-bootstrap-heading">SALAH TIMINGS</h1></td>
									<td class="type-info">
										<a href="editdetails.php"><span class="label label-success">Add New</span></a>
										<a href="editdetails.php"><span class="label label-primary">Edit</span></a>
										<a href="javascript:fnDelete();"><span class="label label-danger">Delete</span></a>
									</td>
								</tr>
							</tbody>
						</table>
						<table  class="table">         		
							<tr class="table-row">
								<td class="table-img">
									<input type="checkbox" id="selectall" onClick="selectAll(this)">
								</td>
								<td class="table-text"><h6>Date</h6></td>
								<td class="table-text"><h6>SAHERI</h6></td>
								<td class="table-text"><h6>FAZAR</h6></td>
								<td class="table-text"><h6>ZOHAR</h6></td>
								<td class="table-text"><h6>ASAR</h6></td>
								<td class="table-text"><h6>IFTAR</h6></td>
								<td class="table-text"><h6>MAGHRIB</h6></td>
								<td class="table-text"><h6>ISHA</h6></td>
								<td class="march"> Action </td>
							</tr>
							<?php
								while ($row = mysql_fetch_assoc($select)) {
								?>
								<tr class="table-row">
									
									<td class="table-img"><div id="checkboxlist"><input type="checkbox"  value="<?= $row["id_ramzan"] ?>" name="colors[]"/></div></td>
									<td class="march"><h6><?= $row["r_date"] ?></h6></td>
									<td class="march"><h6><?= $row["r_saheri"] ?></h6></td>
									<td class="march"><h6><?= $row["r_fazar"] ?></h6></td>
									<td class="march"><h6><?= $row["r_zohar"] ?></h6></td>
									<td class="march"><h6><?= $row["r_asar"] ?></h6></td>
									<td class="march"><h6><?= $row["r_iftar"] ?></h6></td>
									<td class="march"><h6><?= $row["r_maghrib"] ?></h6></td>
									<td class="march"><h6><?= $row["r_isha"] ?></h6></td>
									<td>
										<a href="editdetails.php?id=<?= $row["id_ramzan"] ?>&type=edit&page=<?echo "$page"?>"><span class="label label-primary">Edit</span><a/>
											<a href="deletedetails.php?id=<?= $row["id_ramzan"] ?>&type=delete"><span class="label label-info">Delete</span></a>
										</td>
									</tr>
									<?php
									}
								?>
								<input type="hidden" name="chkdelids">
							</table>
						</form>
					</div>
				</div>
			<?php }}
		}?>
</div>
<script language="JavaScript">
	function selectAll(source) {
		checkboxes = document.getElementsByName('colors[]');
		for (var i in checkboxes)
		checkboxes[i].checked = source.checked;
	}
</script>
<?php include_once('includes\footer.php'); ?>	

	