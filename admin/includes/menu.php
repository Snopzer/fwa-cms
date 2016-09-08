<nav class="navbar-default navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
		</button>
        
        <h1> <a class="navbar-brand" href="home.php">Techdefeat</a></h1>         
	</div>
    <div class=" border-bottom">
        <div class="full-left">
            <div class="clearfix"> </div>
		</div>
		
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="drop-men" >
            <ul class=" nav_1">
				<li class="dropdown at-drop">
					<a target="_blank" href="<?php echo SITEURL;?>">
						<button class="btn btn-primary" type="button">
							View Site<!--<span class="badge">4</span>-->
						</button>
					</a>
				</li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?= $_SESSION['name'] ?><i class="caret"></i></span><img src="../images/user/<?= $_SESSION['image'] ?>" style="width:100px; height: 61px;"></a>
                    <ul class="dropdown-menu " role="menu">
                        <li><a href="profile.php"><i class="fa fa-user"></i>Edit Profile</a></li>
                        <li><a href="controller.php?type=logout"><i class="fa fa-sign-in"></i>Logout</a></li>    
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
        <div class="clearfix">
		</div>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="">
                        <a class=" hvr-bounce-to-right" href="#"><i class="fa fa-user nav_icon"></i> <span class="nav-label">User</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li><a href="users.php" 	class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>	<span class="nav-label">Users </span></a></li>
							<li><a href="userrole.php"	class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>	<span class="nav-label">User Role</span> </a></li> 
						</ul>
					</li>		
					<li class="">
                        <a class=" hvr-bounce-to-right" href="#"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Catalog</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                            <li><a href="category.php" 	class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i>	<span class="nav-label">Category</span></a></li>
							<li><a href="posts.php"	class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>	<span class="nav-label">Posts</span> </a></li>	
							<li><a href="comments.php" 	class=" hvr-bounce-to-right"><i class="fa fa-list nav_icon"></i> 		<span class="nav-label">Comments</span> </a></li>
						</ul>
					</li>					
					<li class="">
                        <a class=" hvr-bounce-to-right" href="#"><i class="fa fa-file-text-o nav_icon"></i> <span class="nav-label">CMS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                          <li><a href="pages.php" 	class=" hvr-bounce-to-right"><i class="fa fa-desktop nav_icon"></i>	<span class="nav-label">Pages</span> </a></li>
                    <li><a href="message.php" 	class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> 		<span class="nav-label">Message</span> </a></li>
                    <li><a href="gallery.php" 	class=" hvr-bounce-to-right"><i class="fa fa-picture-o nav_icon"></i> 	<span class="nav-label">Gallery</span> </a></li>
						</ul>
					</li>
					<li class="">
                        <a class=" hvr-bounce-to-right" href="#"><i class="fa fa-cog nav_icon"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
							<li><a href="country.php" 	class=" hvr-bounce-to-right"><i class="fa fa-inbox nav_icon"></i> 		<span class="nav-label">Countries</span> </a></li>
                            <li><a href="site.php" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> 	<span class="nav-label">Site details</span> </a></li>
					
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>				