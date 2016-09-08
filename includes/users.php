<?php
	$UserQuery = mysql_query("SELECT * FROM r_user order by name")or die(mysql_error());
	if(mysql_num_rows($UserQuery)>0){
	?>	
	<div class="blo-top1">
		<div class="tech-btm">
			<h4>Featured Users </h4>
			<?php
				while ($user = mysql_fetch_assoc($UserQuery)) {
					if($user['image']!="" && $user['name']!=""){
					?>					
					<div class="blog-grids">
						<div class="blog-grid-left">
							<img src="images/user/<?php echo $user['image'] ?>" class="img-responsive"/>
						</div>						<div class="blog-grid-right">							<h5><?php echo  $user['name']; ?></h5>						</div>						<div class="clearfix"> </div>					</div>				<?php }} ?>		</div>	</div><?php } ?>