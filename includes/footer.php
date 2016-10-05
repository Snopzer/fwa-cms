<footer>
<div class="foot-nav">
    <div class="container">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
				$PagesQuery = $conn->query("SELECT * FROM r_page order by id_page desc")or die(mysql_error());
				while ($page = $PagesQuery->fetch_assoc()) {
				?>
                <li><a href="page.php?id=<?php echo $page['id_page']; ?>"><?php echo $page['title']; ?></a></li>
			<?php } ?>
            <li><a href="contact.php">Contact</a></li>
            <div class="clearfix"></div>
		</ul>
	</div>
</div>
<!-- footer-bottom -->
<div class="copyright">
    <div class="container">
        <p>© <?php echo SITE_COPY_RIGHTS;?> </p>
	</div>
</div>
</footer>
</body>
</html>
